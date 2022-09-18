<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPackage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function merchantCategorysBusinessPackages(){
        return $this->belongsTo(MerchantBusinessCategory::class, 'package_category_id','id');
    }
    public function Merchant(){
        return $this->hasOne(Merchant::class,'id','merchant_id');
    }

}
