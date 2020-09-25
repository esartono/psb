<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonTagihanPSB extends Model
{
    protected $fillable = [
        'calon_id', 'tagihanpsb_id','potongan','infaq','infaqnfpeduli','daul','lunas','pewawancara'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
