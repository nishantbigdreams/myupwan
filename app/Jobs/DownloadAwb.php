<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use App\Repository\BlueDart\Awb;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DownloadAwb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where('status', 'registered')->get();
        foreach ($orders as $key => $order) {
            $bd = new Awb;
            $bd->download($order);
        }
    }
}
