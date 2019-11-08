<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $Admin = Admin::where('a_token', $token)->first();
        if (!is_null($Admin)) {
            $Admin->status = 1;
            $Admin->a_token = NULL;
            $Admin->save();
            session()->flash('success', 'Verification successfully done!! Login now');
            return redirect()->route('admin.login');
        } else {
            session()->flash('error', 'Sorry your token is not matched ');
            return back();
        }
    }
}
