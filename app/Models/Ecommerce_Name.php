<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecommerce_Name extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function products(){
            return $this->hasMany(Product::class, 'ecom_name','id');
        }
}
