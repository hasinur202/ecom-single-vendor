<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];

    public function get_brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function get_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function get_child_category()
    {
        return $this->belongsTo(ChildCategory::class,'child_category_id');
    }

    public function get_child_child_category()
    {
        return $this->belongsTo(SubChildCategory::class,'sub_child_category_id');
    }

    public function get_product_avatars()
    {
        return $this->hasMany(ProductAvatar::class,'product_id');
    }

    public function get_attribute()
    {
        return $this->hasMany(Attribute::class,'product_id');
    }


}
