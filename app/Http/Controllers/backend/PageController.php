<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class PageController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //SHOW log
    public function index()
    {

       // $Blood_donate_log = Blood_donate_log::orderBy('id', 'DESC')->get();
        return view('backend.pages.index');
    }
    public function d_index()
    {

       // $Blood_donate_log = Blood_donate_log::orderBy('id', 'DESC')->get();
        return view('backend.pages.admin_details');
    }

    //Search
    public function search_donor_bg()
    {

        $Blood_group = Blood_group::orderBy('id')->get();
        return view('backend.pages.index', compact('Blood_group'));
    }
    //Search member

    /*   public function search(Request $re)
    {
        $re->validate(
            [
                'donor' =>           'required',
            ],
            [
                'donor.required' => 'Please provide member info',
            ]);

        $Donor = Donor::Where('d_user_id', $re->donor)
            ->orWhere('phone', $re->donor)
            ->first();

       
        if (!(is_null($Donor))) {

            //session()->flash('error', 'This Blood group has already added!');
            return view('backend.pages.index', compact('Donor'));
            
        } else {
            session()->flash('error', 'Donor is not found');
            return redirect()->back();
        }

    }*/

    //UPDATE password
    public function update(Request $re, $perameter)
    {
    
        $re->validate(
            [
                'c_pass' =>           'required|max:150',
                'n_pass' =>           'required|max:150',
                're_pass' =>           'required|max:150',

            ],
            [
                'c_pass.required' => 'Please provide old password',
                'n_pass.required' => 'Please provide new password ',
                're_pass.required' => 'Please provide re-type password ',


            ]
        );
        $admin = Admin::find($perameter);
       // $c_pass =Hash::make($re->c_pass);
        //dd($c_pass);
       
      
        if (Crypt::decryptString($admin['password'])  == $re->c_pass  ) {
          
           
           
            if ($re->n_pass != $re->c_pass) {
            if ($re->n_pass == $re->re_pass) {
                    $new_pass = Crypt::encryptString($re->n_pass);
                    $re_type_pass = Crypt::encryptString($re->re_pass);
                    $admin->password = $new_pass;
                    $admin->save();
                    session()->flash('success', 'Password Successfully Changed!');
                    return redirect()->back();

                } else {
                    session()->flash('error', 'Confirm password did not not match !');
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'New password should not be same as old password ! ');
                return redirect()->back();
          
            }
        } else {
            session()->flash('error', 'Current password does not match');
            return redirect()->back();
        }



        
    }
}
