@extends('layouts.master')
@section('page-style')

@endsection
@section('page-content')
<ul class="nav nav-tabs tabs-bordered">
    <li class="active">
        <a href="#Approved" data-toggle="tab" aria-expanded="true">
            Approved
        </a>
    </li>
    <li class="">
        <a href="#inTransit" data-toggle="tab" aria-expanded="false">
            In Transit
        </a>
    </li>
    <li class="">
        <a href="#Completed" data-toggle="tab" aria-expanded="false">
            Completed
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="Approved">
        <div class="row bg-gray">
            <div class="col-md-12">
                <h4>FILTERS</h4>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3">
                <div class="card-box">
                    <h5>BY SKU</h5>
                    <div class="form-group search-box">
                        <input type="text" id="search-input" class="form-control product-search" placeholder="Search here...">
                        <button type="submit" class="btn btn-search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <hr>
                    <h5>RETURNS APPROVED</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="" name="dates">
                    </div>
                    <hr>
                    <h5>PHYSICAL DELIVERY</h5>
                    <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                        <input id="Expect" type="checkbox">
                        <label for="Expect">Expect</label><br/>
                        <input id="DontExpect" type="checkbox">
                        <label for="DontExpect">Dont Expect</label>
                    </div>
                    <hr>
                    <h5>FULFILLMENT TYPE</h5>
                    <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                        <input id="Non-FA" type="checkbox">
                        <label for="Non-FA">Non-FA</label><br/>
                        <input id="FA" type="checkbox">
                        <label for="FA">FA</label>
                    </div>
                    <hr/>
                    <h5>SORT BY</h5>
                    <div class="radio radio-custom">
                        <input type="radio" name="ApprovalDate" id="Latest Approval Date" value="Latest Approval Date">
                        <label for="Latest Approval Date">
                            Latest Approval Date
                        </label><br/>
                        <input type="radio" name="ApprovalDate" id="Oldest Approval Date" value="Oldest Approval Date">
                        <label for="Oldest Approval Date">
                            Oldest Approval Date
                        </label><br/>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card-box">
                    @for ($i=0; $i < 3; $i++)
                    <article class="row">
                        <header class="col-md-12">
                            <h4>
                                <a href="#">Exclusive: Get a First Look at the Fall Collection</a>
                            </h4>
                        </header>
                        <div class="col-md-4">
                            SKU: <br/>
                            <strong>ECO-12 LAMINATION MACHINE</strong>
                        </div>
                        <div class="col-md-4">
                            Item ID: <br/>
                            <strong>21234064271723300</strong>
                        </div>
                        <div class="col-md-4">
                            Buyer Name: <br/>
                            <strong>Rathva Sureshbhai Khimabhai</strong>
                        </div>
                        <div class="clearfix m-t-15"></div>
                        <div class="m-t-15">
                            <div class="col-md-1">
                                Price <br/>
                                <strong>₹ 2725</strong>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-3">
                                    Return Detail<br/>
                                    Return ID: <br/>12201238467189401525
                                    May 22, 2018
                                </div>
                                <div class="col-md-3">
                                    Type
                                    Customer Return
                                    Expect Physical Delivery
                                    Replacement
                                </div>
                                <div class="col-md-3">
                                    Reason<br/>
                                    Missing Item<br/>
                                    Buyer Comment <br/>
                                </div>
                                <div class="col-md-3">
                                    Tracking Detail<br/>
                                    With Customer
                                    Approved On: <br/>
                                    May 22, 2018<br/>
                                    ID:  510436396<br/>
                                </div>
                            </div>
                        </div>
                    </article>
                    <div class="btn-group btn-group-justified m-b-10">
                        <a href="#productDetails" class="btn btn-custom w-lg" data-animation="sign" data-plugin="custommodal"
                        data-overlaySpeed="100" data-overlayColor="#36404a">
                        View Details
                    </a>
                    <a class="btn btn-danger waves-effect waves-light" role="button">
                        Contact SS
                    </a>
                </div>
                <hr/>
                @endfor
            </div>
        </div>
    </div>
