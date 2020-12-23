<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded =[];
    

    public function get_product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
