<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopBanner extends Model
{
    use HasFactory;
     public function ecommerce()
     {
     return $this->belongsTo(Ecommerce_Name::class,'ecom_id');
     }
}
