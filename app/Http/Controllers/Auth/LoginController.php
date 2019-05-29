<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/order/adresse';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticateBackend(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials) && Auth::user()->hasRole('admin')){
            return redirect(route('backend_homepage'));
        }
        // si l'acces est impossible, on redirige sur le formulaire de login
        else{
            Auth::logout();
            return redirect(route('backend_login'))->with('danger','Impossible de vous identifier');
        }
    }
}
