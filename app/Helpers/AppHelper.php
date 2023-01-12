<?php

// use Cart;
use App\Product;
use App\Payment;
use App\ReturnOrder;
use Ixudra\Curl\Facades\Curl;

function invoiceNo()
{
    $company_prefix = 'inv';
    $counter = 0;

    if(date('m') >= 04 && date('d') >= 01){ //1st of april
        $year = date('y').'/'.date('y',strtotime('+1 year'));
    }else {
        $year = date('y',strtotime('-1 year')).'/'.date('y');
    }

    $payment = Payment::where('invoice_no', '!=', '')->orderBy('id', 'desc')->first();
    if ($payment) {
        $last_invoice_no = $payment->invoice_no;
        $temp = explode(' ',$last_invoice_no);
        $last_invoice_year = $temp[1] ?? '';

        if($year == $last_invoice_year){
            $counter = intVal($temp[2] ?? 0);
        }

    }
    $counter++;
    $counter = str_pad($counter, 5, '0' , STR_PAD_LEFT);

    return $company_prefix.' '.$year.' '.$counter;

}

function returnInvoiceNo()
{
    $company_prefix = 'nova-r';
    $counter = 0;

    if(date('m') >= 04 && date('d') >= 01){ //1st of april
        $year = date('y').'/'.date('y',strtotime('+1 year'));
    }else {
        $year = date('y',strtotime('-1 year')).'/'.date('y');
    }

    $order = ReturnOrder::where('invoice_no', '!=', '')->orderBy('id', 'desc')->first();
    if ($order) {
        $last_invoice_no = $order->invoice_no;
        $temp = explode(' ',$last_invoice_no);
        $last_invoice_year = $temp[1] ?? '';

        if($year == $last_invoice_year){
            $counter = intVal($temp[2] ?? 0);
        }

    }
    $counter++;
    $counter = str_pad($counter, 5, '0' , STR_PAD_LEFT);

    return $company_prefix.' '.$year.' '.$counter;

}





function sendMessage($phone, $message)
{
    // $message .= ' Thank you. '.env('APP_NAME');
    $message = str_replace(" ","%20",$message);

    $url="http://smsservice.fourbrothers.co.in/http-api.php?username=novasell&password=123456&senderid=NOVASL&route=1&number=91".$phone."&message=".$message;
    return Curl::to($url)->get();
}

// function smsLeft()
// {
//     $count = 0;

//     $balanceUrl = "http://smsservice.fourbrothers.co.in/http-credit.php?username=".env('SMS_USER')."&password=".env('SMS_PASSWORD')."&route_id=1";//.env('SMS_ROUTE');

//         $response = Curl::to($balanceUrl)->get();
//         if($response){
//             dd($response);
//             $response = explode(":",Curl::to($balanceUrl)->get());
//             $count =  (int)isset($response[1])?trim($response[1]):'';
//         }

//     return $count;
// }

function orderWeight($order)
{
    $weight = 0;
    $products = Product::withTrashed()->whereIn('id', json_decode($order->product_id))->get();
    foreach ($products as $key => $product) {
        $data = (array)json_decode($product->data);
        if (isset($data['WEIGHT'])) {
            $weight += intVal($data['WEIGHT']);
        } else {
            $weight++;
        }
    }
    return $weight;
}

function orderDimensions($order)
{
//     $dimensions = [];
//     $qtys = json_decode($order->product_qty);

//     $products = Product::withTrashed()->whereIn('id', json_decode($order->product_id))->get();
//     foreach ($products as $key => $product) {
//         $data = (array)json_decode($product->data);
//         $count = $qtys[$key] ?? 1;
//         for($i = 0; $i < $count; $i++){
//             array_push($dimensions, array (
//                 'Breadth' => isset($data['BREADTH']) ? intVal($data['BREADTH']) : 1,
//                 'Count' => 1,
//                 'Height' => isset($data['HEIGHT']) ? intVal($data['HEIGHT']) : 1,
//                 'Length' => isset($data['LENGTH']) ? intVal($data['LENGTH']) : 1,
//             )
//         );
//     }
// }
// if (count($dimensions)) {
//     return $dimensions;
// }
return array (
    'Breadth' => '1',
    'Count' => '1',
    'Height' => '1',
    'Length' => '1'
);
}

function combo_discount($qty_array, $dis_array, $value)
{
    if (!is_array($qty_array) || !is_array($dis_array)) {
        return 0;
    }

    if ($value < min($qty_array)) {
        return 0;
    }

    if ($value >= max($qty_array)) {
        return $dis_array[array_search(max($qty_array), $qty_array)] ?? 0;
    }

    for ($i=1; $i <= count($qty_array) ; $i++) {
        if ($value >= $qty_array[$i-1] && $value < $qty_array[$i]) {
            return $dis_array[$i-1];
        }
    }
    return 0;
}

function cart_parse_value ($value)
{
    return intVal(str_replace(',', '', $value));
}

function cart_amount_saved()
{
    $cart_price = [];
    foreach (Cart::content() as $key => $cart) {
        $combo_qty = $cart->options->combo_qty ?? [0];
        $combo_dis = $cart->options->combo_discount ?? [0];

        $discount_rate = combo_discount($combo_qty,$combo_dis, $cart->qty);

        $price = $cart->price * $cart->qty - $cart->price * $cart->qty * ($discount_rate/100);
        array_push($cart_price, $price);
    }
    return cart_parse_value(Cart::subtotal()) - array_sum($cart_price);
}

function cart_gst()
{
    // return round(cart_total(), 2);
    return round(cart_total() * 0.18, 2);
}

function cart_total()
{
    return ceil(cart_parse_value(Cart::subtotal()));
}

function cart_grand_total()
{
    return ceil(cart_total() - cart_amount_saved());
    // return ceil(cart_total() - cart_amount_saved()  + cart_gst());
}

function order_weight()
{
    // return round(cart_total(), 2);
    // return round(cart_total() * 0.12, 2);
    $cart_weight = 0;
   /* foreach (Cart::content() as $key => $cart) {
        $cart_weight += ($cart->qty  * ($cart->options->product_weight));
    }*/

    return $cart_weight;
}

