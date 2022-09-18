<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_name',
        'sub_category_slug_name',
         'status'
    ];
       public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
     public function products_list(){
        return $this->hasMany(Product::class,'sub_category_id','id');
    }
    public function subsubcategories()
    {
        return $this->hasMany(SubSubCategory::class, 'subcategory_id', 'id');
    }
    
     public function electronicProducts(){
        return $this->hasMany(Product::class,'sub_category_id','id')->where('ecom_name','4');
    }
}
