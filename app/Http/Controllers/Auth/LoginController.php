<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
    public function showLoginForm()
    {
        $rememberedEmail = Cookie::get('login_email');

        return view('auth.login', compact('rememberedEmail'));
    }
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Redirect to the login page with a logout message
        return redirect()->route('login')->with('logout_message', 'You have been logged out.');
    }
}
