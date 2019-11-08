<?php

namespace App\Http\Controllers\donorpanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Moperator;
use App\SendCode;
use App\Models\Blood_request;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Support\Facades\Crypt;
use Image;
use File;

class DonorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:donor');
    }

    public function index()
    {
        // $Blood_donate_log = Blood_donate_log::orderBy('id', 'DESC')->get();
        return view('donor_panel.pages.request_list');
    }

    //blood request details
    public function request_details($perameter)
    {
       
        $total_request = Blood_request::orderBy('id', 'desc')->where('r_phone', $perameter)->get();
        if (!is_null($total_request)) {
            return view('donor_panel.pages.request_details', compact('total_request', 'perameter'));
        } else {
            return redirect()->route('donor');
        }
    }

    //donor details
    public function details()
    {
        $sex = Sex::orderBy('id')->get();
        $bg = Blood_group::orderBy('id')->get();
        $division = Division::orderBy('div_id')->get();
        $district = District::orderBy('dis_id')->get();
        $upazila = Upazila::orderBy('upa_id')->get();
        $union = Union::orderBy('uni_id')->get();
        return view('donor_panel.pages.profile', compact( 'sex', 'bg', 'division', 'district', 'upazila', 'union'));
      
    }

    //UPDATE dp
    public function dp(Request $re, $perameter)
    {
        $re->validate([
            'dp' =>           'required'

        ]);
        $detail_donor = Donor::find($perameter);

        if ($re->hasfile('dp')) {
            if (File::exists('img/donors/' . $detail_donor->d_image)) {
                File::delete('img/donors/' . $detail_donor->d_image);
            }
            // insert image
            $image = $re->file('dp');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/donors/' . $img);
            Image::make($image)->save($location);

            $detail_donor->d_image = $img;
        }
        $detail_donor->save();


        session()->flash('success', 'DP successfully updated!');
        return back();
    }


    //donor EDIT
    public function edit($perameter)
    {
        $sex = Sex::orderBy('id')->get();
        $bg = Blood_group::orderBy('id')->get();
        $division = Division::orderBy('div_id')->get();
        $district = District::orderBy('dis_id')->get();
        $upazila = Upazila::orderBy('upa_id')->get();
        $union = Union::orderBy('uni_id')->get();
        $edit_donor = Donor::find($perameter);
        if (!is_null($edit_donor)) {
            return view('donor_panel.pages.edit', compact('edit_donor', 'sex', 'bg', 'division', 'district', 'upazila', 'union'));
        } else {
            return redirect()->route('donor.details');
        }
    }

    //UPDATE donor
    public function update(Request $re, $perameter)
    {
        $re->validate(
            [
                'd_name' =>           'required|max:150',
                'd_dob' =>                     'required',
                'd_number' =>                     'required',
                'd_email' =>                     'required',
               // 'd_div' =>                     'required',
               // 'd_dis' =>                     'required',
               // 'd_upa' =>                     'required',
               // 'd_uni' =>                     'required',



            ],
            [
                'name.required' => 'Please provide Donor name',
                'd_dob.required' => 'Please provide Donor"s death of birth ',
                'd_number.required' => 'Contact number length isn"t true ',
                'd_email.required' => 'Put your email ',
              //  'd_div.required' => 'Select division ',
              //  'd_dis.required' => 'Select district ',
              //  'd_upa.required' => 'Select upazila ',
               // 'd_uni.required' => 'Select union ',


            ]
        );
        $donor = Donor::find($perameter);
        $mo_code = substr($re->d_number, 0, 3);
        $operator = Moperator::Where('mo_code', $mo_code)->first();
        if ($operator) {
            $phone = Donor::Where('phone', $re->d_number)->first();
            $check_email = Donor::Where('email', $re->d_email)->first();

            if (is_null($phone)) {
                // dd($check_email['email']);

                if (is_null($check_email['email'])) {

                    $donor->name = $re->d_name;
                    $donor->phone = $re->d_number;
                    $donor->email = $re->d_email;
                    $donor->dob = $re->d_dob;
                    $donor->blood_group_id = $re->d_blood_group;
                    $donor->sex_id = $re->d_sex;
                    $donor->d_division = $re->d_div;
                    $donor->d_district = $re->d_dis;
                    $donor->d_upazila = $re->d_upa;
                    $donor->d_union = $re->d_uni;

                    $donor->status = 1;
                    $donor->admin_id = 1;
                    $donor->save();
                } else {

                    if (($check_email['id'] == $donor['id'])) {
                        // $email = Donor::Where('email',$re->d_email)->first();
                        // if(!$email){

                        $donor->name = $re->d_name;
                        $donor->phone = $re->d_number;
                        $donor->email = $re->d_email;
                        $donor->dob = $re->d_dob;
                        $donor->blood_group_id = $re->d_blood_group;
                        $donor->sex_id = $re->d_sex;
                        $donor->d_division = $re->d_div;
                        $donor->d_district = $re->d_dis;
                        $donor->d_upazila = $re->d_upa;
                        $donor->d_union = $re->d_uni;
                        $donor->status = 1;
                        $donor->admin_id = 1;
                        $donor->save();
                        // }
                        // else{
                        //session()->flash('error','This E-mail address has been added already!');
                        // return redirect()->back();
                        //  }
                    } else {
                        session()->flash('error', 'This E-mail address has been added already!!');
                        return redirect()->back();
                    }
                }
            } else {
                //dd("phoen same");
                if (($phone['id'] == $donor['id'])) {
                    //dd($check_email['email']);
                    if (is_null($check_email['email'])) {
                        // $email = Donor::Where('email',$re->d_email)->first();
                        // if(!$email){
                        $donor->name = $re->d_name;
                        $donor->phone = $re->d_number;
                        $donor->email = $re->d_email;
                        $donor->dob = $re->d_dob;
                        $donor->blood_group_id = $re->d_blood_group;
                        $donor->sex_id = $re->d_sex;
                        $donor->d_division = $re->d_div;
                        $donor->d_district = $re->d_dis;
                        $donor->d_upazila = $re->d_upa;
                        $donor->d_union = $re->d_uni;
                        $donor->status = 1;
                        $donor->admin_id = 1;
                        $donor->save();
                        // }
                        // else{
                        //session()->flash('error','This E-mail address has been added already!');
                        // return redirect()->back();
                        //  }
                    } else {
                        if (($check_email['id'] == $donor['id'])) {
                            // $email = Donor::Where('email',$re->d_email)->first();
                            // if(!$email){

                            $donor->name = $re->d_name;
                            $donor->phone = $re->d_number;
                            $donor->email = $re->d_email;
                            $donor->dob = $re->d_dob;
                            $donor->blood_group_id = $re->d_blood_group;
                            $donor->sex_id = $re->d_sex;
                            $donor->d_division = $re->d_div;
                            $donor->d_district = $re->d_dis;
                            $donor->d_upazila = $re->d_upa;
                            $donor->d_union = $re->d_uni;
                            $donor->status = 1;
                            $donor->admin_id = 1;
                            $donor->save();
                            // }
                            // else{
                            //session()->flash('error','This E-mail address has been added already!');
                            // return redirect()->back();
                            //  }
                        } else {
                            session()->flash('error', 'This E-mail address has been added already88!!');
                            return redirect()->back();
                        }
                    }
                } else {
                    session()->flash('error', 'This Contact number has been added already!');
                    return redirect()->back();
                }
            }
        } else {
            session()->flash('error', 'Contact number is not valid!');
            return redirect()->back();
        }



        session()->flash('success', 'Donor Successfully Updated!');
        return redirect()->back();
    }
    //pass update
    public function pass_up(Request $re, $perameter)
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
        $donor = Donor::find($perameter);
        // $c_pass =Hash::make($re->c_pass);
        //dd($c_pass);


        if (Crypt::decryptString($donor['password'])  == $re->c_pass) {



            if ($re->n_pass != $re->c_pass) {
                if ($re->n_pass == $re->re_pass) {
                    $new_pass = Crypt::encryptString($re->n_pass);
                    $re_type_pass = Crypt::encryptString($re->re_pass);
                    $donor->password = $new_pass;
                    $donor->save();
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