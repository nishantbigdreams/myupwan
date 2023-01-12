<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\Admin;
use DB;
use Illuminate\Support\Facades\Hash;
class RedirectIfAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
{

	// dd($request);

	 	// $password = Hash::make(123456);
	 	// dd($password);
		$email  = "";
		if(isset($request->email)){
			$email = $request->email;
		}
		$admin = Admin::where(['email' =>$email ])->first();
			
		if($admin !=null && $admin->email == $email  &&  Hash::check($request->password,$admin->password)){
			 // return redirect()->route('admin.home');
			 return redirect('admin/home');
		}else{
			 return $next($request);
		}
		// $admin = DB::table('admins')
  //                   ->where('email', $request->email )
  //                  	->where('password', $request->password )
  //                   ->get();
                    
     // if (Auth::attempt ( array (
     //            'email' => $request->get ( 'email' ),
     //            'password' => $request->get ( 'password' ) 
     //    ) )) {
     //        session ( [ 
     //                'email' => $request->get ( 'email' ) 
     //        ] );
     //        // return Redirect::back ();
     //         return redirect('admin.home');
     //    } else {
     //        Session::flash ( 'message', "Invalid Credentials , Please try again." );
     //        return $next($request);
     //    }
}

			


	// //     // if (Auth::guard($guard)->check()) {
	// //         return redirect('admin.home');
	// //     // }

	// //     return $next($request);
	// }
}