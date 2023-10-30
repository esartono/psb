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

        if ($baru === true || $baru === 1) {
            $ta = [0, 2];
        } else {
            $ta = [0, 1];
        }

        $kls = static::select('id', 'name', 'jurusan')->where('unit_id', $unit)->where('name', 'not like', "%Toddler%")->whereIn('tahun_ajaran', $ta)->get();
        return $kls;
    }

    public static function cjk($cari)
    {
        $cek = static::whereId($cari)->first();
        if ($cek) {
            $cjk = $cek->kelamin;
        }

        if ($cari === 'TK' || $cari === 'SD') {
            $cjk = 0;
        }

        if ($cari === 'SMP') {
            $cjk = static::where('name', '7')->first()->kelamin;
        }

        if ($cari === 'SMA') {
            $cjk = static::where('name', '10')->first()->kelamin;
        }

        return $cjk;
    }
}
