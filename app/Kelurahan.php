<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $fillable = [
        'camat_id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function nama($id)
    {
        // return static::where('id', '=', $id)->first()->name;
        $data = static::where('id', '=', $id)->first();
        if ($data) {
            return $data->name;
        }
        return '-';
    }
}
