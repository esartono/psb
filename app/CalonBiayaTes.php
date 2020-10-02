<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CalonBiayaTes extends Model
{
    protected $fillable = [
        'calon_id', 'biaya_id', 'lunas', 'expired'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    public function biayanya()
    {
        return $this->belongsTo(BiayaTes::class, 'biaya_id');
    }

    public function lunas($id)
    {
        // $calonbiayates = $this;
        $calon = Calon::with('gelnya')->where('id', $id)->first();
        $calon->update(['status' => 1]);

        $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$calon->id)->first();
        Mail::send('emails.bayartes', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Terima Kasih');
            }
        );

        // if ($calon->asal_nf){
        //     $cek = $this->asalNF($calon->gelnya->id);
        //     if($cek !== "SALAH"){
        //         $jd = $cek;
        //     } else {
        //         $jd = $this->pilihjadwal($calon->id);
        //     }
        // } else {
            $jd = $this->pilihjadwal($calon->id);
        // }

        $cj = CalonJadwal::where('calon_id', $calon->id)->first();
        if(!$cj){
            CalonJadwal::updateOrCreate(
                ['calon_id' => $calon->id],
                ['jadwal_id' => $jd]
            );
        } else {
            if($cj->jadwal_id == 0){
                CalonJadwal::updateOrCreate(
                    ['calon_id' => $calon->id],
                    ['jadwal_id' => $jd]
                );
            }
        }

        Mail::send('emails.seleksi', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Kartu Seleksi');
            }
        );

        $jadwal = Jadwal::get();
        foreach($jadwal as $j) {
            $c = CalonJadwal::where('jadwal_id', $j->id)->get()->count();
            $j->update(['ikut' => $c]);
        }

    }

    public function asalNF($gel)
    {
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 1)->first();
        if($jadwal){
            return $jadwal->id;
        } else {
            return "SALAH";
        }
    }

    public function pilihjadwal($gel)
    {
        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 0)->first();
        if($jadwal){
            return $jadwal->id;
        } else {
            return 0;
        }
    }
}
