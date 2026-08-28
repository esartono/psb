<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PraWawancara extends Model
{
    protected $fillable = [
        'calon_id',
        'kategori',
        'no',
        'no_soal',
        'pertanyaan',
        'jawaban',
        'catatan',
        'status'
    ];

    protected $casts = [
        'jawaban' => 'array',
        'catatan' => 'array'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function calonnya()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }
}
