<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TesWawancara extends Model
{
    protected $fillable = [
        'calon_id',
        'pewawancara_id',
        'instrumen_id',
        'jawaban',
        'skor',
        'rubrik',
        'rekomendasi',
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

    public function usernya()
    {
        return $this->belongsTo(User::class, 'pewawancara_id');
    }

    public function instrumennya()
    {
        return $this->belongsTo(InstrumenWawancara::class, 'instrumen_id');
    }
}
