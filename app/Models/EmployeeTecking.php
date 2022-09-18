<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTecking extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function productName()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
     public function admin()
    {
        return $this->belongsTo(Admin::class, 'employee_id', 'employee_id');
    }
    
}
