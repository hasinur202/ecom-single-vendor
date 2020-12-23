<?php

namespace App\Models;

use App\Models\CommisionDetails;
use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{
    protected $guarded =[];

    public function get_commisionDetails(){
        return $this->hasMany(CommisionDetails::class,'commision_id');
    }
}
