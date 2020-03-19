<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth as Auth;

use App\user as User;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    


    public function login()
    {
        return view('auth.login_user');
    }
    public function regis()
    {
        return view('auth.regis_user');
    }

    public function regisUser(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:199',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed'
            
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_image'=> 'ada',
            'password' => Hash::make($request->password),
            'status' => 0
        ]);
        $user = new User();
        $user = User::where('email', $request->email)->get();


         if(Auth::attempt(['email' => $request->email,'password'=> $request->password], true) ){
            Mail::to($request->email)->send(new UserRegisterMail($user[0], $request->name));

         } 

        return "gagal";
        return redirect()->back()->withInput($request->only('name','email'))->with('error', 'Please fill in all fields with valid value');
    }

    public function verify($token)
    {
        $user = user::where('email', $token)
            ->update([
                'status' => 1
            ]);
        if($user){
            
            return "anda berhasil verifikasi";
        }
        return "gagal melakukan verifikasi";
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
