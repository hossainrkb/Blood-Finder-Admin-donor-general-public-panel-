<?php

namespace App\Http\Controllers\donorpanel;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
class LoginController extends Controller
{
 
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/donor';
  public function __construct()
  {
    $this->middleware('guest:donor')->except('logout');
  }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

       public function showLoginForm()
    {
        return view('donor_panel.d_login.pages.login');
    }
//Admin login
     /*
      public function login(Request $request)
    {

      $request->validate([
          'email' => 'required|email',
          'password' => 'required|string',

      ]);
      //FIND USER BY EMAIL
      $admin = Admin::where('a_email',  $request->email)->first();
  if($admin){
    if($admin->status == 1){
          //Login korte parbe
      if(Auth :: guard ('admin') ->attempt(['a_email'=>$request->email , 'password' =>$request->password ] , $request->remember) ){
      return redirect()->intended(route('admin'));
    }
    else {
      // code...
      session()->flash('error', 'Invalid Login!');
        return redirect()->route("admin.login");
    }
    }
    else{
             session()->flash('error', 'Not activate this id yet');
        return redirect()->route("admin.login");
    }


  }
  else {
      session()->flash('error', 'No admin belongs to this email id');
    return redirect()->route("admin.login");

  }
    }
     */



  //Hola login

  public function login(Request $re)
  {

    $re->validate(
      [
        'email' => 'required|email',
        'password' => 'required|string',
      ],
      [
        'email.required' => 'Please provide email address',
        'password.required' => 'Please provide your password '
      ]
    );
    $donor = Donor::where('email',  $re->email)->first();
    if($donor){
      if (Crypt::decryptString($donor['password']) == $re->password)
      {
        if($donor['status']==1){
          // Auth::guard('admin');
          //return redirect()->route('admin');
          if (Auth::guard('donor')->attempt(['email' => $re->email])) {
                


//$donor_id =App\Models\Donor::where('id',Auth :: guard ('donor')->id() )->first() ;  
    $donor->donor_activity = now();
    $donor->save();
            return redirect()->intended(route('donor'));
          
          } else {
            // code...
            session()->flash('error', 'Invalid Login!');
            return redirect()->route("donor.login");
            
          }

        }
        else{
          session()->flash('error', 'Donor not activate yet ! ');
          return redirect()->back();
        }
      }
      else{
        session()->flash('error', 'Donor password not match ! ');
        return redirect()->back();
      }

    }
    else{
      session()->flash('error', 'Donor not found ! ');
      return redirect()->back();
    }

  }














    public function logout(Request $request)
    {
       // $this->guard()->logout();
        Auth::guard("donor")->logout();
       
        if ($this->middleware('auth:donor')){
      return back();
        }
        else{
      $request->session()->invalidate();
      return redirect()->route("donor.login");
        }

        
    }
}
