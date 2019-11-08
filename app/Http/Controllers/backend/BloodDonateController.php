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

class BloodDonateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //SHOW donate PAGE
    public function create()
    {
        $donor_list = Donor::orderBy('id')->get();
        return view('backend.pages.donate.blood_donate',compact('donor_list'));
    }

    //STORE donate

    public function store_donate(Request $re)
    {
     $re->validate([
     'dod' =>           'required',
 ],
 [
    'dod.required' =>'Please provide donate date, Thank you',
 ]
);

            $Blood_donate= new Blood_donate;
            $Blood_donate_log= new Blood_donate_log;
      
            
            $Blood_donate->d_id= $re->donor_id;
            $Blood_donate->dod= $re->dod;
            $Blood_donate->status= 1;
            $Blood_donate->admin_id=1;
            $Blood_donate->save();
            //log
            $Blood_donate_log->d_id= $re->donor_id;
            $Blood_donate_log->dod= $re->dod;
            $Blood_donate_log->status= 1;
            $Blood_donate_log->admin_id=1;
            $Blood_donate_log->save();
session()->flash('success','Donate date successfully added!');
      return redirect()->back();
    }

     //UPDATE donate
     public function update_donate(Request $re,$perameter)
     {
        $re->validate([
            'u_dod' =>           'required',
        ],
        [
           'u_dod.required' =>'Please provide update donate date, Thank you',
        ]);
    $Blood_donate = Blood_donate::find($perameter);

 if(!(is_null($Blood_donate))){
    $Blood_donate_log= new Blood_donate_log;   
    $Blood_donate->d_id= $re->donor_id;
    $Blood_donate->dod= $re->u_dod;
    $Blood_donate->status= 1;
    $Blood_donate->admin_id=1;
    $Blood_donate->save();
    //log
    $Blood_donate_log->d_id= $re->donor_id;
    $Blood_donate_log->dod= $re->u_dod;
    $Blood_donate_log->status= 1;
    $Blood_donate_log->admin_id=1;
    $Blood_donate_log->save();
}

else{
      session()->flash('error','This user is not found');
        return redirect()->back();
 
}

session()->flash('success','Donate date has been updated, Thank you');
return redirect()->back();
      
     }

  





 

     
}
