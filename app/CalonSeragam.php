<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonSeragam extends Model
{
    protected $fillable = [
        'calon_id', 'seragam_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->hasOne(Calon::class, 'calon_id');
    }

    public function seragamnya()
    {
        return $this->hasOne(Seragam::class, 'seragam_id');
    }

}
