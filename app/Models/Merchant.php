<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    public function merchantCategorys(){
        return $this->belongsTo(MerchantBusinessCategory::class,'business_category_id','id');
    }
    public function MerchantPackage(){
        return $this->belongsTo(MerchantPackage::class,'id','merchant_id');
    }
    public function PostCodes(){
        return $this->belongsTo(PostCode::class,'merchant_zone_id','id');
    }


}
