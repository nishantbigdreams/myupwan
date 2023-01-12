<?php
use App\Product;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style media="all">

    .bt-2 {
        border-top: 2px solid #000;
    }
    .bb-2 {
        border-bottom: 2px solid #000;
    }
    .ptb-15 {
        padding: 15px 0;
    }
    .row {
        margin-left: 0px;
        margin-right: 0px;
    }
    .table-bordered {
        border: 2px solid #000;
        border-right: none;
        border-left: none;
        margin-bottom: 0;
    }
    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
        border: none;
        text-transform: uppercase;
        text-align: center;
    }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6" style="padding: 0px; text-align: left; margin-left: 0px;">
                    <img src="{{ public_path('images/logo.png') }}" alt="My Upavan" class="img-responsive center-block" style="width: 80%">
                    <!-- <img style="position:absolute; top:0px; left:0px; width:90px; height:115px;" src="" /> -->
                </div>
                <div class="col-xs-6">
                    <h2 class="text-uppercase" style="text-align: right;"><strong>invoice</strong></h2>
                    <h4 class="text-uppercase" style="text-align: right;">invoice no: {{$order->payment->invoice_no}}</h4>
                    <h4 class="text-uppercase" style="text-align: right;">
                        invoice date : {{date('d/m/Y', strtotime($order->created_at))}}
                    </h4>
                    <p class="text-uppercase" style="text-align: right;"><strong>Delivery Time: </strong> {{$order->delivery_time}}</p>
                     <p class="text-uppercase" style="text-align: right;"><strong>Payment Type: </strong> @if($order->payment_method!="online") COD
                        @else
                        {{$order->payment_method}}
                    @endif</p>
                </div>
            </div>
            <br>
            <div class="row bt-2" style="padding-top: 20px;">
                <div class="col-xs-5">
                    <span class="text-uppercase">
                        Seller <br/>
                        <strong>
                            My Upavan
                        </strong><br/>
                    </span>
                    <span>
                        Contact : +91 961 904 9996<br/>
                        Email:myupavan@gmail.com
                    </span>
                </div>
                <div class="col-xs-3">
                    <br><br>
                    @if ($order->BdOrder && $order->BdOrder->awb_no)
                    @if($order->payment->method == 'cod')
                       <!-- <h4 class="text-uppercase pull-right">
                            <strong>APEX - COD</strong>
                        </h4>-->
                    @else
                        <h4 class="text-uppercase pull-right">
                            <strong>APEX - PREPAID</strong>
                        </h4>
                    @endif
                    @endif
                </div>
                <div class="col-xs-3" style="padding-bottom: 20px;">
                    <span class="text-uppercase">
                        buyer <br/>
                        <strong>
                            {{$order->user->name ?? $order->contact_person}}
                        </strong><br/>
                        {{$order->user->billingAddress->address_line_0 ?? $order->address_line_0}},<br/>
                        {{$order->user->billingAddress->address_line_1 ?? $order->address_line_1}},<br/>
                        @if(isset($order->user->billingAddress->address_line_2))
                        {{$order->user->billingAddress->address_line_2 ?? $order->address_line_2}},<br/>
                        @endif
                        {{$order->user->billingAddress->city ?? $order->city}},
                        {{$order->user->billingAddress->pincode ?? $order->pincode}},<br/>
                        {{$order->user->billingAddress->state ?? $order->state}},<br/>
                        Phone: {{$order->user->phone ?? $order->contact_number}}<br/>
                    </span>
                </div>

            </div>
            @if ($order->BdOrder && $order->BdOrder->awb_no)
                <!--<div class="row bt-2 text-uppercase text-center ptb-15">
                <div class="col-xs-6">
                    dispatched via <strong>blue dart</strong>.
                    awb # <strong>{{$order->BdOrder->awb_no}}</strong> <br>
                    {{$order->BdOrder->dest_area}} / {{$order->BdOrder->dest_loc}}
                </div>-->
               <!-- <div class="col-xs-6">
                    @php
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->BdOrder->awb_no, "C39") . '" alt="barcode" />';
                    @endphp
                </div>
            </div>-->
            @endif
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>s.no.</th>
                        <th>item description</th>
                        <th>qty</th>
                        <th>rate</th>
                        <th>unit</th>

                        <th class="col-xs-2" width="100%">amount</th>
                    </tr>
                    @php
                    $product_gst = json_decode($order->product_gst);
                    $products = json_decode($order->product_name);
                    $product_id = json_decode($order->product_id);
                    $qty = json_decode($order->product_qty);

                    $price = json_decode($order->product_price);
                    $gst = json_decode($order->gst);


                    @endphp
                    <?php
                     $amount_total = 0.0;
                     $actual_amount = 0.0;

                    ?>
                    @for($i = 0; $i < count($products); $i++)
                    <?php
                   		$product_unit = Product::find($product_id[$i]);

                    ?>
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$products[$i]}}</td>
                        <td>{{$qty[$i] ?? 1}}</td>
                        <td>{{number_format(((float)$price[$i]), 2, '.', '')}}</td>
                        <td>{{$product_unit ->unit}}</td>

                        <?php
                              $amount_total += number_format(($qty[$i] ?? 1) * (number_format(((float)$price[$i])/(1+((float)isset($product_gst[$i])*0.01)), 2, '.', '') ?? 1), 2, '.', '');
                                  $actual_amount += number_format(($qty[$i] ?? 1) * ($price[$i] ?? 1), 2, '.', '');
                        ?>



                        <td>{{number_format(($qty[$i] ?? 1) * (number_format(((float)$price[$i]), 2, '.', '') ?? 1), 2, '.', '')}}</td>



                    </tr>
                    @endfor

                </table>
            </div>
            <div class="row">
                <!-- <div class="col-xs-10 ptb-15">
                    <div class="text-uppercase text-center" ><strong>Sub Total</strong></div>
                </div>
                <div class="col-xs-2 ptb-15">
                    <div class="text-uppercase text-center">
                        <strong>&#8377; {{$amount_total}}</strong>
                    </div>
                </div> -->
                 @if(strtolower($order->state) == 'maharashtra')
                 <!--    <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>CGST</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; {{number_format(($actual_amount - $amount_total)/2)}}</strong>
                        </div>
                    </div>
                     <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>SGST</strong></div>
                    </div>

                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; {{number_format(($actual_amount - $amount_total)/2)}}</strong>
                        </div>
                    </div> -->
                 @else
                      <!-- <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>IGST</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; {{number_format(($actual_amount - $amount_total))}}</strong>
                        </div>
                    </div>     -->
                @endif

              <!--   @if($order->discount || $order->bulk_purchase_discount)
                    <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>Offer</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; -
                                {{number_format(intval($order->discount) + $order->bulk_purchase_discount )}}
                            </strong>
                        </div>
                    </div>
                @endif -->
            </div>
            <div class="row">
                <div class="col-xs-10 ptb-15">

                    <div class="text-uppercase text-center"><strong>
 @if($order->coupen_apply==1)
                             Coupon Code Applied
                            @else

                    Shipping Charge


                            @endif




                </strong></div>

                </div>
                <div class="col-xs-2 ptb-15">
                    <div class="text-uppercase text-center">
                        <!-- <strong>&#8377; {{number_format(round($actual_amount,2))}}</strong> -->
                        <strong>&#8377; 
                            @if($order->coupen_apply==1)
                                  {{$order->coupon_value}}
                            @else

                                   {{ $order->delevery_charge}}


                            @endif
                        </strong>
                        <?php

                         $actual_amount+=$order->delevery_charge;


                         ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 ptb-15">
                    <div class="text-uppercase text-center"><strong>total</strong></div>
                </div>
                <div class="col-xs-2 ptb-15">
                    <div class="text-uppercase text-center">
                        <strong>&#8377;

                        @if($order->coupen_apply==1)
                                  {{0}}
                            @else

                         {{number_format(round($actual_amount,2))}}</strong>


                            @endif

                    </div>
                </div>
            </div>
           <!--   @if(isset($order->delevery_charge))
                    <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>Delivery Charges</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; {{$order->delevery_charge}}</strong>
                        </div>
                    </div>
                @else
                     <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>Delivery Charges</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>&#8377; 0</strong>
                        </div>
                    </div>
                @endif -->
            <div class="row">
              <!--   <div class="col-xs-10 ptb-15">
                    <div class="text-uppercase text-center">
                        @if($order->payment && $order->payment->method == 'cod')

                        <strong>Collectable Amount</strong>
                            @else
                        <strong>Grand Total</strong>
                            @endif
                    </div>
                </div> -->
               <!--  <div class="col-xs-2 ptb-15">
                    <div class="text-uppercase text-center">
                        <strong>&#8377;
                            @if($order->payment && $order->payment->method == 'cod')
                                {{number_format((round($actual_amount,2) + $order->delevery_charge))}}
                            @else
                               {{number_format((round($actual_amount,2) + $order->delevery_charge))}}
                            @endif
                        </strong>
                    </div>
                </div -->
              <!--   @if($order->order_total_weight)
                    <div class="col-xs-10 ptb-15">
                        <div class="text-uppercase text-center"><strong>Total weight</strong></div>
                    </div>
                    <div class="col-xs-2 ptb-15">
                        <div class="text-uppercase text-center">
                            <strong>{{$order->order_total_weight}} kg</strong>
                        </div>
                    </div>
                @endif -->
            </div>

            <div class="row bt-2">
                <div class="text-uppercase">
                    <?php
                        $tmp_amount = explode('.', $order->total+$order->delevery_charge);
                    ?>
                    <strong>
                        {{-- GST (18%) is included: &#8377; {{number_format($order->gstAmount())}} --}}
                    </strong>
                    <br>
                    <strong>Amount in words : {{number2word($tmp_amount[0])}}
                        @if(isset($tmp_amount[1]))
                        and {{number2word($tmp_amount[1] > 9 ? $tmp_amount[1] : $tmp_amount[1]*10 )}} paise
                        @endisset
                    only</strong>
                </div>
                <br/>
                <div style="margin-bottom: 10px;">
                <strong class="text-uppercase"> declaration</strong><br/>
                We declare that this invoice shows actaul price of all goods described inclusive of all taxes and that all particulars are true and correct.</div>
                <div style="margin-bottom: 20px;">
                <strong class="text-uppercase"> customer acknowledgment</strong><br/>
                {{strtoupper($order->user->name ?? $order->contact_person)}} hereby confirm that the above said product/s are being purchased for my internal personal consumption / re-sale.</div>
            </div>
            <div class="row bt-2 bb-2">
                <div class="text-uppercase text-center ptb-15">
                    <strong>this is computer generated invoice and does not require signature</strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
