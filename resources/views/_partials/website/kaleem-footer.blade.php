        <footer class="main-footer" style="background-color:#84c225">
        <div class="container">
        <div class="row row-col-gap" data-gutter="60">
        <div class="col-md-3 col-sm-3" >
        <h4 class="widget-title-sm text-uppercase">New Categories</h4>
        <ul class="list-unstyled last-menu">
        @foreach($product_categories as $product_category)
        <li>
        <a href="{{route('showCategory', $product_category->name)}}">{{$product_category->name}}</a>
        </li>
        @endforeach
        </ul>
        <!--<ul class="main-footer-social-list list-unstyled">
        <li>
        <a class="fa fa-facebook" href="javascript:;"
        title="facebook">	
        </a>
        </li>
        <li>
        <a class="fa fa-twitter" href="javascript:;"
        title="twitter">	
        </a>
        </li>
        <li>
        <a class="fa fa-pinterest" href="javascript:;"
        title="pinterest">	
        </a>
        </li>
        <li>
        <a class="fa fa-instagram" href="javascript:;"
        title="instagram">	
        </a>
        </li>
        <li>
        <a class="fa fa-google-plus" href="javascript:;"
        title="google">	
        </a>
        </li>
        </ul> -->
        </div>
        <div class="clearfix visible-xs"><br><br></div>


        <!-- <div class="col-md-3 col-sm-3">
        <h4 class="widget-title-sm text-uppercase">Our Products</h4>
        <ul class="main-footer-tag-list text-uppercase">
        {{--  @foreach($popular_tags as $tag)
        <li>
        <a href="javascript:;">{{$tag->name}}</a>
        </li>
        @endforeach --}}
        <li>
        <a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Vegetables">All Vegetables And Fruits</a>
        </li>
        <li>
        <a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Vegetables">Vegetables</a>
        </li>
        <li>
        <a href="http://workfarmtoresto.bigdreams.in/category/Fresh-Fruits">Fruits</a>
        </li>

        </ul>
        </div> -->



 









        <div class="col-md-3 col-sm-3">
        <h4 class="widget-title-sm text-uppercase">Get to know us</h4>
        <ul class="list-unstyled last-menu">
        <li>
        <a href="{{route('about_us')}}">About Us</a>
        </li>
        <li>
        <a href="{{route('contact')}}">Support & Customer Service</a>
        </li>
        <li>
        <a href="{{route('privacy_policy')}}">Privacy Policy</a>
        </li>

        <li>
        <a href="{{ route('terms_condition') }} ">Terms & Conditions</a>
        </li>
        <li>
        <a href="{{ route('disclaimer') }}">Disclaimer</a>
        </li>
        </ul>
        </div>
        <div class="col-md-3 col-sm-3">
        <h4 class="widget-title-sm text-uppercase">Reach out to us</h4>
        <ul class="list-unstyled last-menu">
        <li>
        <a href="mailto:support@farmercart.in">
        <i class="fa fa-envelope-o"></i>&nbsp;&nbsp; support@farmercart.in</a>
        </li>
        <li>
        <a href="tell:"><i class="fa fa-phone"></i>&nbsp;&nbsp; +91 74002 56091</a>
        </li>

        <p class="product-page-side-text">

        </p>

        <br/>
        <ul class="main-footer-social-list list-unstyled">
        <li>
        <!-- <a href="https://www.facebook.com/official.famrtorestro/" target="_blank" class="fa fa-facebook" href="javascript:;"
        title="Facebook">  -->
        <a href="https://facebook.com/farmercartindia" target="_blank"  class="fa fa-facebook" href="javascript:;"
        title="Facebook">   
        </a>
        </li>
        <li>
        <a href="https://www.linkedin.com/company/28738375/admin/"  target="_blank"  class="fa fa-linkedin" href="javascript:;" title="Linkedin" style="background-color: #0e76a8"></a>
        </li>
        <!-- <li>
        <a class="fa fa-pinterest" href="javascript:;" title="Pinterest">  
        </a>
        </li> -->
        <li>
        <a href="https://www.instagram.com/farmercart_india/"  target="_blank"  class="fa fa-instagram" href="javascript:;" title="Instagram">  
        </a>
        </li>
        <li>
        <!-- <a  href="https://twitter.com/FarmtoResto/" class="fa fa-twitter" href="javascript:;"  target="_blank"  title="Twitter"> 
        </a> -->
        </li>
        <li>
       <!--  <a href="https://www.youtube.com/channel/UCTURyMBmP2Nk7-6Vzj713LA?view_as=subscriber" class="fa fa-youtube" href="javascript:;"  target="_blank"  style="background:#FF0000;" title="youtube"> 
        </a> -->
        </li>
      <!--   <li>
        <a class="fa fa-apple" href="javascript:;" title="Download IOS"> 
        </a>
        </li> -->
        </ul> 
        <br>
        <li>
        <!--  <a href="javascript:;"><i class="fa fa-globe"></i>&nbsp; 
        105 Ground Floor, Plot No.95, <br/>
        Mahan Ubhav Chawl TH Kataria Marg,<br/>
        Matunga rd, Mumbai- 400016</a> -->
        </li>
        <br>
        <!--  <li><a ><i class="fa fa-map"> </a></li> -->

        </ul>
        </div>

        <div class="col-md-3 col-sm-3 app-badge">
        <h4  class="widget-title-sm text-uppercase">Download Our App</h4>
