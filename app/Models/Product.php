<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model
{
    use HasFactory;
  
    protected $guarded = [];
     public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_name', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id', 'id');
    }


    public function multiImg()
    {
        return $this->hasMany(MultiImg::class, 'product_id', 'id');
    }


    public function supplier()
    {

        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function orderedProduct()
    {
        return $this->hasMany(OrderItem::class,'product_id','id');
    }
    
    public function review()
    {
        return $this->hasMany(review::class,'product_id','id');
    }
    
     public function reviews()
    {
        return $this->hasMany(review::class,'product_id', 'id');
    }
    
    // for ele...
    public function lastMonthBestSell()
    {
        return $this->hasMany(OrderItem::class,'product_id','id')
        ->whereMonth('order_items.created_at',Carbon::now()->submonth(1));
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id','id');
    }
    
    // suddam vai
    
    public function orderItemsSaddam(){
        return $this->hasMany(OrderItem::class,'product_id','id');
    }
      public function returnHistory()
    {
        return $this->hasOne(SupplierReturnProduct::class,'product_id' , 'id');
    }
      public function paymentHistory()
    {
        return $this->hasOne(supplerPaymentHistory::class,'product_id','id');
    }
    
    
   


}
