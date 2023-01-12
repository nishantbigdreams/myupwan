@extends('layouts.masterLayout')

@section('title','Create Invoice')

@section('style-content')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section('body-content')
    <form class="form-horizontal" role="form" action="/saveInvoice" method="POST" id="invoiceForm">
        {{ csrf_field() }}
        <div class="card animated slideInRight">
            <div class="card-header bg-dark-darker text-white">
                Customer Details
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card bg-white" style="height:200px">
                            <div class="card-block">
                                <h4 class="card-title">
                                    Customer Name: <strong class="text-capitalize">{{$customer->name}}</strong>
                                </h4>
                                <p class="card-text">
                                    Contact Details:<br>
                                    Phone: <strong>{{$customer->phone}}</strong><br>
                                    Email: <strong>{{is_null($customer->email)?'not specified':$customer->email}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-white" style="height:200px;overflow-y: scroll;">
                            <div class="card-block">
                                <h4 class="card-title">Address:
                                </h4>
                                <p class="card-text">
                                <span>
                                   <textarea class="form-control" name="customer_address" rows="4" placeholder="Customer Address">{{$invoice->address ?? $customer->flat_no." ".$customer->street}}</textarea>
                                    <strong>City: </strong>{{$customer->city}}<br>
                                    <strong>State: </strong>{{$customer->state}}<br>
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card animated slideInRight">
            <div class="card-header bg-dark-darker text-white">
                New Invoice
            </div>
            <div class="card-block">

                <div class="row m-a-0">
                    <div class="col-md-12">
                        <?php
                        $isProforma = false;
                        $allow_gst = true;
                        $dntshowGst = false;

                        $sales = "";
                        if(isset($invoice)){
                            if(is_null($invoice->tax_invoice) && is_null($invoice->notax_invoice)){
                                $isProforma = true;
                            }
                            if(!$invoice->allow_gst)
                            {
                                $allow_gst = false;
                            }
                        }
                        if(isset($invoice))
                            $sales = $invoice->type;
                        else
                            $sales = isset($request)?$request->type:'';
                        ?>
                        <div class="row">
                            <input type="hidden" name="contract_id" value="{{$contract->id??(isset($invoice)?$invoice->contract_id:"")}}">
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <input type="hidden" name="invoice_id" value="{{isset($invoice)?$invoice->id:''}}">

                            <input type="hidden" name="invoice_type" id="invoice_type" value="{{$sales}}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"><strong>Invoice #:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-6">
                                        <input name="inv_no" id="inv_no" type="text" class="form-control" placeholder="Invoice number." value="{{isset($invoice)?($invoice->allow_gst?$invoice->tax_invoice:$invoice->notax_invoice):$invoice_no}}" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>Date:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="invoice_date" id="invoice_date" class="form-control m-b" data-provide="datepicker" id="startDatePicker" placeholder="Invoice Date" value="{{isset($invoice)?date('m/d/Y',strtotime($invoice->invoice_date)):''}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>Type:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" style="width:100%" name="type" id="type">
                                            @isset($invoice)
                                            <option value="standard" {{$invoice->category=="standard"?'selected':''}}>STANDARD</option>
                                            <option value="custom" {{$invoice->category=="custom"?'selected':''}}>CUSTOM</option>
                                            @else
                                                <option value="standard">STANDARD</option>
                                                <option value="custom">CUSTOM</option>
                                                @endisset
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>State:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-9">
                                        <select data-placeholder="Select" required="" id="states" name="states" class="place form-control" style="width: 100%;" onchange="refreshCost()">
                                            <option value="" disabled="" selected>SELECT STATE</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->state_name}}" @if($state->state_name==$customer->state) selected @endif>{{$state->state_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"><strong>Invoice Period:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="invoice_period" id="invoice_period" class="form-control m-b" data-provide="datepicker" id="startDatePicker" placeholder="Invoice Period" value="{{isset($invoice)?date('m/d/Y',strtotime($invoice->invoice_period)):''}}" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><strong>Service Address:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-7">
                                        <input name="service_address" id="service_address" type="text" class="form-control" placeholder="Service Address." value="{{isset($invoice)?$invoice->service_address:""}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><strong>PO Number</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input name="po_no" id="po_no" type="text" class="form-control" placeholder="PO Number." value="{{isset($invoice)?$invoice->po_no:""}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"><strong>Proforma Invoice:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="col-sm-6" style="margin-top:0.5rem">
                                        <div class="cs-radio form-group">
                                            <div class="col-sm-1">&nbsp;</div>
                                            <input type="radio" id="ta3" name="proforma" value="yes" {{$isProforma?"checked":""}}>
                                            <label for="ta3">Yes</label>

                                            <input type="radio" id="ta4" name="proforma" value="no" {{!$isProforma?"checked":""}}>
                                            <label for="ta4">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(!isset($invoice))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label"><strong>SPLIT Invoice:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                        <div class="col-sm-6" style="margin-top:0.5rem">
                                            <div class="cs-radio form-group">
                                                <div class="col-sm-1">&nbsp;</div>
                                                <input type="radio" id="split_yes" name="invoice_category" value="split">
                                                <label for="split_yes">Yes</label>

                                                <input type="radio" id="split_no" name="invoice_category" value="" checked>
                                                <label for="split_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($customer->tax=='yes')
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><strong>Tax:</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                        <div class="col-sm-8" style="margin-top:0.5rem">
                                            <div class="cs-radio form-group">
                                                <div class="col-sm-1">&nbsp;</div>
                                                <input type="radio" id="ta1" name="gstInv" value="yes" {{$allow_gst?"checked":""}}>
                                                <label for="ta1">Yes</label>

                                                <input type="radio" id="ta2" name="gstInv" value="no" {{!$allow_gst?"checked":""}}>
                                                <label for="ta2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if($sales=='sales')
                            <hr style="border-color:black;margin-top:0px">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><strong>P.O. NO:</strong></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="po_no" id="po_no" class="form-control m-b" value="{{isset($invoice)?$invoice->po_no:''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><strong>P.O. Date:</strong></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="due_date" id="due_date" class="form-control m-b" data-provide="datepicker" id="endDatePicker" placeholder="PO Date" value="{{isset($invoice)?date('m/d/Y',strtotime($invoice->po_date)):''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><strong>Dispatch:</strong></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="dispatch_through" id="dispatch_through" class="form-control m-b" value="{{isset($invoice)?$invoice->dispatch:''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><strong>Address :</strong></label>
                                        <div class="col-sm-10">
                                            <textarea rows="3" name="delivery_address" class="form-control" placeholder="Delivery address">{{isset($invoice)?$invoice->delivery_address:''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr/>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            @if($sales=='sales')
                                <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#productModal"><i class="fa fa-plus"></i> Add More Products</button>
                            @else
                                <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#servicesModal"><i class="fa fa-plus"></i> Add More Services</button>
                            @endif
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped m-b-0">
                                    <thead class="bg-default-light">

                                    <th>Service Details</th>
                                    @if($sales=='sales')
                                        <th>Quantity</th>
                                    @endif
                                    <th class="custom">Unit Name</th>
                                    <th>FREQUENCY</th>
                                    <th>Rate</th>
                                    @if($customer->tax=='yes')
                                        <th class="gstInv">Tax (%) </th>
                                    @endif
                                    <th>Amount</th>

                                    </thead>
                                    <tbody class="addItems">
                                    @if(isset($invoice) || isset($estimate) || isset($contract))
                                        @for($i=0;$i<count($item_name);$i++)
                                            <tr>
                                                <td class="col-xs-4">
                                                    <input name="item_name[]" id="item_name" type="text" class="form-control col-xs-4 item-search" placeholder="Type a item name" required="" value="{{$item_name[$i] ?? 0}}">
                                                    <input type="hidden" name="item_id[]" value="{{$item_id[$i] ?? 0}}">
                                                    <textarea class="form-control" placeholder="Description" name="descriptions[]">{{$description[$i] ?? ''}}</textarea>
                                                </td>

                                                {{-- @if(isset($invoice) && optional($invoice)->category=="custom") --}}
                                                <td class="custom">
                                                    <input name="unit[]" type="text" class="form-control p-a-1" placeholder="Enter Unit" value="{{$units[$i] ?? ''}}">
                                                </td>
                                                <td>
                                                    <input name="unit_qty[]" type="number" min="0" class="form-control p-a-1 unit_qty" placeholder="" onchange="refreshCost()" value="{{$qtys[$i] ?? 1}}">
                                                </td>
                                                {{-- @endif --}}

                                                @if($sales=='sales')
                                                    <td><input name="item_qty[]" type="text" class="form-control p-a-1 qty" value="1" onchange="refreshCost()" required>
                                                    </td>
                                                @else
                                                    <input name="item_qty[]" type="hidden" class="form-control p-a-1 qty" value="1" onchange="refreshCost()" required>
                                                @endif

                                                <td><input name="item_rate[]" type="text" class="form-control p-a-1 rate" placeholder="" value="{{$price[$i] ?? 0}}" onchange="refreshCost()" required>
                                                </td>
                                                @if($customer->tax=='yes')
                                                    <td class="gstInv"><input name="item_tax[]" type="text" class="form-control p-a-1 tax" placeholder="" value="{{$item_tax[$i] ?? 0}}" onchange="refreshCost()">
                                                    </td>
                                                @endif
                                                <td>
                                                    <label name="amount" class="amount"></label>
                                                    <input type="hidden" class="tax_amount" name="amount[]">
                                                </td>
                                                <td class="bg-white" style="border:1px solid #fff;"><a class="removeRow" href="javascript:;"><i class="icon-close fa-lg text-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-5 pull-right">
                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Sub total</strong>
                                </div>
                                <div class="col-sm-6">
                                    <strong class="pull-right"><span id="subTotal">0</span> /-</strong>
                                </div>
                            </div>

                            <hr/>
                            @if($customer->tax=='yes')
                                <div id="nogst" class="gstInv">
                                    <div id="in_state">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>CGST</strong>
                                            </div>
                                            <div class="col-sm-6 pull-right">
                                                <div class="col-sm-8 input-group m-b">
                                                    <input type="text" class="form-control cgst" name="cgst" readonly="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-inr" aria-hidden="true"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>SGST</strong>
                                            </div>
                                            <div class="col-sm-6 pull-right">
                                                <div class="col-sm-8 input-group m-b">
                                                    <input type="text" class="form-control sgst" name="sgst" readonly="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-inr" aria-hidden="true"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="gst" id="gst" value="0">
                                    <div id="out_state">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>IGST</strong>
                                            </div>
                                            <div class="col-sm-6 pull-right">
                                                <div class="col-sm-8 input-group m-b">
                                                    <input type="text" class="form-control igst" name="igst" id="igst" readonly="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-inr" aria-hidden="true"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-sm-4">
                                    <strong>Discount</strong>
                                </div>
                                <div class="col-sm-6 pull-right">
                                    <div class="col-sm-8 input-group m-b">
                                        <input type="text" id="discount" name="discount" class="form-control" onchange="refreshCost()" value="{{isset($invoice)?$invoice->discount:(isset($estimate)?$estimate->discount:'')}}">
                                <span class="input-group-addon">
                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="adjustment_type" class="form-control"
                                           value="{{$invoice->adjustment_type ?? 'Adjustment'}}">
                                </div>

                                <div class="col-sm-6 pull-right">
                                    <div class="input-group m-b">
                                        {{--  <span class="input-group-addon">
                                             <i class="fa fa-minus text-danger" aria-hidden="true"></i>
                                         </span> --}}
                                        <input type="text" class="form-control" name="adjustment_value" id="adjustment" min="0" onchange="refreshCost()" value="{{isset($invoice)?$invoice->adjustment:(isset($estimate)?$estimate->adjustment:'')}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 text-primary">
                                    <i class="fa fa-info-circle"></i>
                                    Use (-) minus for negative adjustment e.g -100
                                </div>
                            </div>

                            <hr>
                            <div class="row bg-default-light p-a">
                                <div class="col-sm-4">
                                    <strong><span>Total Amount ( <i class="fa fa-inr"></i> )</span></strong>
                                </div>
                                <div class="col-sm-6 pull-right">
                                    <div class="input-group m-b">
                                        <input type="text" readonly="" class="form-control" readonly name="total_amount" id="total_amount">
                                <span class="input-group-addon">
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row hidden" id="split_div">
                        <h3 class="text-danger text-center">SPLIT INVOICE</h3>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <strong>Split Frequency</strong>
                                </label>
                                <div class="col-sm-8">
                                    <input type="number" name="split_frequency" id="split_frequency" class="form-control" required value="1" placeholder="SPLIT FREQUENCY" min=>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="split_start_date" class="control-label col-md-4">
                                    <strong>START DATE</strong>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" data-provide="datepicker" name="split_start_date" id="split_start_date" placeholder="START DATE" value="{{date('d-m-Y',strtotime(now()))}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="split_end_date" class="control-label col-md-4">
                                    <strong>END DATE</strong>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" data-provide="datepicker" name="split_end_date" id="split_end_date" placeholder="END DATE" value="{{date('d-m-Y',strtotime(now()->addMonth()))}}">
                                </div>
                            </div>
                        </div>
                        <div id="split"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label><strong>Invoice Notes:</strong></label>
                            <textarea class="form-control" id="summernote" name="note">{!! $invoice->note ?? '' !!}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <input type="submit" name="Preview" value="Save" class="btn btn-primary" onclick="$('form').attr('target', '');"> --}}
                        <button name="button" class="btn btn-dark" id="save">
                            <i class="fa fa-paper-plane"></i> SAVE
                        </button>
                        {{-- <input type="hidden" name="Preview" class="btn btn-success" target="_blank" value="SaveAndSend" onclick="$('form').attr('target', '');"> --}}
                        {{-- <input  type="hidden" name="Preview" class="btn btn-danger" target="_blank" value="Preview" onclick="$('form').attr('target', '_blank');"> --}}
                    </div>

                </div>
            </div>
        </div>

        @if($sales=='sales')
                <!-- Product Modal -->
        <div id="productModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-dark-darker text-white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">List Of Products</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" style="max-height: 400px;overflow-y: scroll;">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>QTY</th>
                                @if($customer->tax== 'yes')
                                    <th>Tax(%)</th>
                                @endif
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" class="form-control col-xs-1 check">
                                        </td>
                                        <td class="col-md-8">
                                            <p>{{$product->name}}</p>
                                            <input type="hidden" class="form-control col-xs-8 service_name" value="{{$product->name}}">
                                            <input type="hidden" class="form-control col-xs-8 service_id" value="{{$product->id}}">
                                            <input type="hidden" class="form-control col-xs-8 service_desc" value="{{$product->desc}}">
                                        </td>
                                        <td class="col-md-2">
                                            <p>{{$product->selling_price}}</p>
                                            <input type="hidden" class="form-control col-xs-2 service_price" value="{{$product->selling_price}}">
                                        </td>
                                        <td class="col-md-1">
                                            <p>{{$product->qty_avail}}</p>
                                            <input type="hidden" class="form-control col-xs-1 service_qty" value="{{$product->qty_avail}}">
                                        </td>
                                        @if($customer->tax=='yes')
                                            <td class="col-md-1">
                                                <p>{{$product->tax}}</p>
                                                <input type="hidden" class="form-control col-xs-1 service_tax" value="{{$product->tax}}">
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" id="items_length" value="{{count($items)}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal" id="addService"><i class="fa fa-plus"></i> Add Selected Product(s)</button>
                    </div>
                </div>
            </div>
        </div>
        @else

                <!-- Modal -->
        <div id="servicesModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-dark-darker text-white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">List Of services</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" style="max-height: 400px;overflow-y: scroll;">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Price</th>
                                @if($customer->tax== 'yes')
                                    <th>Tax(%)</th>
                                @endif
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" class="form-control col-xs-1 check">
                                        </td>
                                        <td class="col-md-8">
                                            <p>{{$item->item_name}}</p>
                                            <input type="hidden" class="form-control col-xs-8 service_name" value="{{$item->item_name}}">
                                            <input type="hidden" class="form-control col-xs-8 service_id" value="{{$item->id}}">
                                            <input type="hidden" class="form-control col-xs-8 service_desc" value="{{$item->description}}">
                                        </td>
                                        <td class="col-md-2">
                                            &#8377;{{$item->rate}}
                                            <input type="hidden" class="form-control col-xs-2 service_price" value="{{$item->rate}}">
                                            <input type="hidden" class="form-control col-xs-1 service_qty" value="1">
                                        </td>
                                        @if($customer->tax=='yes')
                                            <td class="col-md-1">
                                                {{$item->tax}}
                                                <input type="hidden" class="form-control col-xs-1 service_tax" value="{{$item->tax}}">
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" id="items_length" value="{{count($items)}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            <i class="fa fa-times"></i> Close
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal" id="addService"><i class="fa fa-plus"></i> Add Selected Service</button>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </form>
@endsection

@section('script-content')

    <script type="text/javascript">

        let allow_gst = null;
        let dntshowGst = null;
        let type = "";
        if($('#type').val()=="custom"){
            $('.custom').show();
        }else {
            $('.custom').hide();
        }
        $(function(){
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";
            $("#in_state").hide();
            $("#out_state").hide();
            $('.terms').click();
            $('.qty').trigger('change');

            if("{{isset($invoice)}}"){
                if("{{$customer->tax=='yes'}}"){
                    if("{{isset($invoice)?!$invoice->allow_gst:''}}"){
                        allow_gst = 0;
                        doesntAllowGst();
                    }
                    else{
                        if("{{isset($invoice)?$invoice->allow_gst:''}}"){
                            allow_gst = 1;
                            allowGst();
                        }
                    }
                }else{
                    if("{{isset($invoice)?!$invoice->dntshowGst:''}}"){
                        dntshowGst = 0;
                        dntShowGst();
                    }else{
                        if("{{isset($invoice)?$invoice->dntshowGst:''}}"){
                            dntshowGst = 1;
                            showGst();
                        }
                    }
                }
            }
            else{
                if("{{$customer->tax=='yes'}}"){
                    allow_gst = 1;
                }
                else{
                    allow_gst = 0;
                }
            }
            type = $('#invoice_type').val();
            var currentDate = new Date();
            $("#invoice_date").datepicker("setDate",currentDate);
            var oneMonthFromNow = new Date((+new Date) + 2678400000);
            $("#due_date").datepicker("setDate",oneMonthFromNow);
            refreshCost();
        });

        $(".removeRow").on('click',function(){
            $(this).parent().parent().remove();
            refreshCost();
        });

        $('#type').change(function(){
            if($(this).val()=="custom"){
                $('.custom').show();
            }else {
                $('.custom').hide();
            }
        });

        $("[name=proforma]").change(function(event) {

            if($(this).val()=='yes'){
                $('#inv_no').val("");
            } else {
                if("{{$customer->tax}}"=="yes"){
                    if($('#ta3').is(":checked")){
                        if("{{!isset($invoice)}}")
                            $('#inv_no').val('{{PrefixHelper::getInvoicePrefix(false)}}');
                        else
                            $('#inv_no').val("{{PrefixHelper::getInvoicePrefix(false)}}");
                    }else{
                        if("{{!isset($invoice)}}")
                            $('#inv_no').val('{{PrefixHelper::getInvoicePrefix(true)}}');
                        else
                            $('#inv_no').val("{{PrefixHelper::getInvoicePrefix(true)}}");
                    }
                }else{
                    if("{{!isset($invoice)}}")
                        $('#inv_no').val('{{PrefixHelper::getInvoicePrefix(false)}}');
                    else
                        $('#inv_no').val("{{PrefixHelper::getInvoicePrefix(false)}}");
                }
            }
        });

        $(document).on('click','[name=gstInv]',function(){
            if($("#ta1").is(':checked'))
            {
                allow_gst = 1;
                allowGst();
            }
            else
            {
                allow_gst = 0;
                doesntAllowGst();
            }
            invoice_no = $('#inv_no').val();
            refreshCost();
        });

        $(document).on('click','[name=dntshowGst]',function(){
            if($("#stax1").is(':checked')){
                showGst();
            }else{
                dntShowGst();
            }
            refreshCost();
        });

        function dntShowGst(){
            $('.dntshowGst').hide(100);
            $('.tax').val(0);
            dntshowGst = 0;
        }

        function showGst(){
            dntshowGst = 1;
            $('.dntshowGst').show(100);
        }

        function allowGst()
        {
            $(".gstInv").show(100);
            $('.tax').attr('required','required');
            if("{{!isset($invoice)}}")
                $('#inv_no').val('{{PrefixHelper::getInvoicePrefix(true)}}');
        }

        function doesntAllowGst()
        {
            $('.tax').removeAttr('required');
            $(".gstInv").hide(100);
            if("{{!isset($invoice)}}")
                $('#inv_no').val('{{PrefixHelper::getInvoicePrefix(false)}}');
            $('.tax').val(0);
        }

        //calculation

        $('#addService').click(function(){
            let items_length = null;
            if(type=='sales')
                items_length={{count($products)}};
            else
                items_length={{count($items)}};

            var new_type='';
            var field=$('.addItems');

            for(var i=0;i<items_length;i++){
                if($(".check").eq(i).is(':checked')){
                    new_type = '<tr>'+
                            '<td class="col-xs-4">'+
                            '<input name="item_name[]" id="item_name" type="text" class="form-control col-xs-4" placeholder="Type a item name" value="'+$(".service_name").eq(i).val()+'">'+
                            '<input type="hidden" name="item_id[]" value="'+$('.service_id').eq(i).val()+'"><textarea class="form-control" placeholder="Description" name="descriptions[]" >'+$(".service_desc").eq(i).val()+'</textarea>'+
                            '</td>';
                    new_type +='<td class="custom">'+
                            '<input name="unit[]" type="text" class="form-control p-a-1" placeholder="Enter Unit">'+
                            '</td>';

                    new_type += '<td>'+
                            '<input name="unit_qty[]" type="number" min="0" class="form-control p-a-1 unit_qty" placeholder="" onchange="refreshCost()" value="1">'+
                            '</td>';
                    if("{{$sales}}"=='sales'){
                        new_type += '<td>'+
                                '<input name="item_qty[]" type="number" step="any" min="0" max="'+$('.service_qty').eq(i).val()+'" class="form-control p-a-1 qty" placeholder="" onchange="refreshCost()" value="1">'+
                                '</td>';
                    }else{
                        new_type += '<input name="item_qty[]" type="hidden" class="form-control p-a-1 qty" onchange="refreshCost()" value="1">';
                    }
                    new_type += '<td>'+
                            '<input name="item_rate[]" type="text" class="form-control p-a-1 rate" placeholder="" onchange="refreshCost()" value="'+$(".service_price").eq(i).val()+'">'+
                            '</td>';
                    if("{{$customer->tax}}"== 'yes'){
                        new_type += '<td class="gstInv">'+
                                '<input name="item_tax[]" type="text" class="form-control p-a-1 tax" placeholder="18" onchange="refreshCost()" value="'+$(".service_tax").eq(i).val()+'">'+
                                '</td>';
                    }
                    new_type += '<td><label name="amount" class="amount">'+$(".service_price").eq(i).val()+'</label><input type="hidden" class="tax_amount" name="amount[]" value="0"></td>'+
                            '<td class="bg-white" style="border:1px solid #fff;"><a class="removeRow" href="javascript:;"><i class="icon-close fa-lg text-danger"></i></a></td></tr>';

                    field.append(new_type);
                    $('#type').trigger('change');

                    if(allow_gst==1)
                        allowGst();

                    if(allow_gst==0)
                        doesntAllowGst();

                    if(dntshowGst==0)
                        dntShowGst();

                    if(dntshowGst==1)
                        showGst();
                }
            }
            $(".removeRow").on('click',function(){
                $(this).parent().parent().remove();
                refreshCost();
            });
            $(".qty").eq(0).trigger("change");
            $('.check').attr('checked',false);
        });

        $(".removeRow").on('click',function(){
            $(this).parent().parent().remove();
            refreshCost();
        });

        function refreshCost(){

            var gst=0;
            var total=0;
            var subTotal=0;
            var i=0;
            var st_name = $("#states").val();
            var company_state = "{{Company::detail()->company_state}}";

            while(true){
                if($(".rate").eq(i).val()){

                    var id = parseFloat($(".id").eq(i).val());
                    var qt = parseFloat($(".qty").eq(i).val());
                    if($('#type').val()=="custom"){
                        qt = parseFloat($(".unit_qty").eq(i).val());
                    }
                    var rate = parseFloat($(".rate").eq(i).val());
                    var unit_qty = parseFloat($(".unit_qty").eq(i).val());
                    var tax=0;
                    if(('{{$customer->tax}}' == 'yes'))
                    {
                        tax = parseFloat($(".tax").eq(i).val())/2;
                    }
                    if(isNaN(tax)){
                        tax = 0;
                    }
                    if(isNaN(unit_qty)){
                        unit_qty = 1;
                    }

                    //calculate gst but dont show
                    if('{{$customer->tax}}' == 'no')
                    {
                        // gst = (rate*tax)/100;
                        // var tax_amount = rate+(gst*2);
                        $(".amount").eq(i).html(qt*rate);
                        console.log('qt '+qt+' rate '+rate);
                        $(".tax_amount").eq(i).val(rate*qt);
                        subTotal += (qt*rate);
                        $("#subTotal").html(subTotal);
                        cost = subTotal;
                    }
                    else
                    {
                        $(".amount").eq(i).html(qt*rate);
                        gst += ((qt*rate)*tax)/100;
                        subTotal += (qt*rate);
                        $("#subTotal").html(subTotal);
                        cost = subTotal + gst*2;
                    }

                    if(gst==0)
                    {
                        $("#nogst").hide(500);
                    }
                    else
                    {
                        $("#nogst").show();
                    }

                    if(st_name == company_state)
                    {
                        $("#in_state").show();
                        $("#out_state").hide();
                        $('.cgst').val(gst);
                        $('.sgst').val(gst);
                        $('#gst').val(gst*2);
                    }
                    else
                    {
                        $("#in_state").hide();
                        $("#out_state").show();
                        $('#igst').val(gst*2);
                        $('#gst').val(gst*2);
                    }
                    var discount=0;
                    if($("#discount").val()!=''){
                        discount = cost * parseFloat($("#discount").val())/100;
                    }

                    var total = cost - discount;

                    if($('#adjustment').val()!=""){
                        total = total + parseFloat($('#adjustment').val());
                    }
                    $("#total_amount").val(total);
                    $('#split_frequency').trigger('change');

                    i++;

                }else{
                    break;
                }
            }
            if(i==0){
                $("#total_amount").val('');
                $('#adjustment').val('');
                $('.cgst').val('');
                $('.sgst').val('');
                $("#subTotal").html(0);
            }
        }
    </script>

    <script type="text/javascript">
        $('[name=invoice_category]').change(function(){
            $('#split_div').toggleClass('hidden');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.js"></script>
    <script type="text/javascript" src="{{asset('js/split_invoice.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Start Writing your Notes for this invoice here...',
                disableDragAndDrop: false,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['Misc',['undo','redo']],
                    ['Insert',['table','hr']]
                ]

                // tabsize: 2,
                // height: 100
            });
        });
    </script>
@endsection
