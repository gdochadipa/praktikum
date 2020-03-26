<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin as Admin;
use Auth as Auth;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function dashboard()
    {
        //   return view('layout.homeAdmin');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => ['required', 'exists:admins,username'],
            'password' => ['required']
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
