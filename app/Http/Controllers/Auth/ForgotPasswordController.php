<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;

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
    
    public function credentials(Request $request)
    {   
        $user = User::where(['email' => $request->email, 'is_active' => 1, 'is_deleted' => 0])->where(function($query) {
            $query->where('role','superadmin')
            ->orwhere(['role'=>'admin','role'=>'employee']);
        })->first();
        if(!empty($user)){
            return [
                'email' => $request->input('email'),
                'is_deleted' => 0
            ];
        }else{
            return redirect()->route('login')->with('error', 'Email not available');
        }
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
}
