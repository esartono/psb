<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Kelasnya extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'name', 'unit_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function unitnya()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
