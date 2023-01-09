@extends('layouts.master')
<br>
<br>
<br>
@section('page-content')
<br>

<div class="container">
    <div class="col-md-4">
        <div class="row">
            <div class="card-box">
                <h4 class="header-title m-t-0">Daily Sales</h4>
                <div class="col-md-12">
                    <div class="card-box tilebox-two tilebox-success">
                        <i class="fa fa-shopping-bag pull-right text-dark"></i>
                        <h6 class="text-success text-uppercase m-b-15 m-t-10">New Orders</h6>
                        <h2 class="m-b-10" data-plugin="counterup">
                            {{number_format($data['new_order'])}}
                        </h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card-box tilebox-two tilebox-primary">
                        <i class="mdi mdi-currency-inr pull-right text-dark"></i>
                        <h6 class="text-primary text-uppercase m-b-15 m-t-10">Today's Sale</h6>
                        <h2 class="m-b-10" data-plugin="counterup">
                            {{number_format($data['todays_sale'])}}
                        </h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card-box tilebox-two tilebox-pink">
                        <i class="mdi mdi-currency-inr pull-right text-dark"></i>
                        <h6 class="text-pink text-uppercase m-b-15 m-t-10">This month Sales</h6>
                        <h2 class="m-b-10" data-plugin="counterup">
                            {{number_format($data['month_sale'])}}
                        </h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card-box tilebox-two tilebox-info">
                        <i class="mdi mdi-account-multiple pull-right text-dark"></i>
                        <h6 class="text-info text-uppercase m-b-15 m-t-10">Registered Users</h6>
                        <h2 class="m-b-10" data-plugin="counterup">
                            {{number_format($data['user_count'])}}
                        </h2>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="demo-box">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#sales_graph_tab">SALES</a></li>
                <!--<li><a data-toggle="tab" href="#unit_graph_tab">UNITS</a></li>-->
            </ul>

            <div class="tab-content">
                <div id="sales_graph_tab" class="tab-pane fade in active">
                    <div id="sales_graph" style="height: 300px;">
                    </div>
                </div>
                <div id="unit_graph_tab" class="tab-pane fade">
                    <div id="unit_graph" style="height: 300px;" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-scripts')
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<script type="text/javascript">

    let sales_chart = new Morris.Line({
        element: 'sales_graph',
        data: JSON.parse('<?php echo json_encode($sales_graph_data);?>'),
        xkey: 'month',
        resize: true,
        parseTime: false,
        ykeys: ['value'],
        labels: ['&#8377;'],
        lineColors: ['#188ae2']
    });
    let unit_chart = new Morris.Line({
        element: 'unit_graph',
        resize: true,
        data: JSON.parse('<?php echo json_encode($unit_graph_data);?>'),
        xkey: 'month',
        parseTime: false,
        ykeys: ['value'],
        labels: ['Units'],
        lineColors: ['#f06292']
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr("href")
        switch (target) {
            case "#sales_graph_tab":
                sales_chart.redraw();
                $(window).trigger('resize');
                break;
            case "#unit_graph_tab":
                unit_chart.redraw();
                $(window).trigger('resize');
                break;
        }
    });
</script>

@endsection
