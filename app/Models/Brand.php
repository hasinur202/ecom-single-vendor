<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // protected $fillable =[
    //     'brand_name',
    //     'category_id',
    //     'child_category_id',
    //     'sub_child_category_id'
    // ];
    protected $guarded =[];
    public function get_product()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
