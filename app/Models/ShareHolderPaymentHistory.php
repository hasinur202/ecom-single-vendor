<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareHolderPaymentHistory extends Model
{
    protected $guarded = [];

    public function get_share_holder(){
        return $this->belongsTo(ShareHolder::class,'share_holder_id');
    }
}
