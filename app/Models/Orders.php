<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded=[];

    public function get_order_details()
    {
        return $this->hasMany(OrderDetails::class,'order_id');
    }

    public function get_user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
