<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantBusinessCategory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function merchantCategorysPackages(){
        return $this->hasMany(MerchantPackage::class, 'package_category_id','id');
    }
}

