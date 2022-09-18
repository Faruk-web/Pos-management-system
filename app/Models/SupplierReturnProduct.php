<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReturnProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function SupplierDetailes()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
     public function returnHistory()
    {
        return $this->belongsTo(Product::class,'product_id' , 'id');
    }
}
