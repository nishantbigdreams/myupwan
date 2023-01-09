<?php

namespace App\Http\Controllers\Auth;

use App\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Session;
use Hash;
use Config;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Admin;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));
        $request->session()->invalidate();

        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });

        }
        session(['totalcount' => 0]);
        $this->guard()->logout();

        return redirect('/');
    }
    //user logout

    public function UserLogout(Request $request){
        Session::flush();
        Auth::guard("user")->logout();
        return redirect('/');
    }

// Login for user and delivery
    public function postLogin(Request $request)
    {

        // dd($request->all());


        $email = $request->email;
        $password = $request->password;


        $user = User::where(['email' => $email])->select(['id', 'email', 'phone', 'password'])->first();


        if ($user != null && Hash::check($password, $user->password)) {
            // Auth::loginUsingId($user['id']);
            Auth::loginUsingId($user['id']);
            session(['totalcount' => 0]);
            // return redirect()->route('home');
            return redirect()->route('checkout');
        } else {
            $deliveryboy = Admin::where(['email' => $email, 'usertype' => 'DeliveryBoy'])->select(['id', 'email', 'password'])->first();
            // dd($user);
            if ($deliveryboy === null) {
                Session::flash('loginFaild', 'Login Failed! Please Try again');
                // return response()->json(['status' => true, 'message' => 'OTP Sends On Your Mobile Number']);?
                return redirect('/');
            }


            if (Hash::check($password, $deliveryboy->password)) {
                Auth::guard('admin')->loginUsingId($deliveryboy['id']);
                return redirect()->route('deliveryboydashboard');
            }
        }

        if ($user === null) {
            Session::flash('loginFaild', 'Login Failed! Please Try again');
            return redirect('/');
        }

    }
    public function UserLogin(Request $request)
    {
        $status = Otp::where('phone',$request->phone)
            ->where('code', $request->otp)
            ->orderBy('id', 'desc')
            ->first();
        if ($status) {
            $user = User::where('phone', $request->phone)->first();
             Auth::guard('user')->id();
            if ($user) {
                \Auth::loginUsingId($user->id);
            }
/*            $status->delete();*/
            return response()->json(['status'=>true,'message' =>'Otp Verified']);
        }
        return response()->json(['status'=>false,'message' =>'Invalid Otp, try again']);

    }

    public function postRegistration(Request $request)
    {
        $otp =  random_int(1000, 9999);
        $status = Otp::create([
            'code' => $otp,
            'phone' => $request->phone,
        ]);
        $u = User::where('phone', $request->phone)->get();
        if (count($u) == 0) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'otp' => $otp,
                'password' => \Hash::make($request->password),]);

        }
/*        return response()->json(['success' => 'successfully done.']);*/
        return redirect('/');

    }

    public function formload()
    {
        return view('website.login');
    }

    public function checkoutpostLogin(Request $request)
    {

        // dd($request->all());


        $email = $request->email;
        $password = $request->password;


        $user = User::where(['email' => $email])->select(['id', 'email', 'phone', 'password'])->first();


        if ($user != null && Hash::check($password, $user->password)) {
            // Auth::loginUsingId($user['id']);
            Auth::loginUsingId($user['id']);

            return redirect()->route('checkout');
        } else {
            Session::flash('faild', 'Login Failed! Please Try again');
            return redirect('/cart');
        }


    }

    public function adminPostLogin(Request $request)
    {

        $email = $request->email;
        $password = $request->password;


        $user = Admin::where(['email' => $email, 'usertype' => 'Admin'])->select(['id', 'email', 'password'])->first();
        // dd($user);
        if ($user === null) {
            Session::flash('success', 'Login Failed! Please Try again');
            return redirect('/admin/login');
        }


        if (Hash::check($password, $user->password)) {
            // Auth::loginUsingId($user['id']);

            // Auth::loginUsingId($user['id']);
            Auth::guard('admin')->loginUsingId($user['id']);


            return redirect()->route('admin.home');
        }

    }


}
