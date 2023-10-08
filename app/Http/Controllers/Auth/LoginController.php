<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            return  $this->redirectTo='/admin/dashboard';
        }
        elseif (Auth::user()->hasRole('Sales')) {
            $this->redirectTo='/sales/sales/';
            return $this->redirectTo;           
        }elseif (Auth::user()->hasRole('Purchase')) {
            $this->redirectTo='/purchases/purchase/';
            return $this->redirectTo;           
        }elseif (Auth::user()->hasRole('Manager')) {
            $this->redirectTo='/manager/sales/';
            return $this->redirectTo;           
        }
      
       $this->middleware('guest')->except('logout');
   }
}
