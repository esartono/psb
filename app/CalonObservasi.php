<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonObservasi extends Model
{
    protected $fillable = [
        'calon_id',
        'observer_id',
        'poin',
        'catatan',
        'keterangan',
    ];

    protected $casts = [
        'poin' => 'array',
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
        return $this->belongsTo(User::class, 'observer_id');
    }
}
