<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style media="all">

    .bt-2 {
        border-top: 2px solid #000;
    }
    .bb-2 {
        border-bottom: 2px solid #000;
    }
    .br-1 {
        border-right: 1px solid #000;
    }
    .bl-1 {
        border-left: 1px solid #000;
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
        <div class="col-xs-6 br-1">
            <div class="row bt-2">
                <div class="col-xs-6">
                    <span class="text-uppercase">
                        <h3 class="text-uppercase">
                            <strong>
                                delivery address
                            </strong>
                        </h3>
                        buyed <br/>
                        <strong>
                            mittal polyplast pvt ltd.
                        </strong><br/>
                        22/24, gami house,<br/>
                        modi street, nr.g.p.o.,<br/>
                        fort, mumbai-400001<br/>
                        maharshtra-india<br/>
                        +91-22-22642400<br/>
                        company gst : 2700444<br/>
                    </span>
                </div>
                <div class="col-xs-6">
                    <h1 class="text-uppercase"><strong>dart apex (cod)</strong></h1>
                </div>
            </div>
            <div class="row bt-2">
                <div class="col-xs-6">
                    <h3 class="text-uppercase"><strong>bluedart</strong></h3>
                </div>
                <div class="col-xs-6">
                    <h3 class="text-uppercase"><strong>cash on delivery</strong></h3>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>item name and sku</th>
                        <th>qty</th>
                        <th>value per qty</th>
                        <th>collect</th>
                    </tr>
                    <tr>
                        <td>DDS 260 GSM (4*6) inkjet professinal glossy rc photo paper - 100 sheet pack</td>
                        <td>1</td>
                        <td>1000.00</td>
                        <td>1500</td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <img src="{{ asset('images/pdf/handle.jpg') }}" alt="" class="img-responsive center-block">
                </div>
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4">
                    <h3 class="text-uppercase">
                        product photo
                        <img src="{{ asset('images/small/img-8.jpeg') }}" alt="" class="img-responsive center-block" style="width: 100px">
                    </h3>
                </div>
            </div>
            <div class="row bt-2">
                <div class="col-xs-6">
                    <h3 class="text-uppercase">
                        <strong>
                            shipper address
                        </strong>
                    </h3>
                </div>
                <div class="col-xs-6">
                    <span class="text-uppercase">

                        <br/>
                        <strong>
                            mittal polyplast pvt ltd.
                        </strong><br/>
                        22/24, gami house,<br/>
                        modi street, nr.g.p.o.,<br/>
                        fort, mumbai-400001<br/>
                        maharshtra-india<br/>
                        +91-22-22642400<br/>
                        company gst : 2700444<br/>
                    </span>
                </div>
            </div>
            <div class="row bt-2">
                <h4 class="text-right">
                    <strong>
                        ordered via DDSKART.COM
                    </strong>
                </h4>
            </div>
        </div>

        <div class="col-xs-6 bl-1">
            <div class="row bt-2">
                <div class="col-xs-6">
                    <img src="{{ asset('website/img/logo.png') }}" alt="farmercart LOGO" class="img-responsive center-block" style="height:120px;">
                </div>
                <div class="col-xs-6">
                    <h1 class="text-uppercase"><strong>retail invoice</strong></h1>
                    <h3 class="text-uppercase">invoice no: sk/15-16/001</h3>
                    <h3 class="text-uppercase">invoice date : 18/03/2016</h3>
                </div>
            </div>
            <div class="row bt-2">
                <div class="col-xs-6">
                    <span class="text-uppercase">
                        seller <br/>
                        <strong>
                            mittal polyplast pvt ltd.
                        </strong><br/>
                        22/24, gami house,<br/>
                        modi street, nr.g.p.o.,<br/>
                        fort, mumbai-400001<br/>
                        maharshtra-india<br/>
                        +91-22-22642400<br/>
                        company gst : 2700444<br/>
                    </span>
                </div>
                <div class="col-xs-6">
                    <span class="text-uppercase">
                        buyer <br/>
                        <strong>
                            mittal polyplast pvt ltd.
                        </strong><br/>
                        22/24, gami house,<br/>
                        modi street, nr.g.p.o.,<br/>
                        fort, mumbai-400001<br/>
                        maharshtra-india<br/>
                        +91-22-22642400<br/>
                        company gst : 2700444<br/>
                    </span>
                </div>
            </div>
            <div class="row bt-2">
                <div class="text-uppercase text-center ptb-15">
                    dispatched via <strong>blue dart</strong>
                    dispatched doc no <strong>(awb)</strong> 1234567890
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>s.no.</th>
                        <th>item description</th>
                        <th>qty</th>
                        <th>rate</th>
                        <th>gst</th>
                        <th class="col-xs-2">amount</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>DDS 260 GSM (4*6) inkjet professinal glossy rc photo paper - 100 sheet pack</td>
                        <td>1</td>
                        <td>1000.00</td>
                        <td>500 (18%)</td>
                        <td>1500</td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-10 ptb-15">
                    <div class="text-uppercase text-center"><strong>total</strong></div>
                </div>
                <div class="col-xs-2 ptb-15">
                    <div class="text-uppercase text-center"><strong>RS. 1500</strong></div>
                </div>
            </div>
            <div class="row bt-2">
                <div class="text-uppercase">
                    <strong>Amount in words : one thousand five hunderd only</strong>
                </div>
                <br/>
                <strong class="text-uppercase"> declaration</strong><br/>
                We declare that this invoice shows actaul price of all goods described inclusive of all taxes and that all particulars are true and correct.<br/>
                <strong class="text-uppercase"> customer acknowledgment</strong><br/>
                IJITUL ALI hereby confirm that the above said product/s are being purchased for my internal personal consumption / re-sale.
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
