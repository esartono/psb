<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'gel_id',
        'internal',
        'seleksi',
        'seleksi_online',
        'pengumuman',
        'kuota',
        'ikut',
        'keterangan',
        'akademik_link'
    ];

    protected $dates = [
        'seleksi',
        'seleksi_online',
        'pengumuman'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'seleksinya'
    ];

    public function getSeleksinyaAttribute()
    {
        $seleksi = Carbon::create($this->attributes['seleksi']);
        return Carbon::parse($seleksi)->formatLocalized('%d %B %Y');
    }

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }
}
