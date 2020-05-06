<?php

namespace App\Http\Controllers;
use App\courier;
use App\transaction;
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
           return view('layout.admin.homeAdmin');
    }

    public function product()
    {
       //
    }

    public function users()
    {
        return view('layout.admin.user');
    }

    public function transaction()
    {
        return view('layout.admin.transaction');
    }

    public function product_categories()
    {
       //
    }

    public function courier()
    {
        //
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

        return redirect()->back()->withInput($request->only('email', 'remember'))->with("error", "Failed Login");;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.loginForm');
    }
}
