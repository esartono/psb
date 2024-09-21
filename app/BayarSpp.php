<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BayarSpp extends Model
{
    protected $fillable = [
        'calon_id',
        'tp',
        'tanggal_bayar',
        'jumlahbayar',
        'keterangan',
        'lunas',
        'status',
        'verifikasi',
        'verificator',
        'file'
    ];

    protected $appends = [
        'calonnya',
        'verificatornya'
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
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->where('calons.id', $this->attributes['calon_id'])
            ->first();
    }

    public function getVerificatornyaAttribute()
    {
        return DB::table('calons')
            ->select(
                'calons.name',
                'units.name as unitnya',
                DB::raw('concat(gelombangs.kode_va, LPAD(calons.urut, 3, "0")) as uruts')
            )
            ->leftJoin('gelombangs', 'calons.gel_id', '=', 'gelombangs.id')
            ->leftJoin('units', 'gelombangs.unit_id', '=', 'units.id')
            ->where('calons.id', $this->attributes['calon_id'])
            ->first();
    }
}
