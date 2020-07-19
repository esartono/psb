<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penghasilan extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function nama($id)
    {
        $namanya = static::where('id', $id)->first();
        return $namanya['name'];
    }
}
