<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use DB;

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
    protected $redirectTo = 'login';

    public function reset(Request $request)
    {
        $validator = [
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->with('error', join(", ",$validator->errors()->all()));
        }else{
            $user = User::where(['username' => $request->username, 'is_active' => 1, 'is_deleted' => 0])->where(function($query) {
                $query->where('role','superadmin')
                ->orwhere('role','admin')
                ->orWhere('role','employee');
            })->first();
            
            if(!empty($user) && ($user->email === $request->input('email'))){
                $user->password = Hash::make($request->input('password'));
                $user->save();
                event(new PasswordReset($user));
                return redirect()->route('login')->with('success', 'Reset password successfully.');
            }else{
                return redirect()->route('login')->with('error', 'Credentials do not match');
            }
        }
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        $tokenCheck = DB::table('password_resets')
        ->where('email',$request->email)
        ->first();

        if(Carbon::parse($tokenCheck->created_at)->addSeconds(60*60)->isPast()){
            return redirect()->route('login')->with('error', 'Link is expired');
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
