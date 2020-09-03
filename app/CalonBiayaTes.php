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

        $calonsnya = Calon::with('gelnya.unitnya.catnya', 'cknya', 'kelasnya', 'biayates.biayanya','usernya')->where('id',$calon->id)->first();
        Mail::send('emails.bayartes', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Terima Kasih');
            }
        );
        Mail::send('emails.seleksi', compact('calonsnya'), function ($m) use ($calonsnya)
            {
                $m->to($calonsnya->usernya->email, $calonsnya->name)->from('psb@nurulfikri.sch.id', 'Panitia PSB SIT Nurul Fikri')->subject('Kartu Seleksi');
            }
        );
    }
}
