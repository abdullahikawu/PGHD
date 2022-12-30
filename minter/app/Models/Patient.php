<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        "pid",
        "organization_id",
        "emr_pid",
        "fitbit_code",
        "emr_code",
        "fitbit_access_token",
        "emr_expiry_date",
        "email",
        "password",
        "meta"
    ];
}
