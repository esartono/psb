<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BayarTagihan extends Model
{
    protected $fillable = [
        'calon_id','tgl_bayar','bayar','keterangan','admin'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    public function adminnya()
    {
        return $this->belongsTo(User::class, 'admin');
    }

    protected $appends = [
        'tagihan'
    ];

    public function getTagihanAttribute()
    {
        $bayar = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->get()->sum('bayar');
        $akhir = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->orderBy('id', 'desc')->first()->tgl_bayar;

        $calon = Calon::where('id',$this->attributes['calon_id'])->first();
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        $now = new \DateTime();
        $reg1 = new \DateTime('2020-11-1');
        $reg2 = new \DateTime('2020-12-1');
        $reg3 = new \DateTime('2021-02-1');

        if($reg3 > $now) {
            $ket = 'Reguler 3';
            $total = $biayas->total[3];
        }
        if($reg2 > $now) {
            $ket = 'Reguler 2';
            $total = $biayas->total[2];
        }
        if($reg1 > $now) {
            $ket = 'Reguler 1';
            $total = $biayas->total[1];
        }

        $sisa = $total - $bayar;
        return compact('total', 'sisa', 'bayar', 'akhir', 'ket');
    }
}
