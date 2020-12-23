<?php

namespace App;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\ShareHolder;
use App\Models\ShareHolderLevel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_share_holder_level(){
        return $this->belongsTo(ShareHolderLevel::class,'share_holder_level_id');
    }

    public function get_share_holders(){
        return $this->hasMany(ShareHolder::class,'user_id');
    }


    public function get_orders(){
        return $this->hasMany(Orders::class,'user_id');
    }

    public function get_order_details(){
        return $this->hasMany(OrderDetails::class,'user_id');
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
