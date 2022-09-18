<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPanel extends Model
{
    use HasFactory;
      protected $guarded = [];
      
      public function admin(){
        return $this->hasOne(Admin::class,'agent_id','id');
    }
     
     
       public function agentcommission()
    {
        return $this->hasMany(AgentCommission::class,'agent_id','id');
    }
      public function agentpayment()
    {
        return $this->hasMany(AgentPaymentStatement::class,'agent_id','id');
    }
      
}
