<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood_group extends Model
{
    public function donor(){
        return $this->hasMany(Donor ::class,"id");
    }
}
