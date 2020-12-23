<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $guarded=[];

    public function get_product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function get_user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}