<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doku extends Model
{
    protected $fillable = [
        'calon_id',
        'user_id',
        'jdoku',
        'file',
        'rapot'
    ];

    protected $casts = [
        'rapot' => 'array'
    ];

    protected $appends = [
        'calonnya'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getCalonnyaAttribute()
    {
        return DB::table('calons')
            ->select(
                'calons.name',
                'units.name as unitnya',
                DB::raw('concat(gelombangs.kode_va, LPAD(calons.urut, 3, "0")) as uruts')
            )
            ->leftJoin('calon_kategoris', 'calons.ck_id', '=', 'calon_kategoris.id')
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->where('calons.id', $this->attributes['calon_id'])
            ->first();
    }
}
