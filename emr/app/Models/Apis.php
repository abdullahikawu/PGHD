<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apis extends Model
{
    use HasFactory;

    public function getAccessTokenHasExpiredAttribute()
    {
        $now = Carbon::now('Y-m-d H:i:s');
        return Carbon::parse($this->access_token_expiry_date,'Y-m-d H:i:s')->isBefore($now);
    }

    protected $appends = ['fitbit','emr','access_token_is_active'];
}
