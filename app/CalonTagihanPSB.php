<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonTagihanPSB extends Model
{
    protected $fillable = [
        'calon_id',
        'khusus',
        'va1',
        'va2',
        'potongan',
        'keterangan',
        'saudara',
        'infaq',
        'infaqnfpeduli',
        'lain',
        'daul',
        'lunas',
        'pewawancara'
    ];

    protected $casts = [
        'lain' => 'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    protected $appends = [
        'tagihan',
        'wawancara',
        // 'impruf'
    ];

    public function getTagihanAttribute()
    {
        $calon = Calon::where('id', $this->attributes['calon_id'])->first();
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
            ->where('kelas', $calon->kelas_tujuan)
            ->where('kelamin', $calon->jk)
            ->first();

        if (TagihanPSB::where('gel_id', $calon->uruts)->exists()) {
            $biayas = TagihanPSB::where('gel_id', $calon->uruts)->first();
        }

        return $biayas->total;
    }

    public function getImprufAttribute()
    {
        // return $this->attributes['lain'];
    }

    public function getWawancaraAttribute()
    {
        return User::namaUser($this->attributes['pewawancara']);
    }
}
