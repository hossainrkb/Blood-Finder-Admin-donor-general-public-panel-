<?php

namespace App\Http\Controllers\donorpanel;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Admin;
use App\Models\Donor;
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
    protected $redirectTo = '/donor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:donor');
    }
    public function showResetForm($token = null)
    {

   
        $Donor = Donor::where('code', $token)->first();
        if (!is_null($Donor)) {
            $Donor->pass_status = 1;
            $Donor->code = NULL;
            $Donor->save();
            
            return view('donor_panel.d_forget_password.passwords.reset', compact('Donor'));


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
    'name.required' =>'Please provide Donor name',
    'password.required' =>'Please provide Donor"s password ',
   
 ]
);

       $Donor = Donor::where('email', $re->email)->first();
      if($Donor){
            $Donor->password= Crypt::encryptString($re->password);
            $Donor->save();
session()->flash('success','Password successfully reseted!');
       return redirect()->route('donor.login');
      }
      else{
        session()->flash('error','donor not found');
        return back();
      }
    }
}
