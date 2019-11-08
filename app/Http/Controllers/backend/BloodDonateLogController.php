<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Moperator;
use App\Models\Blood_donate;
use App\Models\Blood_donate_log;
use Image;
use File;

class BloodDonateLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //SHOW log
    public function index()
    {
        
        $Blood_donate_log = Blood_donate_log::orderBy('id', 'DESC')->get();
        return view('backend.pages.donate.donate_log', compact( 'Blood_donate_log'));
    }
}
