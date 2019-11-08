<?php

namespace App\Http\Controllers\Auth\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Password_reset;
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
        $this->middleware('guest:admin');
    }


    public function showLinkRequestForm()
    {
        return view('auth.admin.passwords.email');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
          
            'email' => ['required', 'string', 'email', 'max:100'],
            
        ]);
    }

    public function sendResetLinkEmail(Request $re)
    
    {
        $admin = Admin::Where('a_email', $re->email)->first();
        if($admin){
            $admin->a_token = str_random(10);
             $admin->pass_status = Null;
            $admin->save();
            $admin = array(
                'a_token'     =>  $admin['a_token'],
                'a_email'     =>  $admin['a_email'],
              
            );

            // $admin->notify(new VerifyAdminRegistration($admin));
            Mail::send('passreset', $admin, function ($message) use ($admin) {
                //$this->admin=$admin;
                $message->to($admin['a_email']);
                $message->subject('Password Reset!');

                //$message->attach('Click here to Confirm .. ', $admin);
                // $message->markdown('holaemails', ['token' => $admin['remember_token']]);
                // $code = $admin["remember_token"];
                // return view('holaemails', compact('code'));
            });
            session()->flash('success', 'A password reset link has just been sent to you!');

            return back();
           
        }
        else{
            session()->flash('error', 'User not found !');
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
