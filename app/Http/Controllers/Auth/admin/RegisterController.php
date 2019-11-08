<?php

namespace App\Http\Controllers\Auth\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\VerifyAdminRegistration;
use Illuminate\Support\Facades\Crypt;
use App\Models\Moperator;
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
    protected $redirectTo = '/admin';

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
        return view('auth.admin.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $re)
    {
        $check_email = Admin::Where('a_email', $re->email)->first();
        $mo_code = substr($re->phone, 0, 3);
        $operator = Moperator::Where('mo_code', $mo_code)->first();
        if ($operator) {
            $phone = Admin::Where('a_phone', $re->phone)->first();
            if (!$phone) {
                if (!$check_email) {
                    $admin = Admin::create([
                        'a_name' => $re->name,
                        'a_email' => $re->email,
                        'a_phone' => $re->phone,
                       // 'password' => Hash::make($re->password),
                        'password' => Crypt::encryptString($re->password),
                        'a_token' => str_random(10),
                    ])->toArray();

                    // $admin->notify(new VerifyAdminRegistration($admin));
                    Mail::send('holaemails', $admin, function ($message) use ($admin) {
                        //$this->admin=$admin;
                        $message->to($admin['a_email']);
                        $message->subject('Verify your Email Admin!');

                        //$message->attach('Click here to Confirm .. ', $admin);
                        // $message->markdown('holaemails', ['token' => $admin['remember_token']]);
                        // $code = $admin["remember_token"];
                        // return view('holaemails', compact('code'));
                    });
                    session()->flash('success', 'A conformation message has sent to you... please confirm it!');

                    return back();
                } else {
                    session()->flash('error', 'This email has already registered!');
                    return back();
                }
            }
                else {
                # code...
                session()->flash('error', 'This phone number already added!');
                return back();
                }
           
        }
        else {
            # code...
            session()->flash('error', 'Mobile number is not valid !');

            return back();
        }
    
      
    }
}
