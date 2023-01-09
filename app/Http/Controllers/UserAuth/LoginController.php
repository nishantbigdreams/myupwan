<?php

namespace App\Http\Controllers\UserAuth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use Session;
use Config;
use Carbon\Carbon;
use Hash;
use App\Otp;
use DB;
use App\User;
use Validator;

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
    protected $redirectAfterLogout='/';


    public function __construct()
    {
        $this->middleware('guest:userapp')->except('logout');
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
/*        return response()->json(['status' => false, 'message' => 'Invalid Otp, try again']);*/
        return redirect('postLogin')->with('error', 'Invalid Otp, try again');
/*        return redirect('/');*/


    }

    public function postRegistration1(Request $request)
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
        /*        return response()->json(['success' => 'successfully done.']);*/
        return redirect('/');

    }


    public function checkoutpostLogin(Request $request)
    {
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
    
    public function userprofileupdate(Request $request){

        $user = User::where("id", $request->uid)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_line_0' => $request->address_line_0,
            'address_line_1' => $request->address_line_1,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'address_line_2' => $request->address_line_2
        ]);
/*        return redirect('account');*/
        return redirect('account')->with('success', 'Profile has been successfully updated');

    }

    public function userpasswordupdate(Request $request){
        $changedpass = User::where('id',auth::user()->id)->pluck('password')->first();


        if (!empty($changedpass))
        {
            if(Hash::check($request->current_password, $changedpass))
            {
                //$password = new AdminUserModel();
                if($request->current_password == $request->new_password)
                {
                    return redirect('account')->with('error', 'New password cannot be same as old password');
                }
                if($request->new_password == $request->new_password_confirmation)
                {
                    $password = User::where('id',Auth::user()->id)
                        ->update(['password' => bcrypt($request->new_password)
                        ]);

                }
                else {
                    return redirect('account')->with('error', 'The Retype Password does Not match');

                }
            }else
            {
                return redirect('account')->with('error', 'Current Password Does Not Match');

            }
            return redirect('account')->with('success', 'Your Password has been changed Successfully');

        }else
        {
            return redirect('account')->with('error', 'Sorry Not Found Your Data');

        }
    }

    public function postRegistration(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'unique:users,email|required',
            'phone' => 'unique:users,phone|required',
            'password' => 'required',
        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        } else {
            $u = User::where('phone', $request->phone)->get();
            $otp = random_int(1000, 9999);
            $status = Otp::create([
            'code' => $otp,
            'phone' => $request->phone,
            ]);
            if (count($u) == 0) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => \Hash::make($request->password),]);

                $user = User::where(['email' => $request->email])->select(['id', 'email', 'phone', 'password'])->first();
                if ($user != null && \Hash::check($request->password, $user->password)) {

                    $data = array('key' => '35F084950ABBFC', 'campaign' => '0', 'senderid' => 'FARMTR', 'routeid' => 13, 'type' => 'text', 'contacts' => $request->phone, 'msg' => 'THANK YOU FOR REGISTERING WITH US.');
                    // Send the POST request with cURL
                    $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $code_sent = curl_exec($ch);
                    curl_close($ch);
                    Auth::loginUsingId($user['id']);
                    return response()->json(['success' => 'successfully done.']);
    
                    return redirect()->route('account');
                }
            } else {
                $query = @$_GET['query'];
                $no = Cart::instance('cart')->content()->count();
                if (Auth::user()) {
                    if ($no) {
                        session(['totalcount' => $no]);
                    }
                } else {
                    $no = Cart::instance('cart')->content()->count();
                    session(['totalcount' => $no]);
                }
                $freshproducts = Product::with('featuredImage')->where('category', 'LIKE', "%VEGETABLE%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
                $freshfruitsproducts = Product::with('featuredImage')->where('category', 'LIKE', "%FRUITS%")->orderBy('updated_at', 'desc')->offset(0)->limit(10)->get();
                if ($query) {
                    $product = Product::where('name', $query)->first();
                    if ($product) {
                        $similar_products = $product->similarProducts();
                        return view('website.product-page',
                            compact('product', 'similar_products'));
                    }
                }
                $message = "Sorry Your mobile number is already registered.";
                return view('website.index', compact('freshfruitsproducts', 'freshproducts', 'message'));
            }
        }
    }


}
