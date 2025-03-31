<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken {
    protected $table = 'personal_access_tokens'; // Ensure it's using the correct table
    protected $dateFormat = 'Y-d-m H:i:s.v';

    /**
     * Ensure the correct date format when serializing
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat);
    }
}
