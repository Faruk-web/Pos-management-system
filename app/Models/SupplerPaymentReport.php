<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplerPaymentReport extends Model
{
    use HasFactory;
    protected $guarded=[];
    
     public function suppliers()
    {

        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
      public function products()
    {

        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
