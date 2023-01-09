<?php

namespace App\Observers;

use App\Admin;
use App\Order;
use App\Repository\BlueDart\Awb;
use App\Notifications\NewOrderAdminNotification;
use App\Notifications\OrderStatusUpdateNotification;

class OrderObserver
{

    public function created(Order $order)
    {
        $order->order_id = time();
        $order->save();

        $admin = Admin::find(1);
        $admin->notify(new NewOrderAdminNotification($order));
    }

    /**
     *Listen to the Order update event
     * @param $order
     * @return void
     */

    public function updated(Order $order)
    {
        $message = 'Order update, ';

        switch ($order->status) {
            case 'confirm':
                $message .= 'Your order '.$order->order_id.' has been proccessed and is in proccess for shipment.';
                break;
            // case 'packed':
            //     $message .= 'Your order '.$order->order_id.' has been packed and is ready for shipment.';
            //     break;
            case 'registered':
                // $token = $order->BdOrder->token ?? '';
                // $bd = new Awb;
                // $bd->download($order);
                //$message .= 'Your order '.$order->order_id.' is registered with BLUE DART. BLUEDART TOKEN %23 '.$token;
                $message = '';
                break;
            case 'in_transit':
                $awb = $order->BdOrder->awb_no ?? '';
                $message .='Your order '.$order->order_id.' is on its way for shipemt. You can use your AirWayBill '.$awb.' for tracking call 1860 233 1234 or visit https://www.bluedart.com/maintracking.html';
                break;
            case 'cancelled':
                $message .= 'Your order was cancelled.';
                break;

            case 'return_registered' :
                    $awb = $order->returnOrder->awb_no ?? '';
                    $message .= 'Your return order '.$order->order_id.' request is successfully registered with our shipment company';
            case 'delivered':
                    $awb = $order->BdOrder->awb_no ?? '';
                    $message .= 'Your order '.$order->order_id.' was successfully delivered';
                    break;
            default:
                $message = '';
                break;
        }

        if ($message) {
            if($order->user != null)
            {

                $order->user->notify(new OrderStatusUpdateNotification($message));

            }
        }
    }
}
