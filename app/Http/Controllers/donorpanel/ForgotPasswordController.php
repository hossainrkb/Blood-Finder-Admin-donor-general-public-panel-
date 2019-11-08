<?php

namespace App\Http\Controllers\donorpanel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Password_reset;
use App\Models\Donor;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:donor');
    }


    public function showLinkRequestForm()
    {
        return view('donor_panel.d_forget_password.passwords.email');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
          
            'email' => ['required', 'string', 'email', 'max:100'],
            
        ]);
    }

    public function sendResetLinkEmail(Request $re)
    
    {
        $donor = Donor::Where('email', $re->email)->first();
        if($donor){
            $donor->code = str_random(10);
             $donor->pass_status = Null;
            $donor->save();
            $donor = array(
                'code'     =>  $donor['code'],
                'email'     =>  $donor['email'],
              
            );

            // $donor->notify(new VerifydonorRegistration($donor));
            Mail::send('donor_passreset', $donor, function ($message) use ($donor) {
                //$this->donor=$donor;
                $message->to($donor['email']);
                $message->subject('Donor Password Reset!');

                //$message->attach('Click here to Confirm .. ', $donor);
                // $message->markdown('holaemails', ['token' => $donor['remember_token']]);
                // $code = $donor["remember_token"];
                // return view('holaemails', compact('code'));
            });
            session()->flash('success', 'A password reset link has just been sent to you!');

            return back();
           
        }
        else{
            session()->flash('error', 'donor not found !');
            return back();
        }

    
    }


    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }
}
