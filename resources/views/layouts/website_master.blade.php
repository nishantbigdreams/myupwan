<!DOCTYPE html>
<html lang="en">
<head>
	<?php
use Illuminate\Support\Facades\Auth;
	 
	?>
 
	@yield('title')

	@yield('sco')
	<!-- Google Tag Manager -->
@include('_partials.website.header')
@yield('page-style')
@yield('fb-pixel-code')
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TKX8TT8');</script>
	<!-- End Google Tag Manager -->

	<!-- Global site tag (gtag.js) - Google Ads: 778368805 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-778368805"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'AW-778368805');
	</script>


</head>


<body class="mybody">
	<?php 

	?>
	    <!-- Google Tag Manager (noscript) -->
	    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKX8TT8"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@guest
		@include('_partials.website.modal')
		@endguest
{{--		@include('_partials.website.sidebar')
		@include('_partials.website.navbar')--}}
		
		@yield('body_content')
		
		@include('_partials.website.footer')
		@yield('new-modal')
		@include('_partials.website.scripts')
		@stack('page-script')
		
<script>
	 function open_login(){

        $.magnificPopup.open({
          items: {
            src: '#nav-login-dialog'
          },
          type: 'inline'
        });

        }
var input = document.getElementById("search");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
  	//console.log(input);
   event.preventDefault();
   window.location.replace('/search/'+input.value);
  }
});
var input1 = document.getElementById("search1");
input1.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   window.location.replace('/search/'+input1.value);
  }
});
</script>
	</body>
	</html>
