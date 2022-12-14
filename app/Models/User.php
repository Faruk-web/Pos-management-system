<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'provider_id',
        'avatar',
        'phone',
        'address',
        'otp',
        'mobile',
        'last_seen',
        'password',
        'date_of_birth',
        'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // User Active Show
    public function UserOnline()
    {
        return Cache::has('user-is-online' . $this->id);
    }
    
    public function customerOrderHistory(){
        return $this->hasMany(Order::class,'user_id','id');
    }
    
    public function agentData(){
        return $this->belongsTo(AgentPanel::class, 'agent_id', 'id');
    }
    
    
    
    
      public function orderItemsthrough()
    {
        return $this->hasManyThrough( OrderItem::class,Order::class,'user_id','order_id','id','id');
    }
     public function agentcommission(){
        return $this->belongsTo(AgentCommission::class, 'agent_id', 'agent_id');
    }
     public function agentpaymnent(){
        return $this->belongsTo(AgentPaymentStatement::class, 'agent_id', 'agent_id');
    }
    
    
    
    
    
    
    
    
} // main end
