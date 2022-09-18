<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];
       public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_id', 'id');
    }
         public function zone()
    {
        return $this->belongsTo(PostCode::class, 'zone_id', 'id');
    }
         public function acquisiton()
    {
        return $this->belongsTo(Employee::class, 'aquisition_employee_id', 'id');
    }
    
    // for role admin
     public function admin(){
        return $this->hasOne(Admin::class,'supplier_id','id');
    }
    
    public function orderItem()
    {
        return $this->hasManyThrough(OrderItem::class,Product::class,'supplier_id','product_id','id','id');
    }
}


