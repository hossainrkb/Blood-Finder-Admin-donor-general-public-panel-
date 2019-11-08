<?php

namespace App\Http\Controllers\donorpanel;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\VerifyAdminRegistration;
use Illuminate\Support\Facades\Crypt;
use App\Models\Moperator;
use App\Models\Sex;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\Donor;
use App\Models\Blood_group;
use Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/donor_panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*
    @override korsi
    Display the registration form.
     * @return void
    */
    public function showRegistrationForm()
    {
        $sex = Sex::orderBy('id')->get();
        $bg = Blood_group::orderBy('id')->get();
        $Division = Division::orderBy('div_id')->get();
        $District = District::orderBy('dis_id')->get();
        $Upazila = Upazila::orderBy('upa_id')->get();
        $Union = Union::orderBy('uni_id')->get();
        return view('donor_panel.d_register.pages.register', 
        compact('sex', 'bg', 'Division', 'District', 'Upazila', 'Union'));
    }

    //verification code
    public function showVerificationForm()
    {
      return view('donor_panel.d_register.pages.registerverificationcode');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    //STORE Donor

    public function store(Request $re)
    {
        $re->validate(
            [
                'd_name' =>           'required|max:150',
                'd_password' =>           'required|max:150',
                'd_sex' =>                     'required',
                'd_blood_group' =>           'required',
                'd_dob' =>                     'required',
                'd_number' =>                     'required',
                'd_email' =>                     'required',



            ],
            [
                'name.required' => 'Please provide Donor name',
                'd_password.required' => 'Please provide Donor"s password ',
                'd_dob.required' => 'Please provide Donor"s death of birth ',
                'd_number.required' => 'Contact number length isn"t true ',
                'd_email.required' => 'Email is required',

            ]
        );

        $mo_code = substr($re->d_number, 0, 3);
        $donor = new Donor;
        $operator = Moperator::Where('mo_code', $mo_code)->first();
        $email = Donor::Where('email', $re->d_email)->first();
        if ($operator) {
            $phone = Donor::Where('phone', $re->d_number)->first();
           if(!$email){
                if (!$phone) {
                    $userkey = $re->d_userid;
                    //  $donor->d_user_id= "D".$userkey;
                    $donorid = Donor::Where('d_user_id', "D" . $userkey)->first();
                    if (!$donorid) {
                        $bg = Blood_group::orderBy('id')->get();
                        $total = 0;
                        foreach ($bg as $b) {
                            if ($b->id == $re->d_blood_group) {
                                $total = $b->count + 1;
                                $b->count = $total;
                                $b->save();
                            }
                        }

                        $donor->d_user_id = "D" . $userkey;
                        $donor->name = $re->d_name;
                        $donor->phone = $re->d_number;
                        $donor->email = $re->d_email;
                        $donor->password =  Crypt::encryptString($re->d_password);
                        $donor->dob = $re->d_dob;
                        $donor->blood_group_id = $re->d_blood_group;
                        $donor->sex_id = $re->d_sex;
                        $donor->d_division = $re->div;
                        $donor->d_district = $re->dis;
                        $donor->d_upazila = $re->upa;
                        $donor->d_union = $re->uni;
                        $donor->status = 0;
                        $donor->admin_id = 1;
                        $donor->code = $re->code;
                       
                       // $donor = Donor::Where('email', $re->d_email)->first();
                        $hola = array(
                            'code'     =>  $re->code,
                            'email'     =>  $re->d_email,

                        );
                        //$donor->code = SendCode::sendCode($donor->phone);
                       
                        // $admin->notify(new VerifyAdminRegistration($admin));
                        Mail::send('donor_verify', $hola, function ($message) use ($hola) {
                            //$this->hola=$hola;
                            $message->to($hola['email']);
                            $message->subject('Verify your Email donor!');

                            //$message->attach('Click here to Confirm .. ', $admin);
                            // $message->markdown('holaemails', ['token' => $admin['remember_token']]);
                            // $code = $admin["remember_token"];
                            // return view('holaemails', compact('code'));
                        });
                        $donor->save();
                    } else {
                        session()->flash('error', 'This donor id has already given!');
                        return redirect()->route('donor.register');
                    }
                } else {
                    session()->flash('error', 'This Contact number has been added already!');
                    return redirect()->route('donor.register');
                }
           }

           else{
                session()->flash('error', 'This Email has been added already!');
                return redirect()->route('donor.register');
           }
        } else {
            session()->flash('error', 'Contact number is not valid!');
            return redirect()->route('donor.register');
        }



        session()->flash('success', 'Verification link has been sent to you!');
        return redirect()->route('donor.register.code');
    }
}
