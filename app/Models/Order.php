<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];


// laboni ========

   // agent panel relationship
     public function agentcommission(){
      return $this->belongsTo(AgentCommission::class,'agent_id','agent_id');
    }
   
    
      public function agentpanel(){
        return $this->belongsTo(AgentPanel::class,'agent_id','id');
    }

// laboni ============





    public function division(){
    	return $this->belongsTo('Devfaysal\BangladeshGeocode\Models\Division','division_id','id');
    }

      public function district(){
    	return $this->belongsTo('Devfaysal\BangladeshGeocode\Models\District','district_id','id');
    }

      public function state(){
    	return $this->belongsTo('Devfaysal\BangladeshGeocode\Models\Upazila','state_id','id');
    }

      public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }
    

    public function orderItems(){
      return $this->hasMany(OrderItem::class,'order_id','id');
    }


     public function postCodes(){
        return $this->belongsTo(PostCode::class,'state_id','id');
    }

    public function products(){
        return $this->hasManyThrough( Product::class,OrderItem::class,'order_id','id','id','product_id');
    }

    public function confirmOrderEmployee(){
    	return $this->belongsTo(Employee::class,'confirm_order_employee_id','id');
    }
    
    public function processingOrderEmployee(){
    	return $this->belongsTo(Employee::class,'processing_order_employee_id','id');
    }
    
    public function pickOrderEmployee(){
    	return $this->belongsTo(Employee::class,'pick_order_employee_id','id');
    }
    
    public function readyOrderEmployee(){
    	return $this->belongsTo(Employee::class,'ready_to_ship_employee_id','id');
    }
    
    public function cancelOrderEmployee(){
    	return $this->belongsTo(Employee::class,'cancel_order_employee_id','id');
    }
    
}