<a href="https://play.google.com/store/apps/details?id=io.hizars.farmercart&hl=en_IN"  class="googleicon" target="_blank"><img ng-if="" alt="GooglePlay-BB" data-src="#" class="ng-scope" src="../images/Google-App-store-icon.png"><!-- end ngIf: !vm.VERSIONED_STATIC --> </a>

<a href="https://apps.apple.com/us/app/id1531353969" target="_blank"><img ng-if="!vm.VERSIONED_STATIC" alt="AppStore-BB" data-src=".../images/Apple-App-store-icon.png" class="ng-scope" src="../images/Apple-App-store-icon.png"><!-- end ngIf: !vm.VERSIONED_STATIC --></a>
</div>

        </div>
        </div>
        </footer>
        <div class="copyright-area">
        <div class="container">
        <div class="row">
        <div class="col-md-6">
        <p class="copyright-text">&copy; Farmercart 2019. All Rights Reserved</p>
        </div>
        <div class="col-md-6">
        <p class="copyright-text right">Design and Developed By <a href="http://bigdreams.in/" target="_blank" style="color: #84c225;">Big Dreams</a></p>
        </div>
        <!--<div class="col-md-6">
        <ul class="payment-icons-list">
        <li>
        <img src="{{ asset('website/img/payment/visa-straight-32px.png') }}" alt="Visa" title="Pay with Visa" />
        </li>
        <li>
        <img src="{{ asset('website/img/payment/mastercard-straight-32px.png') }}" alt="Mastercard" title="Pay with Mastercard" />
        </li>
        <li>
        <img src="{{ asset('website/img/payment/paypal-straight-32px.png') }}" alt="Paypal" title="Pay with Paypal" />
        </li>
        <li>
        <img src="{{ asset('website/img/payment/visa-electron-straight-32px.png') }}" alt="Visa-electron" title="Pay with Visa-electron" />
        </li>
        <li>
        <img src="{{ asset('website/img/payment/maestro-straight-32px.png') }}" alt="Maestro" title="Pay with Maestro" />
        </li>
        <li>
        <img src="{{ asset('website/img/payment/discover-straight-32px.png') }}" alt="discover" title="Pay with Discover" />
        </li>
        </ul>
        </div> -->
        </div>
        </div>
        </div>
        </div>


        @push('page-script')

<script type="text/javascript">

    $(document).on('click', '.login-btn', function(){
    let url = $('#url').val();
    let email = $("#loginemail").val();
    let password = $("#loginpassword").val();
    let _token = "{{csrf_token()}}";

    $.ajax({
        url : url,
        method : "POST",
        data : { 'url' : url , 'email' : email , 'password' : password , '_token' : _token },
        dataType : "json",
        succuss : function(response){
            alert("edsfs");
            alert(response.status);
        }
    });


});



  

</script>
        <!-- WhatsHelp.io widget -->

        <!-- <script type="text/javascript">
        (function () {
        var options = {
        whatsapp: "+918928205265", // WhatsApp number
        call_to_action: "Message us", // Call to action
        position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();
        </script> -->
        <!-- /WhatsHelp.io widget -->


        <!--Start of Tawk.to Script-->
        <!-- <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5cc1685fd6e05b735b443580/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script> -->
        <!--End of Tawk.to Script-->
        <!-- End Footer -->
@endpush