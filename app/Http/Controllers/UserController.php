<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth as Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\user as User;
use App\Mail\UserRegisterMail;
use App\Mail\ResetPassMail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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


        //  if(Auth::attempt(['email' => $request->email,'password'=> $request->password], true) ){


        //  } 
       if(Mail::to($request->email)->send(new UserRegisterMail($user[0], $request->name))){
            return view('auth.user_email_confirmed');
       }
        

        return redirect()->back()->withInput($request->only('name','email'))->with('error', 'Please fill in all fields with valid value');
    }

    public function verify($token)
    {
        $email = Crypt::decryptString($token);
        $user = user::where('email','=',$email)->update(['email_verified_at' => Carbon::now()->toDateTimeString()]);
        if($user){

            return redirect()->route('user.login');
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

    public function forget()
    {
        return  view('auth.reset_password');
    }

    public function forgetPass(Request $request)
    {
        $request->validate([
            'email' => ['required']
        ]);
        
        $user = User::where('email','=',$request->email)->first();
        // dd($user);
        if ($user->email == null) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(12),
            'created_at' => Carbon::now()
        ]);

        $reset =DB::table('password_resets')->where('email','=', $request->email)->first();
        
        if(Mail::to($request->email)->send(new ResetPassMail($user, $reset->token))){
            $request->session()->flash('success', 'Berhasil mereset password, silahkan anda cek email');
            return redirect()->back();
        }

        return redirect()->back()->withInput($request->only('name', 'email'))->with('success', 'Berhasil mereset password, silahkan anda cek email');
        
    }

    public function reset($token)
    {
        $reset = DB::table('password_resets')->where('token', '=', $token)->first();

        $user = User::where('email', '=', $reset->email)->first();

        return view('auth.new_pass',compact('user'));

    }

    public function resetPass(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        
       if($user->save()){
            return redirect()->intended(route('user.login'))->with('success', 'Berhasil mengganti password');
       }
        return redirect()->back()->with('error', 'Gagal mengganti password'); 

    }


}
