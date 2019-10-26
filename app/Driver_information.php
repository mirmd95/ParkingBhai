<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver_information extends Model
{
    public function users()
    {
    	return $this->belongsTo(Owner_information::class,'user_id');
    }
}
