@php
    $products_img = json_decode($order->product_image);
    $products_name = json_decode($order->product_name);
    $products_qty = json_decode($order->product_qty);
    $products_sku = json_decode($order->product_sku);
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="row">
            @if($order->status != 'proccessing')
                <div class="col-md-12">
                    Last Updated on:
                    <strong>
                        {{date('M d, Y', strtotime($order->updated_at))}}
                    </strong>
                </div>
            @endif
            <div class="col-md-6">
                <div>
                Order Date:
                <strong>
                    {{date('M d, Y', strtotime($order->created_at))}}
                </strong>
                </div>
                <div>
                    Delivery Time:
                <strong>
                    {{$order->delivery_time}}
                </strong>
                </div>
            </div>
            <div class="col-md-6 text-capitalize">

              <!--   Restaurant Name: {{-- {{$order->user['restaurant_name']}} --}}.<br> -->Contact Person : {{$order->user->name ?? $order->contact_person}}, {{$order->user->phone ?? $order->contact_number}}
            </div>
            <div class="col-md-12">
                Payment Method: {{$order->payment->method ?? ''}}
                @isset($order->payment)
                @if($order->payment->method == 'neft')
                    -UTR NO {{$order->payment->utr_no}}
                    <br>
                    <span class="text-danger">
                        Please Check UTR No with Bank.
                    </span>
                @endif
                @endisset
            </div>
        </div>
        <br/>
        <div class="table-responsive">
            <table class="table table-bordered" border="0">
                @if($order->BdOrder)
                   <!--  <tr>
                        <th class="text-danger">
                            Blue Dart Token
                        </th>
                        <th class="text-danger">
                            {{$order->BdOrder->token}}
                        </th>
                        <th class="text-danger">
                            AWB#: <br> {{$order->BdOrder->awb_no}}
                        </th>
                        <th class="text-danger">
                            Pick up Time : <br>
                            {{date('M d, Y', strtotime($order->BdOrder->pickup_date))}} at
                            {{date('h:i A', strtotime($order->BdOrder->pickup_time))}}
                        </th>
                    </tr> -->
                @endif
                <tr>
                    <th colspan="4">ORDER DETAIL # {{$order->order_id}}</th>
                </tr>

               
                @for ($index = 0; $index < count($products_sku); $index++)
                    <tr>
                        <td>Item Name</td>
                        <td>{{$products_name[$index] ?? ''}}</td>
                        <td>Quantity</td>
                        <td>{{$products_qty[$index] ?? ''}} Unit</td>
                    </tr>

                    <tr>
                        <td>SKU</td>
                        <td>{{$products_sku[$index] ?? ''}}</td>
                    </tr>
                @endfor 
            </table>
        </div>
        @if($order->BdOrder && $order->BdOrder->reg_error)
            <div class="col-md-12">
                <span class="text-danger">
                    {{$order->BdOrder->reg_error}}, Try again with different pick up date
                </span>
                <br>
            </div>
        @endif
        <div class="btn-group m-b-10">
            <a href="{{url('admin/order')}}/{{$order->id}}" class="btn btn-custom w-lg">
                <i class="fa fa-eye"></i> View Details
            </a>
            @if(in_array('pack', $action))
             No.Of Packed Boxes:<input type="number"  name="pack-boxes" class="pack-boxes" value="{{$order->packed_box}}" id="{{$order->id}}" placeholder="Please Enter No.of Boxes">
            <button disabled="" class="packorder{{$order->id}}">
                <a class="btn btn-success waves-effect waves-light packorder" onclick="return false;" id="{{$order->id}}-packorder" role="button" href="{{url('admin/order/'.$order->id.'/pack' )}}">
                    <i class="fa fa-cube"></i> Pack Order
                </a>
                </button>
            @endif

            @if(in_array('register',$action))
             No.Of Packed Boxes:<input type="number"  name="pack-boxes"  value="{{$order->packed_box}}"  disabled="">
                <button class="btn btn-danger w-lg reg_order" 
                data-reg_error="{{($order->BdOrder->reg_error ?? '') !='' ? 'yes':'no'}}">
                    <i class="fa fa-truck"></i> Register Order With Delhivery
                </button>
                 <button disabled="" class="packorder{{$order->id}}" style="display: none">
                <a class="btn btn-success w-lg reg_order" onclick="return false;" id="{{$order->id}}" role="button" href="{{route('admin.order.pack', $order)}}">
                    <i class="fa fa-cube"></i> Assign Order
                </a>
                </button>
                <select name="delivery_boy" class="handover" id="{{$order->id}}-handover">
                    <option value="Select Delivery Boy">Change Status</option>
                    <option value="Deliver">Deliver</option>
                    
                   
                </select>
            @endif

            @if(in_array('awb', $action))
               <a href="{{route('admin.download.awb', $order)}}" target="_blank" class="btn btn-success w-lg">
                    <i class="fa fa-download"></i> Download AWB
                </a>
            @endif

            @if(in_array('invoice', $action))
                <a href="{{url('admin/order/'.$order->id.'/pdf')}}" target="_blank" class="btn btn-default w-lg">
                    <i class="fa fa-file-pdf-o"></i> Download Invoice
                </a>
               
            @endif

            @if(in_array('refund',$action))
                <a href="{url('admin/cancel_order', $order->id)}}"  class="btn btn-danger w-lg">
                    <i class="fa fa-times"></i> Cancel Order
                </a>
            @endif

            @if(in_array('cancel',$action))
                <a href="{url('admin/cancel_order', $order->id)}}"  class="btn btn-danger w-lg">
                    <i class="fa fa-times"></i> Cancel Order
                </a>
            @endif

            <!-- @if(in_array('transit', $action))
                <a href="javascript:;" class="btn btn-warning refundBtn">
                    <i class="fa fa-paper-plane"></i> Refund
                </a>
            @endif -->
        </div>
        <div class="clearfix"></div>
        <hr/>
        @if(in_array('register',$action))
            <div class="row">
                <form class="reg_form" action="{{url('admin/register_order')}}" method="post" style="display:none">
                    {{ csrf_field() }}
                    <input type="hidden" name="order" value="{{$order->id}}">
                    <div class="col-sm-4">
                        <input type="text" name="reference_no" class="form-control input-sm" placeholder="Reference No">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="pickup_date" class="form-control input-sm pickup-date" placeholder="Pickup Date" required value="{{date('d-m-Y')}}">
                            <span class="input-group-addon bg-custom b-0">
                                <i class="mdi mdi-calendar text-white"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="pickup_time" class="form-control input-sm pickup-time" placeholder="Pickup Time" required>
                            <span class="input-group-addon bg-custom b-0">
                                <i class="mdi mdi-clock text-white"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <button class="btn btn-custom btn-sm btn-block">
                            <i class="fa fa-check"></i> SUBMIT
                        </button>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <div class="form-group">
                            <textarea name="remark" class="form-control" placeholder="Remark if any"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@section('page-scripts')
    <script type="text/javascript">
        $(document).on('change','.pack-boxes',function()
            {
                var id=$(this).attr("id");
                /*alert(id+'-packorder');*/
                if($(this).val()=='' || $(this).val()=='0' || $(this).val()==0)
                {
                    $('#'+id+'-packorder').attr('onclick','return false;');
                    $('.'+'packorder'+id).attr('disabled','');

                }
                else
                {
                    $('#'+id+'-packorder').removeAttr('onclick');
                    $('.'+'packorder'+id).removeAttr('disabled');
                var id1=$('#'+id+'-packorder').attr("href");
                id1=id1.slice(0, id1.indexOf("pack"));
                $('#'+id+'-packorder').attr("href",id1+'pack/'+$(this).val());
                }
            });
         $(document).on('change','.handover',function()
            {
                var id1=$(this).attr("id");
                var id=id1.slice(0, id1.indexOf("-"));
                var val=$(this).val();
                /*alert(id+'-packorder');*/
                var success = confirm('Are you sure want to assign this order ????');
                if (success == true)
                {
               
                // do something       
               
                  $.get("/admin/order/"+id+"/handover/"+val,
                  {
                  
                  },
                  function(data, status){
                    alert("Successfully Assign");
                    location.reload();
                  });
                            
            }
            else {
                alert('Not changed');
                // Cancel the change event and keep the selected element
            }
            });
        
    </script>
@endsection
<hr style="border-color:black"/>