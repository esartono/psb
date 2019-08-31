<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seragam extends Model
{
    protected $fillable = [
        'cat_id', 'jk', 'jenis', 'ukuran', 'keterangan'
    ];

    protected $casts = [
        'keterangan' => 'array',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'kelamin'
    ];

    public function getKelaminAttribute()
    {
        if($this->attributes['jk'] === 1) {
            return 'Laki-Laki';
        }

        if($this->attributes['jk'] === 2) {
            return 'Perempuan';
        }
    }

    public function catnya()
    {
        return $this->belongsTo(SchoolCategory::class, 'cat_id');
    }
}
