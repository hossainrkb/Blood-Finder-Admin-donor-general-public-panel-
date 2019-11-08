<?php

namespace App\Models;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Donor extends Authenticatable
{
    /*
    protected $fillable = [
        'd_user_id', 'name', 'phone', 'code', 'email', 'password', 'dob', 'sex_id', 'blood_group_id', 'd_image', 'status'

    ];
    */
    public function isOnline()
    {
        return Cache::has('donor-is-online-' . $this->id);
    }
}
