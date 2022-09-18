<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    // public function maxProduct()

    public function lastMonthDeliverdOrder()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id')
            ->where('status','delivered')
            ->whereMonth('created_at', (Carbon::now()->month)-1);
    }
    
    public function pickedOrderEmployee()
    {
        return $this->hasOne(Employee::class,'id','picked_employee_id');
    }
    
    
    
    public function checkedOrderEmployee()
    {
        return $this->hasOne(Employee::class,'id','checked_employee_id');
    }

    

}
