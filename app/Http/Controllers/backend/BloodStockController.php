<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sex;
use App\Models\Donor;
use App\Models\Blood_group;
use App\Models\Moperator;
use App\Models\Blood_stock;
use Image;
use File;

class BloodStockController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
     //SHOW Stock
     public function index()
     {
         $blood_group = Blood_group::orderBy('id')->get();
         $blood_stock = Blood_stock::orderBy('id')->get();
         return view('backend.pages.stock.index',compact('blood_group','blood_stock'));
     }
      //SHOW CREATE PAGE
      public function create()
      {
          
          $bg = Blood_group::orderBy('id')->get();
          return view('backend.pages.stock.create',compact('bg'));
      }

      //STORE stock

    public function store(Request $re)
    {
     $re->validate([
     's_blood_group' =>           'required',
     's_collection' =>                     'required',
     's_expiration' =>                     'required',



 ],
 [
    's_blood_group.required' =>'Please provide Blood group',
    's_collection.required' =>'Please provide collection date ',
    's_expiration.required' =>'Please provide expiration date ',

 ]
);

            $Blood_stock= new Blood_stock;
        $blood_id = Blood_stock::Where('blood_id',$re->s_blood_group)->first();
        if(!$blood_id){
            
            $Blood_stock->c_date= $re->s_collection;
            $Blood_stock->e_date= $re->s_expiration;
            $Blood_stock->blood_id= $re->s_blood_group;
            
            $Blood_stock->status=1;
            $Blood_stock->admin_id=1;
            $Blood_stock->save();
        }
        else{
            session()->flash('error','This Blood group has already added!');
        return redirect()->route('admin.stock.create');
        }

    



session()->flash('success','Stock Successfully Added!');
      return redirect()->route('admin.stock.create');
    }
    //DELETE Stock
public function destroy($perameter)
{
  $Blood_stock = Blood_stock::find($perameter);
  if(!is_null($Blood_stock))
  {
    //Delete Donor Image
    //if(File::exists('img/donors/' . $donor->d_image)){
    //  File::delete('img/donors/' . $donor->d_image);
    //}
    $Blood_stock->delete();
  }
  session()->flash('success','Successfully deleted it!');
  return back();
}

  //update stock

  public function update(Request $re,$perameter)
  {
   $re->validate([
  
   's_collection' =>                     'required',
   's_expiration' =>                     'required',



],
[
  
  's_collection.required' =>'Please provide collection date ',
  's_expiration.required' =>'Please provide expiration date ',

]
);

    $Blood_stock = Blood_stock::find($perameter);
          
          $Blood_stock->c_date= $re->s_collection;
          $Blood_stock->e_date= $re->s_expiration;
          $Blood_stock->status=1;
          $Blood_stock->admin_id=1;
          $Blood_stock->save();
    
session()->flash('success','Stock Successfully updated!');
    return redirect()->back();
  }
}
