<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BloodGroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
