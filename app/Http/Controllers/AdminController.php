<?php

namespace App\Http\Controllers;
use App\courier;
use App\user;
use App\transaction;
use Illuminate\Http\Request;
use App\admin as Admin;
use App\Notifications\admin_notification;
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

    public function notifyAll()
    {
        return view('layout.admin.notifyAll');
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

        return redirect()->back()->withInput($request->only('email', 'remember'))->with("error", "Failed Login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.loginForm');
    }

    public function user()
    {
        $user = user::paginate(25);
        return view('layout.admin.user',compact('user'));
    }

    public function show(user $user)
    {
        return view('layout.admin.user.show', compact('user'));
    }

    public function status($id)
    {
        $user=user::find($id);
        if($user->status == 1){
            $user->status = '0'; 
        }else{
            $user->status = '1'; 
        }
        if($user->save()){
            return redirect()->intended(route('admin.users'))->with("successful", "success Change Status");
        }
        return redirect()->intended(route('admin.users'))->with("error", "Failed Change Status");
    }

    public function notify()
    {
        $admin = Admin::find(2);
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is our example notification tutorial',
            'thanks' => 'Thank you for visiting codechief.org!',
        ];
        
        $admin->notify(new admin_notification($details));
        return dd('done');
    }
}
