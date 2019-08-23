<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nip', 'name', 'jk'
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
}
