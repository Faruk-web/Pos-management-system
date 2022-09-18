<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;



    protected $fillable = [
        'category_name',
        'category_slug_name',
        'category_icon',
         'status'
    ];
     public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_id', 'id');
    }

    public function subcategory()
    {


            return $this->hasMany(SubCategory::class, 'category_id', 'id');

    }
    
    public function getSubCategoryLimitIs4()
    {

        return $this->hasMany(SubCategory::class, 'category_id', 'id');

    }
    public function subsubcategory()
    {
            return $this->hasMany(SubSubCategory::class, 'category_id', 'id');
    }


 public function thisWeekOrdersProduct()
    {
        return $this->hasManyThrough(OrderItem::class, Product::class, 'category_id', 'product_id', 'id', 'id')
        ->whereBetween('order_items.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }


    public function ordersProduct(){
        return $this->hasManyThrough(OrderItem::class,Product::class,'category_id','product_id','id','id');
    }


    public function products(){
        return $this->hasMany(Product::class,'category_id','id')->where('ecom_name','Islamic');
    }
    
    public function products_list(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function electronicProduct()
    {
        return  $this->hasMany(Product::class,'category_id','id')->where('ecom_name','4');
    }
    
    public function fashionProduct()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->where('status',1)->where('ecom_name', '3');
    }
    
    
    

}
