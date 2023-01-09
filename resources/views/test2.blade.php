<!DOCTYPE html>
<html>
<head>
    <title>INVOICE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        .m-height355px {
            min-height: 355px !important;
        }

        .m-height75px {
            min-height: 75px;
        }

        .b-a {
            border: 2px solid black;
        }

        .b-t {
            border-top: 2px solid black;
        }

        .b-r {
            border-right: 2px solid black;
        }

        .b-b {
            border-bottom: 2px solid black;
        }

        .b-l {
            border-left: 2px solid black;
        }

        .bold {
            font-weight: bold;
        }

        .lh10 {
            line-height: 10px;
        }

    </style>
</head>
<body style="padding: 30px;">
<?php
$detail = Company::detail();
?>
<div class="row">
    <div class="col-xs-6">
        <h4 class="bold lh10">Invoice Date: {{date('d M, Y', strtotime($invoice->invoice_date))}}</h4>
        <h4 class="bold lh10">Invoice No.: {{$invoice->getInvoiceNo()}}</h4>
        @if($invoice->contract)
            <h4 class="bold">Contract Period.: <br>
                @if($invoice->contract->contract_start && $invoice->contract->contract_start != '1970-01-01')
                    {{date('d M, Y',strtotime($invoice->contract->contract_start))}}
                @endif
                @if($invoice->contract->contract_end && $invoice->contract->contract_end != '1970-01-01')
                    - {{date('d M, Y',strtotime($invoice->contract->contract_end))}}
                @endif
            </h4>
        @endif
        <h4 class="bold">PO Number:
            {{$invoice->po_no}}
        </h4>
        <h4 class="bold">Invoice Period:
            {{date('d M, Y',strtotime($invoice->invoice_period))}}
        </h4>
        <h4 class="bold">Service Address: <br>
            <h4 class="">{{$invoice->service_address}}</h4>
        </h4>
        @if($invoice->type=='sale')
            <h4 class="bold lh10">Service Order No.:</h4>
            <h4 class="bold lh10">Period Of Contract:</h4>
        @endif
    </div>
    <div class="col-xs-6">
        <h4 class="bold text-right lh10">{{company_name($detail,$invoice->allow_gst)}}</h4>
        <h4 class="text-right"> {!!nl2br(company_address($detail,$invoice->allow_gst))!!}</h4>
        <h4 class="text-right lh10">Phone: {{company_phone($detail,$invoice->allow_gst)}}</h4>
    </div>
</div>
<div class="text-center">
    @if($invoice->allow_gst)
        <h4 class="bold">TAX INVOICE</h4>
    @else
        <h4 class="bold">INVOICE</h4>

    @endif
</div>

<div class="row b-a">
    <div class="col-xs-6">
        <h4 class="bold lh10">To,</h4>
        <h4 class="bold">{{$customer->name}},</h4>
        <h4 class="">
            @if(!is_null($invoice->address))
                {!!nl2br($invoice->address)!!}
            @else
                {!!$customer->street!!} <br>
            @endif
            {{$customer->city}} {{$customer->pincode }}
        </h4>
    </div>
    <div class="col-xs-6">
        <h4>&nbsp;</h4>
        @if(!is_null($customer->gst_no))
            <h4 class="lh10"><span class="bold">GSTIN:</span> {{$customer->gst_no}} </h4>
        @endif
        <h4 class="lh10"><span class="bold">State:</span> {{$invoice->state}}</h4>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-2 b-t b-b b-r">
        <h4 class="bold text-center">Sr. No.</h4>
    </div>
    <div class="col-xs-5 b-t b-b b-r">
        <h4 class="bold text-center">Description of Work</h4>
    </div>
    <div class="col-xs-3 b-t b-b b-r">
        <h4 class="bold text-center">{{$invoice->category == 'custom' ? 'QTY' : 'Frequency'}}</h4>
    </div>
    <div class="col-xs-2 b-t b-b">
        <h4 class="bold text-center">Rate</h4>
    </div>

    @if($invoice->split_invoice==0)
        @include('pdf.split_invoice_table')
    @else
        @include('pdf.normal_invoice_table')
    @endif
</div>
<div class="row">
    <table class="table table-bordered" style="page-break-inside: avoid;">
        <tr>
            <td class="col-xs-7" style="border-width: 1px 2px 2px; border-color: black; border-style: solid; ">
                <h4 class="bold">BANK DETAILS</h4>
                {!! nl2br(company_notes($detail,$invoice->allow_gst)) !!}
            </td>
            <td class="col-xs-5" style="border-width: 1px 2px 2px; border-color: black; border-style: solid; ">
                <h4 class="bold text-center lh10"> {{company_name($detail,$invoice->allow_gst)}}</h4>
                <?php $signature = company_signature($detail, $invoice->allow_gst);?>

                @if($send==null)
                    <div style="height:130px">

                    </div>
                @else
                    @if($signature)
                        <center>
                            <img src="{{asset($signature)}}" class="img-responsive" style="height:150px">
                        </center>
                    @endif
                @endif
                <h4 class="text-center lh10">Authorized Signatory</h4>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
