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
use Auth;
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
    protected $guard = 'userapp';
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function guard()
    {
        return auth()->guard('userapp');
        //return Auth::guard('customer');
    }

    public function formload()
    {
        return view('website.login');
    }

//user logout
    public function UserLogout(Request $request)
    {
        Auth::guard("userapp")->logout();
        Session::flush();
        return redirect('/');
        /*
                $cart = collect(session()->get('cart'));

                if (!config('cart.destroy_on_logout')) {
                    $cart->each(function ($rows, $identifier) {
                        session()->put('cart.' . $identifier, $rows);
                    });

                }
                session(['totalcount' => 0]);*/


    }


// Login for user and delivery

    public function UserLogin(Request $request)
    {
        $status = Otp::where('phone', $request->phone)
            ->where('code', $request->otp)
            ->orderBy('id', 'desc')
            ->first();
        if ($status) {
            $user = User::where('phone', $request->phone)->first();
            if ($user) {
                \Auth::loginUsingId($user->id);
            }
            return redirect('/');

        }
        return response()->json(['status' => false, 'message' => 'Invalid Otp, try again']);

    }

    public function postRegistration(Request $request)
    {
        $otp = random_int(1000, 9999);
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
                return response()->json(['success' => 'successfully done.']);
        // return redirect('/');

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



}
