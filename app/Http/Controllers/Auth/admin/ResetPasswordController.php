<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest:admin');
    }
    public function showResetForm($token = null)
    {

   
        $Admin = Admin::where('a_token', $token)->first();
        if (!is_null($Admin)) {
            $Admin->pass_status = 1;
            $Admin->a_token = NULL;
            $Admin->save();
            
            return view('auth.admin.passwords.reset', compact('Admin'));


        } else {
            session()->flash('error', 'Sorry your token is not matched ');
            return back();
        }

        
    }


    //STORE CATEGORY

    public function reset(Request $re)
    {
     $re->validate([
     'email' =>           'required|max:150',
     'password' =>           'required|max:150',
    

 ],
 [
    'email.required' =>'Please provide admin"s email',
    'password.required' =>'Please provide admin"s password ',
    'd_dob.required' =>'Please provide Donor"s death of birth ',
    'd_number.required' =>'Contact number length isn"t true ',

 ]
);

       $Admin = Admin::where('a_email', $re->email)->first();
      if($Admin){
            $Admin->password= Crypt::encryptString($re->password);
            $Admin->save();
session()->flash('success','Password successfully reseted!');
       return redirect()->route('admin.login');
      }
      else{
        session()->flash('error','Admin not found');
        return back();
      }
    }
}
