<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileGdrive extends Model
{
    protected $fillable = [
        'jenisfile', 'folderId', 'fileName', 'fileId', 'extension'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
