<?php

namespace App\Http\Controllers;

use App\Order;
use App\Complain;
use Illuminate\Http\Request;
use App\Notifications\NewComplainReceived;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $complain = $order->complains()->create([
            'type' => $request->complain_type,
            'body' => $request->message
        ]);

        

        if ($complain) {
            \App\Admin::find(1)->notify(new NewComplainReceived($complain));
            return response()->json([
                'status' =>true,
                'message' =>'Complain received <br> We will get back to you on your registered email. Thank you',
            ]);
        }
        return response()->json([
                'status' =>false,
                'message' =>'Oops!! <br> Something went wrong, Try again later.',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function show(Complain $complain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function edit(Complain $complain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complain $complain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complain $complain)
    {
        //
    }
}
