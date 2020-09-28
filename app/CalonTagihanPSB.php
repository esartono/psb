<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonTagihanPSB extends Model
{
    protected $fillable = [
        'calon_id', 'tagihanpsb_id','potongan','infaq','infaqnfpeduli','daul','lunas','pewawancara'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    protected $appends = [
        'tagihan', 'wawancara'
    ];

    public function getTagihanAttribute()
    {
        $calon = Calon::where('id',$this->attributes['calon_id'])->first();
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        return $biayas->total;
    }

    public function getWawancaraAttribute()
    {
        return User::namaUser($this->attributes['pewawancara']);
    }
}
