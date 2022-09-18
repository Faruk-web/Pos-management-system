<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPaymentStatement extends Model
{
    use HasFactory;
    protected $guarded=[];
     public function agentcommission(){
        return $this->hasMany(AgentCommission::class,'agent_id','agent_id');
    }
     public function agentpanel(){
        return $this->belongsTo(AgentPanel::class,'agent_id','id');
    }
}