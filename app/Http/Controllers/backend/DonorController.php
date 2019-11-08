<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Moperator;
use App\SendCode;
use App\Models\Blood_donate_log;
use App\Models\Blood_donate;
use App\Models\Blood_request;
use App\Models\Division;
use Image;
use File;
use Illuminate\Support\Facades\Crypt;
use Mail;

class DonorController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
     //SHOW donor
     public function index()
     {
         $donor = Donor::orderBy('id')->Where('status',1)->get();
         return view('backend.pages.donor.index',compact('donor'));
     }
    //SHOW CREATE PAGE
    public function create()
    {
        $sex = Sex::orderBy('id')->get();
        $bg = Blood_group::orderBy('id')->get();
       $Division = Division::orderBy('div_id')->get();

        return view('backend.pages.donor.create',compact('sex','bg', 'Division'));
    }

    //STORE Donor

    public function store(Request $re)
    {
     $re->validate([
     'd_name' =>           'required|max:150',
     'd_password' =>           'required|max:150',
     'd_sex' =>                     'required',
     'd_blood_group' =>           'required',
     'd_dob' =>                     'required',
     'd_number' =>                     'required',
     'd_email' =>                     'required',



 ],
 [
    'name.required' =>'Please provide Donor name',
    'd_password.required' =>'Please provide Donor"s password ',
    'd_dob.required' =>'Please provide Donor"s death of birth ',
    'd_number.required' =>'Contact number length isn"t true ',
    'd_email.required' =>'Drop your email please ',

 ]
);

$mo_code = substr($re->d_number,0,3);
      $donor= new Donor;
      $operator = Moperator::Where('mo_code',$mo_code)->first();
      if($operator){
        $phone = Donor::Where('phone',$re->d_number)->first();
       $email = Donor::Where('email', $re->d_email)->first();
      if (!$email) {
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
      } else {
        session()->flash('error', 'This Email has been added already!');
        return redirect()->route('donor.register');
      }

      }
      else{
        session()->flash('error','Contact number is not valid!');
        return redirect()->route('admin.donor.create');
      }



session()->flash('success','A verification code has been sent to you! please confirm it');
      return redirect()->route('admin.donor.register.code');
    }

      //donor EDIT
      public function edit($perameter)
      {
        $sex = Sex::orderBy('id')->get();
        $bg = Blood_group::orderBy('id')->get();
        $edit_donor = Donor::find($perameter);
        if(!is_null($edit_donor)){
          return view ('backend.pages.donor.edit', compact('edit_donor','sex','bg'));
        }
        else{
            return redirect()->route('admin.donor');
        }
      }

        //UPDATE donor
        public function update(Request $re,$perameter)
        {
          $re->validate([
            'd_name' =>           'required|max:150',
            
           
            'd_dob' =>                     'required',
            'd_number' =>                     'required',
       
       
       
        ],
        [
           'name.required' =>'Please provide Donor name',
           'd_dob.required' =>'Please provide Donor"s death of birth ',
           'd_number.required' =>'Contact number length isn"t true ',
         
       
        ]
       );
       $donor = Donor::find($perameter);
      $mo_code = substr($re->d_number,0,3);
      $operator = Moperator::Where('mo_code',$mo_code)->first();
if($operator){
   $phone = Donor::Where('phone',$re->d_number)->first();
      $check_email = Donor::Where('email', $re->d_email)->first();

      if (is_null($phone)) {
        // dd($check_email['email']);
       
        if (is_null($check_email['email'])) {
        
    $donor->name= $re->d_name;
    $donor->phone= $re->d_number;
    $donor->email= $re->d_email;
    $donor->dob= $re->d_dob;
    $donor->blood_group_id= $re->d_blood_group;
    $donor->sex_id= $re->d_sex;
    $donor->status=1;
    $donor->admin_id=1;
    $donor->save();
   }
   
   else{
          
    if(($check_email['id'] == $donor['id']) ){
      // $email = Donor::Where('email',$re->d_email)->first();
     // if(!$email){
      
       $donor->name= $re->d_name;
       $donor->phone= $re->d_number;
       $donor->email= $re->d_email;
       $donor->dob= $re->d_dob;
       $donor->blood_group_id= $re->d_blood_group;
       $donor->sex_id= $re->d_sex;
       $donor->status=1;
       $donor->admin_id=1;
       $donor->save();
     // }
     // else{
       //session()->flash('error','This E-mail address has been added already!');
      // return redirect()->back();
    //  }
     }
     else{
         session()->flash('error','This E-mail address has been added already!!');
     return redirect()->back();
     }
   }
   

  }
   else{
     //dd("phoen same");
    if(($phone['id'] == $donor['id']) ){
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
            $donor->status = 1;
            $donor->admin_id = 1;
            $donor->save();
     // }
     // else{
       //session()->flash('error','This E-mail address has been added already!');
      // return redirect()->back();
    //  }
          }
          else{
            if (($check_email['id'] == $donor['id'])) {
              // $email = Donor::Where('email',$re->d_email)->first();
              // if(!$email){

              $donor->name = $re->d_name;
              $donor->phone = $re->d_number;
              $donor->email = $re->d_email;
              $donor->dob = $re->d_dob;
              $donor->blood_group_id = $re->d_blood_group;
              $donor->sex_id = $re->d_sex;
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

  
     }
     else{
         session()->flash('error','This Contact number has been added already!');
     return redirect()->back();
     }
   }
  

}
else{
  session()->flash('error','Contact number is not valid!');
  return redirect()->back();
}



session()->flash('success','Donor Successfully Added!');
return redirect()->back();
         
        }

//DELETE donor
public function destroy($perameter)
{
  
  $donor = Donor::find($perameter);
 //  dd($donor['blood_group_id']);
  if(!is_null($donor))
  {


      $donor_log = Blood_donate_log::orderBy('id', 'desc')->where('d_id', $donor->id)->get();
      $Blood_request = Blood_request::orderBy('id', 'desc')->where('d_id', $donor->id)->get();
      $Blood_donate = Blood_donate::where('d_id', $donor->id)->first();
      if(!is_null($Blood_donate)){
      $Blood_donate->delete();
      }
      foreach ($donor_log as $d_log) {
        
        $d_log->delete();
        }
      foreach ($Blood_request as $b_req) {
        
        $b_req->delete();
        }
          $bg = Blood_group::orderBy('id')->get();
            $total = 0;
      foreach ($bg as $b) {
          if ($b->id == $donor->blood_group_id) {
              $total = $b->count - 1;
              $b->count = $total;
             
              $b->save();
               $donor->delete();
                      }
                  }
   
  }
  session()->flash('success','Successfully deleted it!');
  return back();
}

   //donor details
   public function details($perameter)
   {
     $sex = Sex::orderBy('id')->get();
     $bg = Blood_group::orderBy('id')->get();
     $detail_donor = Donor::find($perameter);
    $donor_log = Blood_donate_log::orderBy('id', 'desc')->where('d_id', $perameter)->get();
     if(!is_null($detail_donor)){
       return view ('backend.pages.donor.details', compact('detail_donor','sex','bg', 'donor_log'));
     }
     else{
         return redirect()->route('admin.donor');
     }
   }

     //UPDATE dp
     public function dp(Request $re,$perameter)
     {
      $re->validate([
      'dp' =>           'required'
      
  ]);
  $detail_donor = Donor::find($perameter);
    
         if ($re->hasfile('dp')) {
           if(File::exists('img/donors/' . $detail_donor->d_image)){
             File::delete('img/donors/' . $detail_donor->d_image);
           }
           // insert image
           $image = $re->file('dp');
           $img=time(). '.' .$image->getClientOriginalExtension();
           $location = public_path('img/donors/' . $img);
           Image:: make($image)->save($location);

           $detail_donor->d_image=$img;
         }
             $detail_donor->save();


             session()->flash('success','DP successfully updated!');
             return back();
     }
       //verification code
    public function showVerificationForm()
    {
      return view('backend.pages.donor.donorverification');
    }

    //verify

       public function verify(Request $re)
    {
        $donor = Donor::where('code', $re->v_code)->first();
        if (!is_null($donor)) {
            $donor->status = 1;
            $donor->code = NULL;
            $donor->save();
            session()->flash('success', 'Verification successfully done!! ');
            return redirect()->route('admin.donor');
        } else {
            session()->flash('error', 'Sorry your token is expired ! ');
            return redirect()->route('admin.donor.register.code');
        }
    }

     
}