</div>
<div class="tab-pane" id="inTransit">
    <div class="row">
        <div class="col-md-3">
            <div class="card-box">
                <h4>Filter</h4>
                <hr>
                <h5>BY SKU</h5>
                <div class="form-group search-box">
                    <input type="text" id="search-input" class="form-control product-search" placeholder="Search here...">
                    <button type="submit" class="btn btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <hr/>
                <h5>OUT FOR DELIVERY</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" name="dates">
                </div>
                <hr/>
                <h5>RETURNS PROMISE</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" name="dates">
                </div>
                <hr/>
                <h5>RETURNS APPROVED</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" name="dates">
                </div>
                <hr>
                <h5>RETURN PROMISE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="Breached" type="checkbox">
                    <label for="Breached">Breached</label><br/>
                    <input id="Non Breached" type="checkbox">
                    <label for="Non Breached">Non Breached</label>
                </div>
                <hr>
                <h5>RETURN TYPE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="CustomerReturn" type="checkbox">
                    <label for="CustomerReturn">Customer Return</label><br/>
                    <input id="CourierReturn" type="checkbox">
                    <label for="CourierReturn">Courier Return</label>
                </div>
                <hr>
                <h5>FULFILLMENT TYPE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="Non-FA" type="checkbox">
                    <label for="Non-FA">Non-FA</label><br/>
                    <input id="FA" type="checkbox">
                    <label for="FA">FA</label>
                </div>
                <hr>
                <h5>SORT BY</h5>
                <div class="radio radio-custom">
                    <input type="radio" name="TransitDate" id="OldestPromiseDate" value="Oldest Promise Date">
                    <label for="OldestPromiseDate">
                        Oldest Promise Date
                    </label><br/>
                    <input type="radio" name="TransitDate" id="LatestPromiseDate" value="LatestPromiseDate">
                    <label for="LatestPromiseDate">
                        Latest Promise Date
                    </label><br/>
                    <input type="radio" name="TransitDate" id="LatestApprovalDate" value="LatestApprovalDate">
                    <label for="LatestApprovalDate">
                        Latest Approval Date
                    </label>
                    <input type="radio" name="TransitDate" id="OldestApprovalDate" value="OldestApprovalDate">
                    <label for="OldestApprovalDate">
                        Oldest Approval Date
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card-box">
                @for ($i=0; $i < 3; $i++)
                <article class="row">
                    <header class="col-md-12">
                        <h4>
                            <a href="#">Exclusive: Get a First Look at the Fall Collection</a>
                        </h4>
                    </header>
                    <div class="col-md-4">
                        SKU: <br/>
                        <strong>ECO-12 LAMINATION MACHINE</strong>
                    </div>
                    <div class="col-md-4">
                        Item ID: <br/>
                        <strong>21234064271723300</strong>
                    </div>
                    <div class="col-md-4">
                        Buyer Name: <br/>
                        <strong>Rathva Sureshbhai Khimabhai</strong>
                    </div>
                    <div class="clearfix m-t-15"></div>
                    <div class="m-t-15">
                        <div class="col-md-1">
                            Price <br/>
                            <strong>₹ 2725</strong>
                        </div>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                Return Detail<br/>
                                Return ID: <br/>12201238467189401525
                                May 22, 2018
                            </div>
                            <div class="col-md-3">
                                Type
                                Customer Return
                                Expect Physical Delivery
                                Replacement
                            </div>
                            <div class="col-md-3">
                                Reason<br/>
                                Missing Item<br/>
                                Buyer Comment <br/>
                            </div>
                            <div class="col-md-3">
                                Tracking Detail<br/>
                                With Customer
                                Approved On: <br/>
                                May 22, 2018<br/>
                                ID:  510436396<br/>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="btn-group btn-group-justified m-b-10">
                    <a href="#productDetails" class="btn btn-custom w-lg" data-animation="sign" data-plugin="custommodal"
                    data-overlaySpeed="100" data-overlayColor="#36404a">
                    View Details
                </a>
                <a class="btn btn-danger waves-effect waves-light" role="button">
                    Contact SS
                </a>
            </div>
            <hr/>
            @endfor
        </div>
    </div>
