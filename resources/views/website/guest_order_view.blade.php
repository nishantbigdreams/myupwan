@extends('layouts.website_master')
@section('body_content')
<div class="panel panel-default">
                            <div class="panel-heading">
                                <button type="button" class="btn btn-sm btn-warning">
                                    Order No. # {{$order->order_id}}
                                </button>
                                <button type="button" class="btn btn-sm btn-info">
                                    Status: {{str_replace('_',' ', $order->status)}}
                                </button>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-success" name="button">
                                        <i class="fa fa-inr"></i> {{ number_format($order->total) }}
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="" style="width:100%">
                                    @php
                                    $name = json_decode($order->product_name);
                                    $image = json_decode($order->product_image);
                                    $qty = json_decode($order->product_qty);
                                    @endphp
                                    @for($i = 0; $i < count($name); $i++)
                                    <tr>
                                        <td class="text-center">
                                            <span class="bg-primary" style="padding:5px;border-radius:10%;">
                                                {{ $i+1 }}
                                            </span>
                                        </td>
                                        <td>
                                            <img class="center-block" src="{{image_url($image[$i])}}" style="width:75px" alt="Product Image" />
                                        </td>
                                        <td>
                                            <a href="javascript:;">
                                                {{$name[$i]}} {{ $qty[$i] > 1 ? 'x ('.$qty[$i].') Qty' : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <hr>
                                        </td>
                                    </tr>
                                    @endfor
                                </table>
                            </div>
                            <div class="panel-footer">
                                Ordered Place On:
                                <strong>{{date('D d M, Y', strtotime($order->created_at))}}</strong>
                                @if(!is_null($order->delivery_date))
                                Delivered on:
                                <strong>{{date('D d M, Y', strtotime($order->created_at))}}</strong>
                                @endif
                                <span class="pull-right">
                                    @if($order->status == 'cancelled')
                                    <a href="javascript:;" class="text-danger" title="Cancel Order">
                                        Cancelled on {{date('D d M, Y', strtotime($order->cancelled_at))}}
                                    </a>
                                    @else                                            
                                    @if($order->status == 'delivered')
                                    <a href="javascript:;" class="text-danger return-order" title="Return Order">
                                        <i class="fa fa-undo"></i> RETURN
                                    </a>
                                    {{-- <a href="javascript:;" class="text-danger complaint-order" title="Complaint">
                                        <i class="fa fa-question"></i> RAISE COMPLAIN
                                    </a> --}}
                                    @elseif($order->BdOrder && $order->BdOrder->expected_delivery_date)
                                    Expected Delivery Date: 
                                    {{date('M d, Y', strtotime($order->BdOrder->expected_delivery_date))}}
                                    @endif
                                    @if(in_array($order->status,['processing','packed','registered']))
                                    <a href="javascript:;" class="text-danger cancle-order pull-right" title="Cancel Order">
                                        Cancel Order
                                    </a>
                                    @endif
                                    @endif
                                </span>

                                <div style="display: none;" class="toggle-returnorder">
                                    <hr/>
                                    <form method="post" action="{{route('return_order', $order->id)}}" class="return_order_form">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <textarea type="text" name="return_reason" class="form-control" rows="3" placeholder="Reason" required="required"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="bank" placeholder="bank name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="account_no" placeholder="Account Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC code">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  name="mobile" placeholder="Enter mobile number" value="{{auth()->user()->phone ?? ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control"  name="email" placeholder="Enter email" value="{{auth()->user()->email ?? ''}}">
                                        </div>
                                        <div class="col-sm-2 col-sm-offset-10">
                                            <div class="form-group">

                                                <button class="btn btn-sm  btn-link">
                                                    Return Order <i class="fa fa-paper-plane"></i>
                                                </button>
                                            </div>    
                                        </div>
                                        <br/>
                                    </form>
                                   
                                </div>
                                 <div class="form-group text-center text-primary return_reason">{{($order->status == 'return')?'Your return request successfully registered': ''}}</div>
                                <div style="display: none;" class="toggle-complaintorder">
                                    <hr/>
                                    <form method="post" action="{{route('complain.store', $order)}}" class="complain_form">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label class="control-lable">
                                                Select Subject
                                            </label>
                                            <select style="width:100%" class="form-control" name="complain_type" required>
                                                <option value="" selected disabled>--SELECT COMPLAIN TYPE--</option>
                                                <option value="Order not delivered ">
                                                    Order not delivered
                                                </option>
                                                <option value="Wrong product delivered">
                                                    Wrong product delivered
                                                </option>
                                                <option value="Damaged product">
                                                    Damaged Product
                                                </option>
                                                <option value="other">
                                                    Other
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-lable">
                                                Message
                                            </label>
                                            <textarea name="message" class="form-control" rows="3" placeholder="Tell us more."></textarea>
                                        </div>
                                        <div class="form-group text-center text-primary" id="complain_msg">

                                        </div>
                                        <button class="btn btn-sm pull-right btn-danger">
                                            <i class="fa fa-paper-plane"></i> Raise complain
                                        </button>
                                        <br>
                                        <br>
                                    </form>
                                </div>

                                <div style="display: none;" class="toggle-cancelorder">
                                    <hr/>
                                    <form method="post" action="{{route('cancel_order', $order->id)}}">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <textarea type="text" name="reason" class="form-control" rows="3" placeholder="Cancel Reason"></textarea>
                                            <br>
                                            @if($order->payment_method != 'cod')
                                            <span class="text-info">
                                                <strong>NOTE:</strong> Your payment will be refunded in 7 working days
                                            </span>
                                            @endif
                                            <button class="btn btn-sm pull-right btn-link">
                                                Cancel Order <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endsection
@push('page-script')
<script type="text/javascript">
    $('.tab:not(:first)').hide();

    $(document).ready(function(){

        if ("{{old('address_line_0')}}" != "") {//validation failed for billing update
            $('.tab').hide();
            $('#billling-tab').show();
        }

        $('a.gap').click(function(){
            $('.tab').hide();
            $('#'+$(this).attr('id')+'-tab').show();
        });

        $('.return-order').click(function(){
            $(this).parent().parent().find('.toggle-returnorder').toggle('slow');
        });

        $('.complaint-order').click(function(){
            $(this).parent().parent().find('.toggle-complaintorder').toggle('slow');
        });

        $('.cancle-order').click(function(){
            $(this).parent().parent().find('.toggle-cancelorder').toggle('slow');
        });

        $('.complain_form').submit(function(e){
            e.preventDefault();
            $this = $(this);
            $this.find('#complain_msg').html('');
            $this.find('button i').removeClass('fa-paper-plane')
            .addClass('fa-spinner fa-spin');
            $.ajax({
                url : $this.attr('action'),
                data : $this.serialize(),
                method : 'post',
                success : function(data){
                    $this.trigger('reset');
                    $this.find('#complain_msg').html(data.message);
                    $this.find('button i').addClass('fa-paper-plane')
                    .removeClass('fa-spinner fa-spin');
                }
            })
        })

        $('.return_order_form').submit(function(e){
            e.preventDefault();
            $this = $(this);
            // $this.find('#complain_msg').html('');
            $this.find('button i').removeClass('fa-paper-plane')
            .addClass('fa-spinner fa-spin');
            $.ajax({
                url : $this.attr('action'),
                data : $this.serialize(),
                method : 'post',
                success : function(data){
                    $this.trigger('reset');
                    // $this.find('#return_reason').html(data);
                    $this.find('button i').addClass('fa-paper-plane')
                    .removeClass('fa-spinner fa-spin');
                    $this.parent().parent().find('.return_reason').html(data);
                    $this.parent().parent().find('.return-order').hide();
                    $this.parent('.toggle-returnorder').hide();
                    
                }
            })
        })
    })
</script>

@endpush