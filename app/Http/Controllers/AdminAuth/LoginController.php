<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use Session;
use Config;
use Carbon\Carbon;
use Hash;

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
    protected $guard = 'admin';
    protected $redirectTo = '/admin/home';
    protected $redirectAfterLogout='/admin/login';


    protected function guard()
    {
        return auth()->guard('admin');
        //return Auth::guard('customer');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
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

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        Session::flush();
        return redirect('admin/login');
    }
}
