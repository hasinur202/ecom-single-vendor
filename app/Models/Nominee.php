<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShareHolder;

class Nominee extends Model
{
    protected $guarded =[];

    public function get_holders(){
        return $this->belongsTo(ShareHolder::class,'share_holder_id');
    }
}
