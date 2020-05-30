<?php

namespace App\Http\Controllers;
use App\courier;
use App\user;
use App\transaction;
use Illuminate\Http\Request;
use App\admin as Admin;
use App\Notifications\admin_notification;
use Auth as Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    function getLastNDays($days, $format = 'd/m')
    {
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = '"' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '"';
        }
        return array_reverse($dateArray);
    }

    public function dashboard()
    {
        //jumlah transaksi tiap bulan
        //jumlah transaksi bulan ini udah
        //jumlah transaksi tahun ini
        //jumlah transaksi tiap tahun
        $allMonth = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $month = date('m');
        $year = date('Y');
        $today = date('d');
        $day = array();
        $count_this_mounth = DB::table('transactions')->whereMonth('created_at','=',$month)->whereYear('created_at', '=', $year)->count();
        $count_this_year = transaction::whereYear('created_at', '=', $year)->count();
        $count_this_day = DB::table('transactions')->whereDay('created_at', '=', $today)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->count();
        
        for ($i=0; $i < 12; $i++) {
            $var = DB::table('transactions')->whereMonth('created_at', '=', $allMonth[$i])->whereYear('created_at', '=', $year)->count();
            $array[$i] = empty($var) ? 0 : $var;
        }

        
        for ($a=0; $a < 7; $a++) {
            $date[$a] =  date("d", strtotime($a." days ago"));
            $var = DB::table('transactions')->whereDay('created_at', '=', $date[$a])->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->count();
            $daily_count[$a] = empty($var) ? 0 : $var;
             $day[$a] = date("d/m", strtotime($a . " days ago"));
        }
        $month_chart = json_encode($array);
        $date_get = json_encode($day);
        $daily_count = json_encode($daily_count);

        $transaction = transaction::orderBy('id','DESC')->limit(5)->get();
        // dd($transaction);
         //dd($date_get);
           return view('layout.admin.homeAdmin',compact('count_this_mounth', 'count_this_year', 'count_this_day', 'month_chart', 'date_get', 'daily_count', 'transaction'));
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
