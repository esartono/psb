<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonSeragam extends Model
{
    protected $fillable = [
        'calon_id', 'atas', 'bawah', 'lain', 'keterangan'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->hasOne(Calon::class, 'calon_id');
    }
}
