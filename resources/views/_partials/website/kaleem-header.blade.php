
<meta http-equiv="Content-Type" content="text/html">
<meta http-equiv="encoding" content="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#000000">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="Vishal Varghese">

<meta property="og:image:width" content="100">
<meta property="og:image:height" content="100">
<meta property="og:site_name" content="Farmtercart" />
<meta property="og:description" content="Farmercart"/>

@yield('fb-og')	

<link rel="shortcut icon" href="{{asset('website/img/favicon.png') }}" alt="Farmercart">

{{-- <link rel="preload" as="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400">
<link rel="preload" as="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,600"> --}}
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('website/css/bootstrap.css') }} ">
<link rel="stylesheet" href="{{ asset('website/css/script2.css') }}">

<link rel="stylesheet" href="{{ asset('website/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('website/css/animated.css') }}">
<link rel="stylesheet" href="{{ asset('website/css/styles.css') }}">
<!-- cart css -->
<link rel="stylesheet" href="{{ asset('website/css/reset_cart.css') }}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('website/css/style_cart.css') }}"> <!-- Gem style -->
	<script src="{{ asset('website/js/modernizr_cart.js') }}"></script> <!-- Modernizr -->

<style type="text/css">
.navbar-main-search {
	width: 55%;
}

@media (max-width:992px) {
    .navbar-main-search {
        width: 100%;
        border: none;
        margin: 0;
        padding: 0;
    }
}


</style>



