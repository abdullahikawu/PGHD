<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationData extends Model
{
    use HasFactory;
    protected $with = ['application','field'];

    public function application(){
        return $this->belongsTo(Application::class);
    }

    public function field(){
        return $this->belongsTo(Field::class);
    }
    
    public function getStatusUpdatedByAttribute(){
        return User::find($this->status_updated_by);
    } 
    
    public function getFieldNameAttribute(){
        return Field::find($this->field_id)?->name;
    } 
    
    protected $appends = ['status_updated_by', 'field_name'];
}
