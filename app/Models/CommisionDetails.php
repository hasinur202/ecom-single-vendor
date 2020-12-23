<?php

namespace App\Models;

use App\Models\Commision;
use Illuminate\Database\Eloquent\Model;

class CommisionDetails extends Model
{
    protected $guarded =[];

    public function get_commision(){
        return $this->belongsTo(Commision::class,'commision_id');
    }
}
