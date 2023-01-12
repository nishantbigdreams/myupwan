<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png')}}">


<title>Admin Dashboard</title>

<!--Morris Chart CSS -->
{{-- <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" > --}}
<!-- Custom box css -->
<link href="{{ asset('plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/dataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/menu.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/script2.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/script2.js') }}"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<style media="screen">
.toast-message{
    color:#fff;
}
.toast{
    background: #36404e;
    opacity: 1;
}
#toast-container{
    margin-top:48px;
}
</style>
@yield('styles')
