<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JDoku extends Model
{
    protected $fillable = [
        'code', 'name', 'unit', 'khusus'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public static function Dokumen($gel_id)
    {
        $gel = Gelombang::where('id', $gel_id)->first()->unit_id;
        $units = Unit::where('id', $gel)->first()->cat_id;
        $unit = SchoolCategory::where('id', $units)->first()->name;
        return static::where('unit', 'LIKE', '%' . $unit . '%')->get();
    }

    protected $appends = [
        'doku_khusus'
    ];

    public function getDokuKhususAttribute()
    {
        if (is_null($this->attributes['khusus'])) {
            return 'Semua Asal Calon';
        } else {
            $cek = CalonKategori::where('id', $this->attributes['khusus'])->first();
            return 'Khusus dari ' . $cek->name;
        }
    }
}
