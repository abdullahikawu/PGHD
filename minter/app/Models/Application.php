<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $with = ['fields', 'user'];

    public function fields(){
        return $this->hasMany(ApplicationData::class,'application_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
