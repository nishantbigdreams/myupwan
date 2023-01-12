@extends('layouts.master')
@section('page-style')

@endsection
@section('page-content')
    <ul class="nav nav-tabs tabs-bordered">
        <li class="{{(session('tab') == '' || session('tab') == 'pack') ? 'active' : ''}}">
            <a href="#pack" data-toggle="tab" aria-expanded="false">
                Pack 
                <span class="label label-danger">
                    {{count($orders->where('status', 'processing'))}}    
                </span>
            </a>
        </li>
        <li class="{{session('tab') == 'handover' ? 'active' : ''}}">
            <a href="#handover" data-toggle="tab" aria-expanded="false">
                Handover
                <span class="label label-danger">
                    {{count($orders->where('status', 'packed'))}}    
                </span>
            </a>
        </li>
        <li class="{{session('tab') == 'registered' ? 'active' : ''}}">
            <a href="#registered" data-toggle="tab" aria-expanded="false">
                Registered
                <span class="label label-danger">
                    {{count($orders->where('status', 'registered'))}}    
                </span>
            </a>
        </li>
        <li class="">
            <a href="#in_transit" data-toggle="tab" aria-expanded="false">
                In Transit
                <span class="label label-danger">
                    {{count($orders->where('status', 'in_transit'))}}    
                </span>
            </a>
        </li><li class="">
            <a href="#undelivered" data-toggle="tab" aria-expanded="false">
                Undelivered
                <span class="label label-danger">
                    {{count($orders->where('status', 'Undelivered'))}}    
                </span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane {{(session('tab') == '' || session('tab') == 'pack') ? 'active' : ''}}" id="pack">
            <div class="row">
                <form action="{{route('admin.order.pack.all')}}" method="post" id="pack_all_form">
                    {{ csrf_field() }}
                    <div class="col-md-1">
                        <input type="checkbox" class="form-control select_all" data-type="pack">
                    </div>
                    <div class="col-md-11">
                        <button type="submit" class="btn btn-success btn-sm pull-right">
                            <i class="fa fa-cube"></i> PACK ALL ORDER
                        </button>
                    </div>
                </form>

                <!-- <a href="{{url('admin/purchaseorder')}}" class="btn btn-primary pull-right" title="Purchase Order"  >Purchase order</a> -->
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        @if(count($orders->where('status', 'processing')) == 0)
                            <span class="text-info">Order once placed will appear here</span>
                        @endif
                        <div class="clearfix"></div>
                            @foreach ($orders->where('status', 'processing') as $key => $order)
                            <div class="row">
                                <div class="col-md-1">
                                <input type="checkbox" class="form-control pack" name="orders[]" value="{{$order->id}}" form="pack_all_form" />
                                </div>
                                <div class="col-md-11">
                                    @include('admin.components.order_box',[
                                        'order' => $order,
                                        'action'=>['pack']
                                    ])
                                </div>
                            </div>
                            @endforeach
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane {{session('tab') == 'handover' ? 'active' : ''}}" id="handover">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h6>Register all orders at once</h6>
                        </div>
                        <form action="{{route('admin.register.all.orders')}}" method="post" id="register_all_form">
                            {{ csrf_field() }}
                            <div class="col-sm-1">
                                <input type="checkbox" class="form-control select_all" data-type="register" >
                            </div>
                            <div class="col-sm-4" style="visibility: hidden;">
                                <input type="text" name="reference_no" class="form-control input-sm" placeholder="Reference No">
                            </div>
                            <div class="col-sm-3" style="visibility: hidden;">
                                <div class="input-group">
                                    <input type="text" name="pickup_date" class="form-control input-sm pickup-date" placeholder="Pickup Date" required value="{{date('d-m-Y')}}">
                                    <span class="input-group-addon bg-custom b-0">
                                        <i class="mdi mdi-calendar text-white"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3" style="visibility: hidden;">
                                <div class="input-group">
                                    <input type="text" name="pickup_time" class="form-control input-sm pickup-time" placeholder="Pickup Time" required>
                                    <span class="input-group-addon bg-custom b-0">
                                        <i class="mdi mdi-clock text-white"></i>
                                    </span>
                                </div>
                            </div>

                           <!-- <div class="col-sm-2 col-sm-offset-10">
                                <button class="btn btn-custom btn-sm btn-block">
                                    <i class="fa fa-check"></i> REGISTER ALL ORDERS
                                </button>
                            </div>-->
                            <div class="col-sm-12 hidden">
                                <br/>
                                <div class="form-group">
                                    <textarea name="remark" class="form-control" placeholder="Remark if any"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h6>or Register them individually</h6>
                    <div class="card-box">
                        @if(count($orders->where('status', 'packed')) == 0)
                            <span class="text-info">Order once packed will appear here</span>
                        @endif
                        <div class="clearfix"></div>
                        @foreach ($orders->where('status', 'packed') as $order)
                            <div class="row">
                                <div class="col-md-1">
                                <input type="checkbox" class="form-control register" name="orders[]" value="{{$order->id}}" form="register_all_form" />
                                </div>
                                <div class="col-md-11">
                                    @include('admin.components.order_box',[
                                        'order' => $order,
                                        'action'=>['register']
                                    ])
                                </div>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane {{session('tab') == 'registered' ? 'active' : ''}}" id="registered">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('admin.order.all_to_transit')}}" method="post" id="transit_form">
                        {{ csrf_field() }}
                        <div class="col-md-1">
                            <input type="checkbox" class="form-control select_all" data-type="transit">
                        </div>
                        <div class="col-md-11">
                            <button class="btn btn-warning pull-right">
                                <i class="fa fa-paper-plane"></i> Move All To In Transit State
                            </button>
                            <a target="_blank" href="{{--route('admin.download.manifest')--}}" class="btn btn-primary pull-right">
                                <i class="fa fa-download"></i> MANIFEST
                            </a>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <br>
                    <div class="card-box">
                        @if(count($orders->where('status', 'registered')) == 0)
                            <span class="text-info">Order once packed will appear here</span>
                        @endif
                        @php
                        $orders->where('status', 'registered')->load('BdOrder');
                        @endphp
                        
                        @foreach ($orders->where('status', 'registered') as $order)
                        <div class="row">
                            <div class="col-md-1">
                            <input type="checkbox" class="form-control transit" name="orders[]" value="{{$order->id}}" form="transit_form" />
                            </div>
                            <div class="col-md-11">
                                @include('admin.components.order_box',[
                                    'order' => $order,
                                    'action'=>['awb','invoice','transit']
                                ])
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="in_transit">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        @if(count($orders->where('status', 'in_transit')) == 0)
                            <span class="text-info">Order once packed will appear here</span>
                             {{--<a  href="javascript:;" class="btn btn-sm btn-primary pull-right">
                                <i class="fa fa-check-circle"></i> Check Status
                            </a> --}}
                        @else
                             <a  href="{{route('admin.update.order_status')}}" class="btn btn-sm btn-primary pull-right">
                                <i class="fa fa-download"></i> Check Order Status
                            </a>  
                        @endif
                        
                        @php
                        $orders->where('status', 'in_transit')->load('BdOrder');
                        @endphp
                        @foreach ($orders->where('status', 'in_transit') as $order)
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.components.order_box',[
                                    'order' => $order,
                                    'action'=>['awb','invoice']
                                ])
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="undelivered">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                      
                       <a href="{{route('admin.update.order_status')}}" class="btn btn-sm btn-primary pull-right">
                            <i class="fa fa-download"></i> Check Order Status
                        </a>
                        
                        @php
                        $orders->where('status', 'Undelivered')->load('BdOrder');
                        @endphp
                        @foreach ($orders->where('status', 'Undelivered') as $order)
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.components.order_box',[
                                    'order' => $order,
                                    'action'=>['awb','invoice','cancel']
                                ])
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection

