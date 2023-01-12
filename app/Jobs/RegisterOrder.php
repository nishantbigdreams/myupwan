<?php

namespace App\Jobs;

use App\Order;
use App\Jobs\DownloadAwb;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Repository\BlueDart\RegisterOrder as RegisterOrderBD;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $request;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->delay(now()->addSeconds(5));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where('status', 'packed')->get();
        foreach ($orders as $key => $order) {
            $bd = new RegisterOrderBD;
            $result = $bd->register($order, $this->request);
            echo json_encode($result);

            if ($result['status']) {
                $order->status = 'registered';
                $order->save();
                $order->BdOrder()->updateOrCreate(['order_id' => $order->id],[
                    'token' => $result['message'],
                    'pickup_date' => date('Y-m-d', strtotime($this->request['pickup_date'])),
                    'pickup_time' => date('h:i:s', strtotime($this->request['pickup_time'])),
                    'reference_no' => $this->request['reference_no'],
                    'remark' => $this->request['remark'],
                    'reg_error' => '',
                ]);
            } else {
                $order->BdOrder()->updateOrCreate(['order_id' => $order->id],[
                    'pickup_date' => date('Y-m-d', strtotime($this->request['pickup_date'])),
                    'pickup_time' => date('h:i:s', strtotime($this->request['pickup_time'])),
                    'reference_no' => $this->request['reference_no'],
                    'remark' => $this->request['remark'],
                    'reg_error' => $result['message'],
                ]);
            }
        }
        //download awb for all new registered order
        //DownloadAwb::dispatch();
    }
}
