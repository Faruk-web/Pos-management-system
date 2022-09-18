<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    
     public function admin(){
        return $this->hasOne(Admin::class,'employee_id','id');
    }
    
     public function zone(){
        return $this->hasOne(PostCode::class,'id','zone_id');
    }
    
    
      public function orderItem()
    {
        return $this->hasMany(OrderItem::class,'picked_employee_id','id');
    }
    
    
     public function fileimg()
    {
        return $this->hasMany(Fileimg::class, 'employee_id', 'id');
    }
    
      public function employeeTacking()
    {
        return $this->hasMany(EmployeeTecking::class, 'employee_id', 'id');
    }
}
