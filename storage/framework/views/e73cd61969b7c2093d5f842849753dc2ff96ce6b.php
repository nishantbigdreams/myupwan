<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>My Upavan | Online Plants Nursery</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="#">
    <meta name="author" content="#">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/icons/favicon.png')); ?>">
    <!-- Preload Font -->
    <link rel="preload" href="<?php echo e(asset('newfonts/riode115b.ttf')); ?>" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo e(asset('vendor/fontawesome-free/webfonts/fa-solid-900.woff2')); ?>" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?php echo e(asset('vendor/fontawesome-free/webfonts/fa-brands-400.woff2')); ?>" as="font" type="font/woff2"
        crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/animate/animate.min.css')); ?>">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/magnific-popup/magnific-popup.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/owl-carousel/owl.carousel.min.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/sticky-icon/stickyicon.css')); ?>">

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('newcss/myupavan.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('newcss/custom.css')); ?>">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script>
        WebFontConfig = {
            google: { families: [ 'Jost:300,400,500,600,700', 'Poppins:300,400,500,600,700,800' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = '<?php echo e(asset('newjs/webfont.js')); ?>';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>
</head>