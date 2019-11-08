<?php

namespace App\Http\Controllers\mango_people;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Admin;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\Moperator;
use App\Models\Blood_request;
use Illuminate\Support\Facades\Crypt;
class PageController extends Controller

{

    
    //SHOW mango
    public function index()
    {
       
        $bg = Blood_group::orderBy('id')->get();
        $Division = Division::orderBy('div_id')->get();
        $District = District::orderBy('dis_id')->get();
        $Upazila = Upazila::orderBy('upa_id')->get();
        $Union = Union::orderBy('uni_id')->get();
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('mango_people_panel.pages.index',
        compact('sliders', 'bg', 'Division', 'District', 'Upazila', 'Union'));
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
    //send request

    public function send_request(Request $re)
    {
        $re->validate(
            [
                'cell' =>           'required',
                'donor_id' =>           'required',
                'mess' =>                     'required',
                'request_date' =>                     'required',
              
            ],
            [
                'cell.required' => 'Please drop your contact number',
                'mess.required' => 'Please drop your message ',

            ]
        );

        $mo_code = substr($re->cell, 0, 3);
        $br = new Blood_request;
        $operator = Moperator::Where('mo_code', $mo_code)->first();
       
        if ($operator) {
         // dd($re->request_date);
            $br->d_id = $re->donor_id;
            $br->r_phone = $re->cell;
            $br->r_message = $re->mess;
            $br->date_time = $re->request_date ;
            $br->status = 0;
            $br->save();
            
        } else {
            session()->flash('error', 'Contact number is not valid!');
            return redirect()->back();
        }
        session()->flash('success', 'Message successfully sent!');
        return redirect()->back();
    }
}
