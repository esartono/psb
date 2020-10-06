<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagihanPSB extends Model
{
    protected $fillable = [
        'gel_id', 'kelas', 'kelamin', 'biaya1', 'biaya2', 'biaya3'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'biaya1' => 'array',
        'biaya2' => 'array',
        'biaya3' => 'array',
    ];

    public function gelnya()
    {
        return $this->belongsTo(Gelombang::class, 'gel_id');
    }

    public function kelasnya()
    {
        return $this->belongsTo(Kelasnya::class, 'kelas');
    }

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute()
    {
        $total = [];
        $total[1] = 0;
        $total[2] = 0;
        $total[3] = 0;

        if($this->attributes['biaya1']){
            $biaya = json_decode($this->attributes['biaya1']);
            foreach($biaya as $k => $v){
                $total[1] = $total[1] + $v;
            }
        }

        if($this->attributes['biaya2']){
            $biaya = json_decode($this->attributes['biaya2']);
            foreach($biaya as $k => $v){
                $total[2] = $total[2] + $v;
            }
        }

        if($this->attributes['biaya3']){
            $biaya = json_decode($this->attributes['biaya3']);
            foreach($biaya as $k => $v){
                $total[3] = $total[3] + $v;
            }
        }

        return $total;
    }

    public static function biayanya($id)
    {
        $calon = Calon::where('id', $id)->first();
        $biayas = TagihanPSB::where('gel_id', $calon->gel_id)
                ->where('kelas', $calon->kelas_tujuan)
                ->where('kelamin', $calon->jk)
                ->first();

        $now = new \DateTime();
        $reg1 = new \DateTime('2020-11-1');
        $reg2 = new \DateTime('2020-12-1');
        $reg3 = new \DateTime('2021-02-1');

        if($reg3 > $now) {
            return $biayas->biaya1;
        }
        if($reg2 > $now) {
            return $biayas->biaya2;
        }
        if($reg1 > $now) {
            return $biayas->biaya1;
        }
    }
}
