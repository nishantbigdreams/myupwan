<?php

namespace App\Http\Controllers;

use App\User;
use App\Jobs\SmsJob;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index()
    {
        return view('admin.sms.index');
    }

    public function send(Request $request)
    {
        if(strlen($request->body) <= 0){
            return back()->withStatus('SMS Body cant be empty');
        }

        foreach (User::all() as $key => $user) {
            $message=$request->body;
            $data = array('key'=>'35F084950ABBFC','campaign'=>'0','senderid'=>'FARMTR','routeid'=>13,'type'=>'text','contacts'=>$user->phone,'msg'=>$message);
    // Send the POST request with cURL
            $ch = curl_init('http://sms.textmysms.com/app/smsapi/index.php');            
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_sent = curl_exec($ch);
            curl_close($ch);
            
        }

      /*  SmsJob::dispatch($request->body);*/
        return back()->withStatus('SMS is queued and will be sent shortly');        
    }
}
