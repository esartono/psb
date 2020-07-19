<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

    public function lunas()
    {
        $calonbiayates = $this;
        $calon = Calon::with('gelnya')->where('id', $calonbiayates->calon_id)->first();
        $calon->update(['status' => 1]);

        // if($calon->asal_nf === 1){
        //     $jadwal = Jadwal::where('gel_id', $calon->gel_id)
        //             ->where('internal', 1)
        //             ->whereDate('seleksi', '>', date('Y-m-d'))
        //             ->first();
        //     $kuota = $jadwal->kuota;

        //     if($jadwal){
        //         if($kuota >= $jadwal->ikut){
        //             CalonJadwal::create([
        //                 'calon_id' => $calon->id,
        //                 'jadwal_id' => $jadwal->id,
        //             ]);
        //         } else {
        //             $jadwal = Jadwal::where('gel_id', $calon->gel_id)
        //                     ->where('internal', 0)
        //                     ->whereDate('seleksi', '>', date('Y-m-d'))
        //                     ->first();
        //             $kuota = $jadwal->kuota;

        //             CalonJadwal::create([
        //                 'calon_id' => $calon->id,
        //                 'jadwal_id' => $jadwal->id,
        //             ]);
        //         }
        //     }
        // }

        //if($calon->asal_nf === 0){
            // $jadwal = Jadwal::where('gel_id', $calon->gel_id)
            //         ->where('internal', 0)
            //         ->whereDate('seleksi', '>', date('Y-m-d'))
            //         ->first();
            // $kuota = $jadwal->kuota;
            //$idnya = $jadwal->id;

            $jadwal = Jadwal::where('gel_id', $calon->gel_id)
                    // ->where('ikut', '<', $kuota)
                    ->whereDate('seleksi', '>', date('Y-m-d'))
                    ->first();

            //if($kuota >= $jadwal->ikut){
                CalonJadwal::create([
                    'calon_id' => $calon->id,
                    'jadwal_id' => $jadwal->id,
                ]);
            // } else {
            //     $jadwal = Jadwal::where('gel_id', $calon->gel_id)
            //         ->whereNotIn( 'id', [$idnya])
            //         ->where('internal', 0)
            //         ->whereDate('seleksi', '>', date('Y-m-d'))
            //         ->first();

            // }
        //}

        $ikut = $jadwal->ikut;
        $jadwal->update(['ikut' => $ikut+1]);

        $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$calon->id)->first();
        Mail::send('emails.seleksi', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Kartu Seleksi');
            }
        );
    }
}
