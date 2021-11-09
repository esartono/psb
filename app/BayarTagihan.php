<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BayarTagihan extends Model
{
    protected $fillable = [
        'calon_id','tgl_bayar','bayar','tambah_infaq', 'diskon','keterangan','admin'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    public function adminnya()
    {
        return $this->belongsTo(User::class, 'admin');
    }

    protected $appends = [
        'tagihan'
    ];

    public function getTagihanAttribute()
    {
        $bayar = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->get()->sum('bayar');
        $tambah_infaq = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->get()->sum('tambah_infaq');
        $diskon = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->get()->sum('diskon');
        $akhir = BayarTagihan::where('calon_id', $this->attributes['calon_id'])->orderBy('id', 'desc')->first()->tgl_bayar;

        $calon = Calon::where('id',$this->attributes['calon_id'])->first();
        $cbs = CalonTagihanPSB::where('calon_id', $this->attributes['calon_id'])
                ->first(['calon_id', 'pewawancara', 'daul', 'lunas', 'infaq', 'infaqnfpeduli']);
        dd($cbs);
        $cbsinfaq = 0;
        $cbsinfaqnf = 0;
        if($cbs->infaq) {
            $cbsinfaq = $cbs->infaq;
        }
        if($cbs->infaqnfpeduli) {
            $cbsinfaqnf = $cbs->infaqnfpeduli;
        }
        $infaq = $cbs->infaq + $cbs->infaqnfpeduli + $tambah_infaq;
        $lunas = $cbs->lunas;
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        $total = $biayas->total[1] + $infaq;
        $sisa = $total - $bayar - $diskon;
        return compact('total', 'sisa', 'bayar', 'lunas', 'infaq', 'diskon');
    }
}
