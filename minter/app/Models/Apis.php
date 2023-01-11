<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apis extends Model
{
    use HasFactory;

    public function getAccessTokenIsActiveAttribute()
    {
        $now = Carbon::now();
        return Carbon::parse($this->access_token_expiry_date)->isAfter($now);
    }

    protected $appends = ['access_token_is_active'];
}
