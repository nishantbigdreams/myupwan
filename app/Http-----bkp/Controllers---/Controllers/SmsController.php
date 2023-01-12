<?php

namespace App\Http\Controllers;

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

        SmsJob::dispatch($request->body);
        return back()->withStatus('SMS is queued and will be sent shortly');        
    }
}
