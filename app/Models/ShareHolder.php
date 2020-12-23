<?php

namespace App\Models;

use App\User;
use App\Models\Nominee;
use App\Models\ShareHolderLevel;
use Illuminate\Database\Eloquent\Model;

class ShareHolder extends Model
{
    protected $guarded =[];

    public function get_users(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function get_nominees(){
        return $this->hasOne(Nominee::class,'share_holder_id');
    }

    public function get_share_holder_level(){
        return $this->belongsTo(ShareHolderLevel::class,'share_holder_level_id');
    }

    public function get_share_holder_payment_history(){
        return $this->hasOne(ShareHolderPaymentHistory::class,'share_holder_id');

    }

}
