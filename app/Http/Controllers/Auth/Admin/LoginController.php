<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/wmpanel/';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function username()
    {
        return 'login';
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/wmpanel/');
    }

    public function showLoginForm()
    {
        return view('admin.page.login');
    }

    public function login(Request $request)
    {

        // Validate the form data
        $this->validate($request, [
            'login'   => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['login' => $request->login, 'password' => $request->password], true))
        {
            // Аутентификация прошла успешно
            return redirect()->intended(route('admin.index'));
        }

        // if unsuccessful, then redirect back to the login with the form data*/
        return redirect()->back()->with('loginFailed', true);
    }
}
