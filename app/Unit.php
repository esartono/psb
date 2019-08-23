<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Unit extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'name', 'cat_id', 'logo', 'address', 'email', 'phone'
    ];

    public function catnya()
    {
        return $this->belongsTo(SchoolCategory::class, 'cat_id');
    }
}
