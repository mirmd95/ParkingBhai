<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner_information extends Model
{
    public function users()
    {
    	return $this->belongsTo(Owner_information::class,'user_id');
    }
}

