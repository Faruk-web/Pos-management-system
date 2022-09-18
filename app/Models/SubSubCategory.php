<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_name',
        'subsubcategory_slug_name',
         'status'

    ];
       public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_id', 'id');
    }

       // Rel.. in category id
       public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function products_list(){
        return $this->hasMany(Product::class,'sub_sub_category_id','id');
    }
    //Rel.. sub category table
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }



}
