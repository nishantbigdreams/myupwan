"use strict";$(".i-check, .i-radio").iCheck({checkboxClass:"i-check",radioClass:"i-radio"}),$("#price-slider").ionRangeSlider({min:130,max:575,type:"double",prefix:"₹",prettify:!1,hasGrid:!1}),$("#jqzoom").jqzoom({zoomType:"standard",lens:!0,preloadImages:!1,alwaysOn:!1,zoomWidth:460,zoomHeight:460,yOffset:0,position:"left"}),$(".form-group-cc-number input").payment("formatCardNumber"),$(".form-group-cc-date input").payment("formatCardExpiry"),$(".form-group-cc-cvc input").payment("formatCardCVC"),$("#create-account-checkbox").on("ifChecked",function(){$("#create-account").removeClass("hide")}),$("#create-account-checkbox").on("ifUnchecked",function(){$("#create-account").addClass("hide")}),$("#shipping-address-checkbox").on("ifChecked",function(){$("#shipping-address").removeClass("hide")}),$("#shipping-address-checkbox").on("ifUnchecked",function(){$("#shipping-address").addClass("hide")}),$(".owl-carousel").each(function(){$(this).owlCarousel()}),$("#popup-gallery").each(function(){$(this).magnificPopup({delegate:"a.popup-gallery-image",type:"image",gallery:{enabled:!0}})}),$(".popup-image").magnificPopup({type:"image"}),$(".popup-text").magnificPopup({removalDelay:500,closeBtnInside:!0,callbacks:{beforeOpen:function(){this.st.mainClass=this.st.el.attr("data-effect")}},midClick:!0}),$(".product-page-qty-plus").on("click",function(){var e=parseInt($(this).prev(".product-page-qty-input").val(),10);e&&""!=e&&"NaN"!=e||(e=0),$(this).prev(".product-page-qty-input").val(e+1)}),$(".product-page-qty-minus").on("click",function(){var e=parseInt($(this).next(".product-page-qty-input").val(),10);"NaN"==e&&(e=1),e>1&&$(this).next(".product-page-qty-input").val(e-1)});