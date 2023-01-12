@extends('layouts.master')
@section('styles')
<style media="screen">
mark{background:#188ae2;color:#fff;}
.panel{
    border: initial;
}
.panel-heading {
    padding: 5px;
}
.panel .panel-body {
    padding: 10px;
}
</style>
@endsection
@section('page-content')
<br>
<br>
<div class="row">
    
    <div class="col-sm-12">
         <div class="card-box table-responsive">
        
            <table id="datatable" class="table table-striped table-bordered"> 
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $count=1; $product1=[];  $qty1=[];?>
                    @foreach($orders as $order)
                    @php 
                    $product=explode('","',$order->product_name);
                    $product[0]=explode('["',$product[0])[1];
                    $product[count($product)-1]=explode('"]',$product[count($product)-1])[0];
                    $qty=explode('","',$order->product_qty);
                    $qty[0]=explode('["',$qty[0])[1];
                    $qty[count($qty)-1]=explode('"]',$qty[count($qty)-1])[0];
                    $product1= array_merge($product1,$product);
                    $qty1= array_merge($qty1,$qty);
                    @endphp
                    @endforeach
                    <?php 
                    $unproduct=array_unique($product1);
                    $unqty=[];

                     // dd($product1,$unproduct,$qty1);
                    // foreach ($product1 as $ukey => $uvalue) 
                    // {
                    //     if(isset($unproduct[$ukey]) && $uvalue ==$unproduct[$ukey] ){
                    //      array_push($unqty, $qty1[$ukey]);
                    //     }else{
                    //         // $unqty[$ukey] = 0;
                    //         $unqty[$ukey]=$unqty[$ukey]+$qty1[$ukey];
                    //     }
                     
                    // } 

                      // dd($product1,$unproduct,$qty1);
                    foreach ($unproduct as $ukey => $uvalue) 
                    {
                        foreach ($product1 as $pkey => $pvalue) {
                            if($uvalue==$pvalue)
                            {
                                if($ukey==$pkey)
                                {
                                    array_push($unqty, $qty1[$pkey]);
                                }
                                else
                                {
                                    $unqty[$ukey]=$unqty[$ukey]+$qty1[$pkey];
                                }
                            }
                        }
                    }
                    ?>
                   
                    @foreach($unproduct as $ikey => $order)
                    <tr>
                        <td><?php echo  $count++; ?></td>
                        <td><?php echo stripslashes($order); ?></td>
                        <td><?php echo $unqty[$ikey]; ?></td>
                    </tr>
                    @endforeach
                </tbody>       
            </table>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    let table;
    $(document).ready( function () {
        table =  $('table').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading customers..."
            },
            // "ajax": "{{route('admin.purchaseorder.all')}}", 
            'mark':true,
            "processing": true,
            'dom': 'Bfrltip',
            "pageLength": 1000,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0]
            }],
            'buttons': [
            {
                className: 'btn btn-success',
                title: 'Purchase Order',
                text: 'EXCEL',
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1,2]
                }
            }
            ]
        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    });
</script>
@endsection