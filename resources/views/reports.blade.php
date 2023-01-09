@extends('layouts.master')
@section('page-style')

@endsection
@section('page-content')
<div class="card-box">
    <div class="row">
        <div class="col-md-3">
            <span class="text-custom">Payment NEFT</span><br/>
            NFT-184111x484xxxx
        </div>
        <div class="col-md-3">
            <span class="text-custom">Account No.</span><br/>
            46445461
        </div>
        <div class="col-md-3">
            <span class="text-custom">Payment Date.</span><br/>
            May 18 ,2018
        </div>
        <div class="col-md-3">
            <span class="text-custom">Total Amount</span> <br/>
            ₹ 1,180.86
        </div>
    </div>
</div>
<div class="card-box">
    <h4>Order Transactions : ₹ 1,180.86</h4>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Item Id</th>
                    <th>Order Id</th>
                    <th>Dispatched Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 3; $i++)
                <tr>
                    <td>545</td>
                    <td>185211</td>
                    <td>May 18</td>
                    <td>Return</td>
                    <td>&#8377; 152000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-eye text-custom"></i> View More
                        </a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
<div class="card-box">
    <h4>Storage & Recall Transactions : ₹ 1,180.86</h4>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Listing Id</th>
                    <th>Recall Id</th>
                    <th>State Code</th>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 3; $i++)
                <tr>
                    <td>545</td>
                    <td>185211</td>
                    <td>May 18</td>
                    <td>Return</td>
                    <td>&#8377; 152000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-eye text-custom"></i> View More
                        </a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
<div class="card-box">
    <h4>Non Order SPF Transactions : ₹ 1,180.86</h4>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Claim Id</th>
                    <th>Date</th>
                    <th>Warehouse Id</th>
                    <th>SKU</th>
                    <th>Protection Reason</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 3; $i++)
                <tr>
                    <td>545</td>
                    <td>185211</td>
                    <td>May 18</td>
                    <td>Return</td>
                    <td>f</td>
                    <td>&#8377; 152000</td>

                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
<div class="card-box">
    <h4>TDS Transactions : ₹ 0.00</h4>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Claim Id</th>
                    <th>Claim Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 3; $i++)
                <tr>
                    <td>185211</td>
                    <td>May 18</td>
                    <td>&#8377; 152000</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
<div class="card-box">
    <h4>Ads Transactions : ₹ 1,180.86</h4>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction Id</th>
                    <th>Transaction Date</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 3; $i++)
                <tr>
                    <td>185211</td>
                    <td>May 18</td>
                    <td>Return</td>
                    <td>&#8377; 152000</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('page-scripts')

@endsection
