<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Theme;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //Trait
    use AuthenticatesUsers;

    //Where to redirect after login
    protected $redirectTo = '/admin';

    //Shows login form
    public function showLoginForm()
    {
        $theme = Theme::uses('visitors');
        return Theme::scope('auth.login')->render();
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['active' => 1]);
    }

    public function logout() {
        Auth::logout();
        session()->flush();
        return redirect()->guest('admin');
    }
}