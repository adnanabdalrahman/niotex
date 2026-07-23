<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NiotixImportError extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_import_errors';

    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'resolved' => 'boolean',
    ];
}
