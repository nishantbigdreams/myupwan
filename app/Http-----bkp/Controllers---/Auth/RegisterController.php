<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/restoprofile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'reg_email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|digits_between:10,12',
            'req_password' => 'required|string|min:6',
            'newsletter' => 'nullable|string'
        ], [
            '*.unique' => 'Email Address is already in use',
            'req_password.min' => 'Password Must be atleast 6 characters',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['reg_email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['req_password']),
            'subcribe_to_newsletter' =>  'yes',
            'isprofiledone'=>0
        ]);

        $message = 'Thanks for registering with us.';
        sendMessage($user->phone, $message);
        return $user;
    }
}
