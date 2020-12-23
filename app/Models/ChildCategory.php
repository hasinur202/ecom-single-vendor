<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable=[
        'child_name','category_id','slug'
    ];

    public function get_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function get_sub_child_category()
    {
        return $this->hasMany(SubChildCategory::class,'child_category_id');
    }

    public function get_product()
    {
        return $this->hasMany(Product::class,'child_category_id');
    }
}