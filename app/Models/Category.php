<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded=[];
    
    public function get_child_category()
    {
        return $this->hasMany(ChildCategory::class,'category_id');
    }

    public function get_product()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
