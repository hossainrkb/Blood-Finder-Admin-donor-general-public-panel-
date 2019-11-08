<?php

namespace App\Http\Controllers\donorpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donor;

class VerificationController extends Controller
{
    public function verify(Request $re)
    {
        $donor = Donor::where('code', $re->v_code)->first();
        if (!is_null($donor)) {
            $donor->status = 1;
            $donor->code = NULL;
            $donor->save();
            session()->flash('success', 'Verification successfully done!! Login now');
            return redirect()->route('donor.login');
        } else {
            session()->flash('error', 'Sorry your token is expired ! ');
            return redirect()->route('donor.register.code');
        }
    }
}
