<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Moperator;
use App\Models\Slider;
use App\SendCode;
use App\Models\Blood_donate_log;
use Image;
use File;

class SliderController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
     //SHOW donor
     public function index()
     {
         $slider = Slider::orderBy('priority')->get();
         return view('backend.pages.slider.index',compact('slider'));
     }
    //SHOW CREATE PAGE
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    //STORE slide

    public function store(Request $re)
    {
     $re->validate([
     'title' =>           'required|max:150',
     'img' =>           'required',
     'prio' =>                     'required',
     'button' =>           'required',
     'link' =>                     'required',
 ],
 [
    'title.required' =>'Enter title',
    'img.required' =>'Add image ',
    'prio.required' =>'Enter priority ',
    'button.required' =>'Enter you button name ',
    'link.required' =>'Enter link ',

 ]
);
  $slide= new Slider;
    if ($re->hasfile('img')) {
           if(File::exists('img/sliders/' . $slide->image)){
             File::delete('img/sliders/' . $slide->image);
           }
           // insert image
           $image = $re->file('img');
           $img=time(). '.' .$image->getClientOriginalExtension();
           $location = public_path('img/sliders/' . $img);
           Image:: make($image)->save($location);

           $slide->image=$img;
         }
 
          $slide->title = $re->title;
          $slide->button = $re->button;
          $slide->link = $re->link;
          $slide->priority = $re->prio;
          $slide->save();
           session()->flash('success','Slide successfully added');
    return redirect()->route('admin.slider');

    }
    //DELETE slide
public function destroy($perameter)
{
  $slide = Slider::find($perameter);
  if(!is_null($slide))
  { if(File::exists('img/sliders/' . $slide->image)){
                 File::delete('img/sliders/' . $slide->image);
               }

    $slide->delete();
  }
  session()->flash('success','Successfully deleted it!');
  return back();
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

     
}