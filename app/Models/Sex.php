<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    public function donor(){
        return $this->hasMany(Donor ::class,"id");
    }
}