</div>
</div>
<div class="tab-pane" id="Completed">
    <div class="row">
        <div class="col-md-3">
            <div class="card-box">
                <h4>Filter</h4>
                <hr>
                <h5>BY SKU</h5>
                <div class="form-group search-box">
                    <input type="text" id="search-input" class="form-control product-search" placeholder="Search here...">
                    <button type="submit" class="btn btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <hr/>
                <h5>RETURN DELIVERED</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" name="dates">
                </div>

                <hr/>
                <h5>RETURNS APPROVED</h5>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="" name="dates">
                </div>
                <hr>
                <h5>RETURN PROMISE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="Breached" type="checkbox">
                    <label for="Breached">Breached</label><br/>
                    <input id="Non Breached" type="checkbox">
                    <label for="Non Breached">Non Breached</label>
                </div>
                <hr>
                <h5>RETURN TYPE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="CustomerReturn" type="checkbox">
                    <label for="CustomerReturn">Customer Return</label><br/>
                    <input id="CourierReturn" type="checkbox">
                    <label for="CourierReturn">Courier Return</label>
                </div>
                <hr>
                <h5>FULFILLMENT TYPE</h5>
                <div class="checkbox checkbox-primary checkbox-single m-r-15 m-l-5">
                    <input id="Non-FA" type="checkbox">
                    <label for="Non-FA">Non-FA</label><br/>
                    <input id="FA" type="checkbox">
                    <label for="FA">FA</label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card-box">
                @for ($i=0; $i < 3; $i++)
                <article class="row">
                    <header class="col-md-12">
                        <h4>
                            <a href="#">Exclusive: Get a First Look at the Fall Collection</a>
                        </h4>
                    </header>
                    <div class="col-md-4">
                        SKU: <br/>
                        <strong>ECO-12 LAMINATION MACHINE</strong>
                    </div>
                    <div class="col-md-4">
                        Item ID: <br/>
                        <strong>21234064271723300</strong>
                    </div>
                    <div class="col-md-4">
                        Buyer Name: <br/>
                        <strong>Rathva Sureshbhai Khimabhai</strong>
                    </div>
                    <div class="clearfix m-t-15"></div>
                    <div class="m-t-15">
                        <div class="col-md-1">
                            Price <br/>
                            <strong>₹ 2725</strong>
                        </div>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                Return Detail<br/>
                                Return ID: <br/>12201238467189401525
                                May 22, 2018
                            </div>
                            <div class="col-md-3">
                                Type
                                Customer Return
                                Expect Physical Delivery
                                Replacement
                            </div>
                            <div class="col-md-3">
                                Reason<br/>
                                Missing Item<br/>
                                Buyer Comment <br/>
                            </div>
                            <div class="col-md-3">
                                Tracking Detail<br/>
                                With Customer
                                Approved On: <br/>
                                May 22, 2018<br/>
                                ID:  510436396<br/>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="btn-group btn-group-justified m-b-10">
                    <a href="#productDetails" class="btn btn-custom w-lg" data-animation="sign" data-plugin="custommodal"
                    data-overlaySpeed="100" data-overlayColor="#36404a">
                    View Details
                </a>
                <a class="btn btn-danger waves-effect waves-light" role="button">
                    Contact SS
                </a>
            </div>
            <hr/>
            @endfor
        </div>
    </div>
</div>
</div>
</div>


@endsection

@section('page-scripts')
<script type="text/javascript">
    $('input[name="dates"]').daterangepicker();
</script>
@endsection
