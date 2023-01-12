<?php

namespace App\Console\Commands;

use Curl;
use App\BlueDartOrder;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:status_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command updates Order status with BlueDart Shoptrack API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$awb = [];

        $bdorders =  BlueDartOrder::with('order')->get();
        
        foreach ($bdorders as $key => $bdorder) {
        	if ($bdorder->order->status == 'in_transit') {
        		array_push($awb, $bdorder->awb_no);
        	}
        }

        if (count($awb) == 0 ) {
            exit();
        }

        if (count($awb) == 1) {
            array_push($awb, '12345678901');
            //pushing dummy awb no so at to avoid code for single order update :)
        }
        
        print_r("AWBs \n");
        print_r($awb);

        $url = 'http://www.bluedart.com/servlet/RoutingServlet?handler=tnt&action=custawbquery&loginid='.config('bluedart.loginid').'&awb=awb&numbers='.implode(',', $awb).'&format=xml&lickey='.config('bluedart.licensekey').'&verno=1&scan=1';
        
        $response = Curl::to($url)->get();
        
        print_r("RESPONSES");

        if ($response) {
            //parsing xml response
            $response_data = simplexml_load_string($response);
            if ($response_data != false) {
                
                $response_data = get_object_vars($response_data);
                foreach ($response_data['Shipment'] as $key => $order_status) {
                 	
        			print_r($response_data);
                    $status_array = get_object_vars($order_status);
                    $bd_status = $status_array['StatusType'];
                    
                    if ($bd_status == 'NF') continue;


                    $awb = $status_array['@attributes']['WaybillNo'];
                    
                    if ($bd_status != 'IT') {

                        $bd = BlueDartOrder::where('awb_no', $awb)->first();
                        if ($bd) {
                            //update delivery status
                            if (isset($status_array['ReceivedBy'])) {
                                $bd->received_by = $status_array['ReceivedBy'];
                            }
                            if (isset($status_array['ExpectedDeliveryDate'])) {
                                $bd->expected_delivery_date = $status_array['ExpectedDeliveryDate'];
                            }
                            $bd->save();

                            //update order
                            if ($bd_status == 'DL') {
                                $bd->order->delivery_date = $status_array['StatusDate'];
                            }
                            $bd->order->status = $this->getStatus($bd_status);
                            $bd->order->save();

                            $this->info('Order Status Updated');
                        }
                    }
                }

            }
        } else {
            $this->error('Failed to load response');
        }
    }

    protected function getStatus($status)
    {
        switch ($status) {

            case 'UD':
            return 'Undelivered';
            break;

            case 'DL':
            return 'delivered'; 
            break;

            case 'RT':
            return 'return';
            break;

            case 'RD':
            return 'Redirected';
            break;
            
            default:
            return 'in_transit';
            break;
        }

    }
}
