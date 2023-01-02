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
        "emr_expiry_date",
        "email",
        "password",
        "meta"
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function getEmrAttribute()
    {
        return Apis::where(['pid'=>$this->id, 'name'=>'emr'])->first();
    }

    public function getFitbitAttribute()
    {
        return Apis::where(['pid'=>$this->id, 'name'=>'fitbit'])->first();
    }

    protected $appends = ['fitbit','emr'];
}
