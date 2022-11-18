<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return redirect()->route('login')->with('error', 'Credentials do not match');
    }
    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        // return redirect()->intended($this->redirectPath())->with('success', 'Login Successfully');
        return redirect()->route('home')->with('success', 'Login Successfully');
    }
    public function attemptLogin(Request $request)
    {    // check user role  
        $user = User::where(['email' => $request->email, 'is_active' => 1, 'is_deleted' => 0])->where(function($query) {
            $query->where('role','superadmin')
            ->orwhere(['role'=>'admin','role'=>'employee']);
        })->first();
        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                return $this->guard()->attempt(
                        ['email' => $request->email, 'password' => $request->password],
                        $request->filled('remember')
                    );
            }
        }
        return false;
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/')->with('success', 'Logout successfully');
    }
}
