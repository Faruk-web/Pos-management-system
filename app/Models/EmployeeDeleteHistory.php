<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDeleteHistory extends Model
{
    use HasFactory;
    
     public function ecommerce()
    {
        return $this->belongsTo(Ecommerce_Name::class, 'ecom_name', 'id');
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
    
    public function supplier()
    {

        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
