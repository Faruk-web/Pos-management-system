<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileimg extends Model
{
    use HasFactory;

    protected $guarded = [];



    // product table  relationship
    public function employee(){
    	return $this->belongsTo(Employee::class,'employee_id','id');
    }
}

