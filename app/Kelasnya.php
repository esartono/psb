<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Kelasnya extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'name', 'unit_id', 'status', 'kelamin', 'jurusan', 'tahun_ajaran'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function unitnya()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public static function unit($id)
    {
        return static::whereId($id)->first()->name;
    }

    public static function units($cari, $baru)
    {
        $cat = SchoolCategory::where('name', $cari)->first()->id;
        $unit = Unit::where('cat_id', $cat)->first()->id;

        if($baru === true || $baru === 1) {
            $ta = [0, 1];
        } else {
            $ta = [0, 2];
        }

        $kls = static::where('unit_id', $unit)
            ->whereIn('tahun_ajaran', $ta)->pluck('name', 'id');
        return $kls;
    }
}