@section('page-scripts')
    <script type="text/javascript">
    $('input[name="dates"]').daterangepicker();

    $('.pickup-date').datepicker({
        autoclose:true,
        todayHighlight:true,
        daysOfWeekDisabled: [0],
        startDate: new Date(),
        format: 'dd-mm-yyyy'
    });

    $('.pickup-time').timepicker({
        showMeridian:false,
        minuteStep:15,
        defaultTime:'15:00',
        maxHours: 18,
    }).on('changeTime.timepicker', function(e) {
        var h= e.time.hours;
        var m= e.time.minutes;
        // var mer= e.time.meridian;
        //convert hours into minutes
        m+=h*60;
        //10:15 = 9h*60m  = 540 min
        if(m<540)
        $('.pickup-time').timepicker('setTime', '15:00');
    });

    $('.reg_order').click(function(){
        let has_error = $(this).data('reg_error');
        $form = $(this).parent().parent().find('.reg_form');
        if (has_error == 'no') {
            $form.submit();
        } else {
            $form.toggle();   
        }
    })
    </script>

    <script>
        $('.select_all').change(function(){
            let type = $(this).attr('data-type');
            if ($(this).prop('checked')) {
                $('.'+type).prop('checked',true);
            } else {
                $('.'+type).prop('checked',false);
            }
        });
    </script>
@endsection
