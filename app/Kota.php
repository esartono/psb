<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $fillable = [
        'prov_id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function nama($id)
    {
       return static::where('id', '=', $id)->first()->name;
    }
}
