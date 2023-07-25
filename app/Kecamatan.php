<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = [
        'kota_id', 'name'
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
