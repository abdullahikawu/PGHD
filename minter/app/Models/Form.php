<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public function getFieldsAttribute(){
        $field_ids = explode(',', $this->field_ids);
        return Field::whereIn('id',$field_ids)->get();
    }

    protected $appends = ['fields'];
}
