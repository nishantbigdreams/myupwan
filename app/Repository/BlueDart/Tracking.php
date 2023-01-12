<?php

namespace App\Repository\BlueDart;
use Ixudra\Curl\Facades\Curl;
use App;
use Response;
use PDF;
use App\BlueDartOrder;
use App\Order;

class Tracking
{
    protected $awb;
    protected $ref_no;
    protected $data;

    public function __construct($data)
    {
        $this->numbers = $data ;
         $this->data = [
                'handler' => 'tnt',
                'action'  => 'custawbquery',
                'loginid' => config('bluedart.loginid'),
                'awb'     => 'awb',
                'numbers' => implode(',',$this->numbers) ?? [],
                'format'  => 'xml',
                'lickey'  => config('bluedart.track_licencekey'),
                'verno'   => 1.3,
                'scan'    => 2,
            ];
      
    }

    public function track()
    {

            $response_data = Curl::to('http://api.bluedart.com/servlet/RoutingServlet')
            ->withData($this->data)
            ->get();

           

            $response = simplexml_load_string($response_data);
            $response = json_encode($response);
            $response = json_decode($response,true);

                if(isset($response)){

                    // dd($response);

                    foreach ($response['Shipment'] as $key => $data) {
                        
                        $statusType = $data['StatusType'];
                        $awb_no     = $data['@attributes']['WaybillNo'];

                        switch ($statusType) {
                            
                            case 'UD':
                                    $statusType = 'undelivered';
                                    $bdorder = BlueDartorder::where('awb_no',$awb_no)->first();
                                    if($bdorder != null)
                                    {
                                        $bdorder->expected_delivery_date = \Carbon\Carbon::parse($data['ExpectedDeliveryDate'])->format('Y-m-d');
                                        $order = Order::withoutGlobalScope('paid_orders')->findOrFail($bdorder->order_id);
                                        $order->status = 'undelivered';
                                        $order->save();
                                        $bdorder->save();
                                    }
                                    
                                break;
                            case 'DL':
                                    $statusType = 'delivered';
                                    $bdorder = BlueDartorder::where('awb_no',$awb_no)->first();
                                    if($bdorder != null)
                                    {
                                        $bdorder->expected_delivery_date = \Carbon\Carbon::parse($data['ExpectedDeliveryDate'])->format('Y-m-d');
                                        $order = Order::withoutGlobalScope('paid_orders')->findOrFail($bdorder->order_id);
                                        $order->status = 'delivered';
                                        $order->save();
                                        $bdorder->save();
                                        if($order->user != null)
                                        {
                                            sendMessage($order->user->phone, 'Dear '.$order->user->name.'.Your order '.$order->order_id.' is successfully delivered, Thank you for shopping. Team Novasell');
                                        }
                                    }
                                    
                                    break;
                            case 'IT':
                                    $statusType  = 'in_transit';
                                    $bdorder = BlueDartorder::where('awb_no',$awb_no)->first();
                                    if($bdorder != null)
                                    {
                                        $bdorder->expected_delivery_date = \Carbon\Carbon::parse($data['ExpectedDeliveryDate'])->format('Y-m-d');
                                        $order = Order::withoutGlobalScope('paid_orders')->findOrFail($bdorder->order_id);
                                        $order->status = 'in_transit';
                                        $order->save();
                                        $bdorder->save();
                                    }
                                     break;
                            case 'RT':
                                    $statusType  = 'return';
                                    break;
                            default:
                                    $statusType = 'not found';
                                break;
                        
                        }
                    
                    }
                }

            
            
    }

}
