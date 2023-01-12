
<!-- <script src="{{ asset('website/js/jquery.js') }}"></script> -->
<script src="{{ asset('website/js/bootstrap.js') }}"></script>
<script src="{{ asset('website/js/icheck.js') }}"></script>
<script src="{{ asset('website/js/ionrangeslider.js') }}"></script>
<script src="{{ asset('website/js/jqzoom.js') }}"></script>
<script src="{{ asset('website/js/card-payment.js') }}"></script>
<script src="{{ asset('website/js/owl-carousel.js') }}"></script>
<script src="{{ asset('website/js/magnific.js') }}"></script>
<script src="{{ asset('website/js/custom.js') }}"></script>
<script src="{{ asset('website/js/wow.min.js') }}"></script>
<!-- <script src="{{ asset('website/js/script2.js') }}"></script> -->
<script src="{{ asset('website/js/cart_main.js') }}"></script> <!-- Gem jQuery -->

<script>
new WOW().init();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if ("{{old('email')}}") {

}

if ("{{old('email')}}" != "") {
	$('a[href=#nav-login-dialog]').click();
}

if ("{{old('reg_email')}}" != "") {
	$('a[href=#nav-account-dialog]').click();
}

$('document').ready(function() {
    $('.dropdown-menu-category-section').css({'min-height': $('.dropdown-menu').height()});
});

$('[tooltip]').tooltip();

$(".dropdown-large a").each(function() {
    var text = $(this).text();
    text = text.replace("''", "'");
    $(this).text(text);
});

$('.dropdown-large a').append('<b class="caret"></b>');
$('ul.row a b').removeClass('caret');
</script>
<!-- vishal slider -->
<script type="text/javascript">
                     $(document).on('click', ".carousel-button-right", function() {
                         var carusel = $(this).parents('.content');
                        right_carusel(carusel);
                        return false;
                    });

                    $(document).on('click', ".carousel-button-left", function() {
                        var carusel = $(this).parents('.content');
                        left_carusel(carusel);
                        return false;
                    });

                    function left_carusel(carusel) {
                        var block_width = $(carusel).find('.carousel-block').outerWidth();
                        $(carusel).find(".carousel-items .carousel-block").eq(-1).clone().prependTo($(carusel).find(".carousel-items"));
                        $(carusel).find(".carousel-items").css({
                            "left": "-" + block_width + "px"
                        });
                        $(carusel).find(".carousel-items").animate({
                            left: "0px"
                        }, 200);
                        $(carusel).find(".carousel-items .carousel-block").eq(-1).remove();
                    }

                    function right_carusel(carusel) {
                        var block_width = $(carusel).find('.carousel-block').outerWidth();
                        $(carusel).find(".carousel-items").animate({
                            left: "-" + block_width + "px"
                        }, 200);
                        setTimeout(function() {
                            $(carusel).find(".carousel-items .carousel-block").eq(0).clone().appendTo($(carusel).find(".carousel-items"));
                            $(carusel).find(".carousel-items .carousel-block").eq(0).remove();
                            $(carusel).find(".carousel-items").css({
                                "left": "0px"
                            });
                        }, 300);
                    }

                    $(document).ready(function() {
                        var count = $(".carousel-block").length;
                        if (count < 4)
                            $(".carousel-button-left").css({
                                "display": "none"
                            }) && $(".carousel-button-right").css({
                                "display": "none"
                            }) && $(".carousel-block").css({
                                "margin": "0 59px"
                            });

                    });

                    $(function() {});
                     
                </script>



<script type="text/javascript">

    /*
    document.getElementById("body").show = disableScreen;

function disableScreen() {
    // creates <div class="overlay"></div> and 
    // adds it to the DOM
    var div= document.createElement("div");
    div.className += "overlay";
    document.body.appendChild(div);
}
*/
</script>

