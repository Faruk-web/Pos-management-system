<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function ecommerce(){
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_id', 'id');
    }
}
