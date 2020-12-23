<?php

namespace App\Models;

use App\Models\ShareHolder;
use Illuminate\Database\Eloquent\Model;

class ShareHolderLevel extends Model
{
    protected $guarded = [];

    public function get_users(){
        return $this->hasMany(User::class,'share_holder_level_id');
    }

    public function get_share_holders(){
        return $this->hasMany(ShareHolder::class,'share_holder_level_id');
    }
}
