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

    protected $dates = [
        'expired'
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

        $jd = $this->pilihjadwal($calon->gel_id, $calon->asal_nf);

        // $cj = CalonJadwal::where('calon_id', $calon->id)->first();
        CalonJadwal::updateOrCreate(
            ['calon_id' => $calon->id],
            ['jadwal_id' => $jd]
        );

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

    public function pilihjadwal($gel, $asal)
    {

        if($asal == 1) {
            $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                    ->where('gel_id', $gel)
                    ->where('internal', 1)
                    ->whereColumn('kuota', '>=', 'ikut')
                    ->first();
            if($jadwal) {
                return $jadwal->id;
            }
        }

        $jadwal = Jadwal::whereDate('seleksi', '>', Carbon::today()->addDays(3)->timezone('Asia/Jakarta')->toDateString())
                ->where('gel_id', $gel)
                ->where('internal', 0)
                ->whereColumn('kuota', '>=', 'ikut')
                ->first();

        if($jadwal) {
            return $jadwal->id;
        }
        return 0;
    }
}
