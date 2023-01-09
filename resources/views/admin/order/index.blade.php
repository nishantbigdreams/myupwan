@extends('layouts.master')

@section('page-content')
<br/>
<div class="row">
    <div class="card-box">
        <h4 class="m-t-0 m-b-30 header-title">Completed Orders</h4>
        <table class="table table-striped table-bordered no-footer"  id="completed_orders">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order No.</th>
                    <th>Buyer</th>
                    <th>Price</th>
                    <th>Date of Shipping</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i < 10; $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>ON-{{ $i+1 }}</td>
                    <td>John Doe</td>
                    <td> &#8377; 100{{ $i }}</td>
                    <td>0{{ $i+1 }}/01/2018</td>
                    <td>
                        <a href="{{ route('show_orders') }}" class="btn btn-custom">
                            <i class="fa fa-eye"></i> View Details
                        </a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('page-script')
<script type="text/javascript">
    $('#completed_orders').DataTable();
</script>
@endpush
