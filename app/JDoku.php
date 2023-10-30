<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JDoku extends Model
{
    protected $fillable = [
        'code', 'name', 'unit', 'khusus', 'optional'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function Dokumen($gel_id, $ck)
    {
        $gel = Gelombang::where('id', $gel_id)->first()->unit_id;
        $units = Unit::where('id', $gel)->first()->cat_id;
        $unit = SchoolCategory::where('id', $units)->first()->name;
        $ck = CalonKategori::where('id', $ck)->first()->name;
        return static::where('unit', 'LIKE', '%' . $unit . '%')->where('khusus', 'LIKE', '%' . $ck . '%')->get();
    }

    public static function Khusus($ck)
    {
        $ck = CalonKategori::where('id', $ck)->first()->name;
        return static::where('khusus', 'LIKE', '%' . $ck . '%')->get();
    }
}
