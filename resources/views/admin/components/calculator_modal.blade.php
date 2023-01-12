<div id="calculator" class="modal fade calculator" tabindex="-1" role="dialog" aria-labelledby="calculator" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="calculator">Calculator</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="#" id="cal_form" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="product" id="product">
                    <input type="hidden" name="type" value="sell_price">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <input type="tel" class="form-control input-sm" id="calc_listing_price" required step="any" placeholder="Listing Price" name="value">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-primary btn-sm btn-bordered btn-block" id="calculator_btn">
                                <i class="fa fa-calculator"></i> CALCULATE
                            </button>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-success btn-sm btn-bordered btn-block">
                                <i class="fa fa-check"></i> UPDATE
                            </button>
                        </div>
                    </div>
                </form>
                <table class="table table-hover" id="calculation_table">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Local</td>
                            <td>Zonal</td>
                            <td>National</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!count($charges))
                            <tr>
                                <td colspan="4">
                                    <center>
                                        Charges are not define yet,
                                        <a href="{{url('admin/calculator')}}">
                                            Set Charges now
                                        </a>
                                    </center>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>Shipping Price</td>
                                <td>{{$charges[0]->shipping_charge ?? ''}}</td>
                                <td>{{$charges[1]->shipping_charge ?? ''}}</td>
                                <td>{{$charges[2]->shipping_charge ?? ''}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Tax</td>
                                <td>{{$charges[0]->shipping_tax ?? ''}}%</td>
                                <td>{{$charges[1]->shipping_tax ?? ''}}%</td>
                                <td>{{$charges[2]->shipping_tax ?? ''}}%</td>
                            </tr>
                            <tr class="text-danger" id="shipping_tr">
                                <td>Shipping Fee</td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[0]->shipping_charge ?? 0,
                                        $charges[0]->shipping_tax ?? 1
                                    )}}
                                </td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[1]->shipping_charge ?? 0,
                                        $charges[1]->shipping_tax ?? 1
                                    )}}
                                </td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[2]->shipping_charge ?? 0,
                                        $charges[2]->shipping_tax ?? 1
                                    )}}
                                </td>
                            </tr>
                            <tr>
                                <td>Collection Price</td>
                                <td>{{$charges[0]->collection_charge ?? ''}}</td>
                                <td>{{$charges[1]->collection_charge ?? ''}}</td>
                                <td>{{$charges[2]->collection_charge ?? ''}}</td>
                            </tr>
                            <tr>
                                <td>Collection Tax</td>
                                <td>{{$charges[0]->collection_tax ?? ''}}%</td>
                                <td>{{$charges[1]->collection_tax ?? ''}}%</td>
                                <td>{{$charges[2]->collection_tax ?? ''}}%</td>
                            </tr>
                            <tr class="text-danger" id="collection_tr">
                                <td>Collection Fee</td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[0]->collection_charge ?? 0,
                                        $charges[0]->collection_tax ?? 1
                                    )}}
                                </td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[1]->collection_charge ?? 0,
                                        $charges[1]->collection_tax ?? 1
                                    )}}
                                </td>
                                <td>
                                    {{calculatorCharge(
                                        $charges[2]->collection_charge ?? 0,
                                        $charges[2]->collection_tax ?? 1
                                    )}}
                                </td>
                            </tr>
                            <tr id="settlement_tr">
                                <td>Settlement</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">
                    CLOSE
                </button>
            </div>
        </div>
    </div>
</div>

@push('page-script')
    <script type="text/javascript">

    $price_input = $('#calc_listing_price');
    $table = $('#calculation_table>tbody');
    $shipping_row = $table.find('#shipping_tr');
    $collection_row = $table.find('#collection_tr');
    $settlement_row = $table.find('#settlement_tr');

    $(function(){
        $(document).on('click', 'a.calculator', function(){
            $price_input.val($(this).data('price'));
            $('#product').val($(this).attr('id'));
            $('#cal_form').attr('action','/admin/update/product/'+$(this).attr('id'));
            calculateCharges();
        });

        let calculateCharges = () => {
            let price = parseFloat($price_input.val()).toFixed(2);
            if (price < 0) {
                return;
            }

            $settlement_row.find(':nth-child(2)').html(set_price(price, 2));
            $settlement_row.find(':nth-child(3)').html(set_price(price, 3));
            $settlement_row.find(':nth-child(4)').html(set_price(price, 4));

        }

        function set_price(price, index)
        {
            let ship_charge = 0, coll_charge = 0;
            ship_charge = parseFloat($shipping_row.find(':nth-child('+index+')').html());
            coll_charge = parseFloat($collection_row.find(':nth-child('+index+')').html());
            console.log(ship_charge+', '+coll_charge);
            return price - ship_charge - coll_charge;
        }

        $('#calculator_btn').click(calculateCharges);
        $price_input.change(calculateCharges);

    });
    </script>
@endpush
