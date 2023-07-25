<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function nama($id)
    {
        $data = static::where('id', '=', $id)->first();
        if ($data) {
            return $data->name;
        }
        return '-';
    }
}
