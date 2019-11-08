<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Donor;
use App\Models\Blood_group;

class LaravelGoogleGraph extends Controller
{
    function index()
    {
      
        $bg = Blood_group::orderBy('id')->get();
       
        foreach ($bg as $hola){
            $donor = Donor::Where('blood_group_id', $$bg->id)->get();
        }
    
      
        $data = DB::table('blood_groups')
            ->select(
                DB::raw('bg_name as genderk'),
                DB::raw('count(*) as number')
            )
            ->groupBy('genderk')
            ->get();
        $array[] = ['Gender', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->genderk, $value->number];
        }
        return view('google_pie_chart')->with('genderp', json_encode($array));
    }

    public function stat(){
        $data = DB::table('blood_groups')->get(['bg_name','count']);
        return view('chartH')->with('data', $data);
    }
}
