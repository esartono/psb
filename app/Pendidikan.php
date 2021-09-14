<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function nama($id)
    {
        $p = static::where('id', '=', $id)->first();
        if ($p) {
            return $p->name;
        }
        return '-';
    }
}
