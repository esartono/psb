<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function namaDariGelombang($gel_id)
    {
        $gel = Gelombang::whereId($gel_id)->first()->unit_id;
        $unit = Unit::whereId($gel)->first()->cat_id;
        return Static::whereId($unit)->first()->name;
    }
}
