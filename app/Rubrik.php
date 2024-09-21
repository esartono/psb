<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    protected $fillable = [
        'id_instrumen',
        'jlhbutir',
        'butir',
        'rubrik',
        'bobot',
        'optional',
        'keterangan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'rubrik' => 'array',
    ];

    public function instrumennya()
    {
        return $this->belongsTo(Instrumen::class, 'id_instrumen');
    }
}
