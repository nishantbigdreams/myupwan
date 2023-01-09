<div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-login-dialog">
    <h3 class="widget-title">User Login</h3>
    <p style="font-size: 15px;">Welcome back.</p>
    <hr />
    <?php 

    // if(\Request::is('cart')){
    if(\Cart::count() > 0){
        $actionRoute = "checkoutpostLogin";
    }else{
        $actionRoute = "postLogin"; 
    }

    ?>
    <form method="POST" action="{{ route($actionRoute) }}" id="loginform">
        {{ csrf_field() }}
        <input type="hidden" name="url" id="url" value="{{$actionRoute}}">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" id="loginemail" value="{{old('email')}}" required placeholder="example@example.com" />
            @if ($errors->has('email'))
            <span class="text-danger">
                {{ $errors->first('email') }}
            </span>
            @endif
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" id="loginpassword" required placeholder="******" />
            @if ($errors->has('password text-danger'))
            <span class="text-danger">
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>
        <div class="checkbox">
            <label>
                <input class="i-check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />Remember Me
            </label>
        </div>
        <!-- ajax call -->
        <!-- <input class="btn btn-primary btn-block login-btn" type="button" value="Sign In" /> -->

        <!-- normal action -->
        <input class="btn btn-primary btn-block " type="submit" value="Sign In" />

       
      <!--   <div class="text-center">  <label>or</label><br>
            <small><a href="https://farmtoresto.com/password/reset" class="btn btn-link">Forgot Password?</a></small> 
        </div> -->
    </form>

    <hr>
    Login with Phone
    <form method="post" action="{{route('login.with.otp')}}" id="otp_login_form">
        {{csrf_field()}}
        <input class="form-control" type="tel" name="phone" value="{{old('phone')}}" required placeholder="98xxxxxxxx" minlength="10" pattern="[789][0-9]{9}">

       OTP Code
        <input class="form-control" type="text" name="otp" placeholder="xxxx" />
        <br>
        <button class="btn btn-primary btn-block">
            Send OTP
        </button>
        <center class="error text-info">

        </center>
    </form>

    <div class="gap gap-small"></div>
    <ul class="list-inline text-center">
        <li>
            <a href="#nav-account-dialog" class="popup-text" style="color: #84c225!important;">Not Member Yet</a>
        </li>
        <li>
            
        </li>
    </ul>
</div>



<div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-account-dialog">

     <div class="alert alert-danger" style="display:none"></div>
     <div class="alert alert-success" style="display:none">Registraion Successfully Done.Please Login Now.</div>

    <h3 class="widget-title">Create Account</h3>
    <p style="font-size: 15px;">Ready to get best offers? Let's get started!</p>
    <hr />
    <form method="post"  id="form_create_account">
        {{ csrf_field() }}

        <div class="form-group {{$errors->has('name')? 'has-error':''}}">
            <label>Name</label>
            <input class="form-control" type="text" required name="name" value="{{old('name')}}" placeholder="Jane Doe" />
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-group {{$errors->has('reg_email')? 'has-error':''}}">
            <label>E-mail</label>
            <input class="form-control" type="email" required name="reg_email" value="{{old('reg_email')}}" placeholder="jane@example.com" />
            
            <span class="text-danger hidden"></span>
            
        </div>
        <div class="form-group {{$errors->has('phone')? 'has-error':''}}">
            <label>Phone Number</label>
            <input class="form-control" type="tel" required name="phone" value="{{old('phone')}}" placeholder="98xxxxxxxx"/>
            @if($errors->has('phone'))
            <span class="text-danger">{{$errors->first('phone')}}</span>
            @endif
        </div>
        <div class="form-group {{$errors->has('req_password')? 'has-error':''}}" >
            <label>Password</label>
            <input class="form-control" type="password" required name="req_password" placeholder="******" />
            @if($errors->has('req_password'))
            <span class="text-danger">{{$errors->first('req_password')}}</span>
            @endif
        </div>
        {{-- <div class="checkbox">
            <label>
                <input class="i-check" {{old('newsletter') ? 'checked' : ''}} type="checkbox" name="newsletter" value="yes" />Sign Up to the Newsletter
            </label>
        </div> --}}
        <input class="btn btn-primary btn-sm btn-block" type="submit" id="create_account" value="Create Account" />
    </form>
    <div class="gap gap-small"></div>
    <ul class="list-inline text-center">
        <li>
            <a href="#nav-login-dialog" class="popup-text" style="color: #84c225!important;">Already Member</a>
        </li>
    </ul>
</div>

<!-- cart login checkout -->
<div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-login-dialog-checkout">


    <h3 class="widget-title">User Login</h3>
    <p style="font-size: 15px;">Welcome back.</p>
    <hr />
    <?php 
        $actionRoute = "checkoutpostLogin";
    ?>
    <form method="POST" action="{{ route($actionRoute) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="{{old('email')}}" required placeholder="example@example.com" />
            @if ($errors->has('email'))
            <span class="text-danger">
                {{ $errors->first('email') }}
            </span>
            @endif
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" required placeholder="******" />
            @if ($errors->has('password text-danger'))
            <span class="text-danger">
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>
        <div class="checkbox">
            <label> 
                <input class="i-check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />Remember Me
            </label>

            <!-- <label>
                <input class="i-check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} /> Forgot Your Password?
            </label> -->

        </div>
        <input class="btn btn-primary btn-block" type="submit" value="Sign In" />
    </form>

    <hr>
    Login with Phone
    <form method="post" action="{{route('login.with.otp')}}" id="otp_login_form">
        {{csrf_field()}}
        <input class="form-control" type="tel" name="phone" value="{{old('phone')}}" required placeholder="98xxxxxxxx" minlength="10" pattern="[789][0-9]{9}">

        <label>OTP Code</label>
        <input class="form-control" type="text" name="otp" placeholder="xxxx" />
        <br>
        <button class="btn btn-primary btn-block">
            Send OTP
        </button>
        <center class="error text-info">

        </center>
    </form>

    <div class="gap gap-small"></div>
    <ul class="list-inline text-center">
        <li>
            <a href="#nav-account-dialog" class="popup-text" style="color: #84c225!important;">Not Member Yet</a>
        </li>
        <li>
             <a href="#nav-pwd-dialog" class="popup-text">Forgot Password?</a> 
             <!-- <a href="https://farmtoresto.com/password/reset" class="btn btn-link">
                                    Forgot Your Password?
            </a> -->
        </li>
    </ul>
</div>


<div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-pwd-dialog">
    <h3 class="widget-title">Password Recovery</h3>
    <hr />
    <form method="post" route="/" id="password_forgot_form">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Registered Phone Number</label>
            <input class="form-control" type="tel" name="phone" minlength="10" maxlength="12" placeholder="98xxxxxxxx" required />
        </div>
        <div id="reset_div" style="display:none">
            <div class="form-group">
                <label>Verification Code sent to above Phone Number</label>
                <input class="form-control" type="tel" name="otp" minlength="4" maxlength="6" placeholder="Enter Otp" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" id="forgot_password" name="password" minlength="6" placeholder="New Password" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" id="confirm_reset_password" name="confirm_password" minlength="6" placeholder="98xxxxxxxx" required />
            </div>
        </div>
        <button class="btn btn-primary" id="reset_password">
            <i class="fa fa-refresh"></i> Recover Password
        </button>
    </form>
</div>

<!-- Modal -->
  <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel2">My Cart</h4>
        </div>

        <div class="modal-body">
          <div class="row">
                

             <div class="sc-krvtoX hGwJR"><div class="ui container grid sc-lkqHmb hYdzbi"><div class="center aligned middle aligned four wide column sc-cbkKFq sc-fYiAbW fqTVxF"><img src="https://img.frubana.com/products/Ají-Topito-1560471650402.png" class="ui small image sc-cJSrbW dLwzxs"></div><div class="stretched top aligned eleven wide column sc-cbkKFq sc-gHboQg kHwTbG"><div class="ui grid sc-eLExRp dVTPQV"><div class="eleven wide computer sixteen wide mobile eleven wide tablet column"><div class="sc-eilVRo hnhuua">Ají Topito Estándar</div></div><div class="five wide computer sixteen wide mobile five wide tablet column"><div class="sc-eerKOB bXzVtO"><span>$ 2.010</span></div></div><div class="sixteen wide column sc-cbkKFq sc-fOKMvo kARfEb"><div class="input-disabled">0.60</div><div class="sc-eilVRo dXXmKp">KG - Estándar</div></div><div class="sixteen wide column"><i aria-hidden="true" class="edit outline icon sc-emmjRN gmvNKv"><span>Editar</span></i><i aria-hidden="true" class="trash alternate outline icon sc-emmjRN gmvNKv"><span>Eliminar</span></i></div></div></div></div></div>
          </div>
        </div>

      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->


  



@push('page-script')

<script type="text/javascript">


    $password = $('#forgot_password'); 
    $confirm_password = $('#confirm_reset_password');
    $otp = $('input[name=otp]');

    let validatePassword = () => {
        if ($password.val().length < 6) {
            $password.closest('.form-group').addClass('has-error');
            $password.css({'background-color':'rgba(169,68,66,.2)'});
            return false;
        } else {
            $password.closest('.form-group').removeClass('has-error').addClass('has-success');
            $password.css({'background-color':'rgba(60,118,61,.2)'});
        }

        if ($confirm_password.val() != $password.val()) {
            $confirm_password.closest('.form-group').addClass('has-error');
            $confirm_password.css({'background-color':'rgba(169,68,66,.2)'});
            return false;
        }else {
            $confirm_password.closest('.form-group').removeClass('has-error').addClass('has-success');
            $confirm_password.css({'background-color':'rgba(60,118,61,.2)'});
        }

        if ($otp.val().length >= 4) {
            return true;
        }
        return false;
    }

    $('#reset_password').click(function(e){
        e.preventDefault();
        if (validatePassword()) {
            $('#reset_password').find('i').addClass('fa-spin');
        }else{
            $('#reset_div').show();
        }

    });

    $password.keyup(validatePassword);
    $confirm_password.keyup(validatePassword);

    $('#password_forgot_form').submit(function(e){
        e.preventDefault();
    })

</script>

<script type="text/javascript">

//otp login
$loginForm = $('#otp_login_form');
$error = $loginForm.find('.error');
$submitBtn = $loginForm.find('button');
let _status = false;
$loginForm.submit(function(e){
    e.preventDefault();
    $error.html("");
    if (!_status) {
        sendLoginOtp();
    } else {
        verifyLoginOtp();
    }
});

let verifyLoginOtp = () => {
    $submitBtn.html(`
        <i class="fa fa-spinner fa-spin"></i> Verifying...
        `);

    $.ajax({
        url: $loginForm.attr('action'),
        method: 'POST',
        data: $loginForm.serialize(),
    }).done(function(response, textStatus, jqXHR) {

        if (response.status) {
            location.reload();
        } else {
            $error.html(response.message);
            $submitBtn.html('Verify & Login');
        }
    })
    .error(function(request, textStatus, errorThrown){
        let retry_after = request.getResponseHeader('retry-after');
        $error.html('<span class="text-danger">Too Many attempt, please try again after <strong>'+retry_after+'</strong> sec(s).</span>');
        resetForm();
    });
}

let sendLoginOtp = () => {
    $submitBtn.html(`
        <i class="fa fa-spinner fa-spin"></i> Sending...
        `);
    $.ajax({
        url: '{{route("send.login.otp")}}',
        method: 'POST',
        data: {phone:$loginForm.find('input[type=tel]').val()},
    }).done(function(response, textStatus, jqXHR) {
        if (response.status) {
            _status = true;
            $submitBtn.html('Verify & Login');
            $loginForm.find('input[name=otp]').attr('required','required');
        } else {
            resetForm();
        }
        $error.html(response.message);
    })
    .error(function(request, textStatus, errorThrown){
        let retry_after = request.getResponseHeader('retry-after');
        $error.html('<span class="text-danger">Too Many attempt, please try again after <strong>'+retry_after+'</strong> sec(s).</span>');
        resetForm();
    });    
}

let resetForm = () => {
    $loginForm.trigger('reset');
    $submitBtn.html('Sent Otp');
    $loginForm.find('input[name=otp]').removeAttr('required');
}
</script>
<script type="text/javascript">
    $('#create_account').on('click',function(e){
        e.preventDefault();
        var form_data = new FormData(document.getElementById("form_create_account"));
        // alert(form_data);
          $.ajax({
          url:"{{ route('register') }}",
          method:"POST",
          data:form_data,
          contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
             success:function(data){
              console.log(data);
              // console.log(data.errors);

                 if(data.success)
                {
                    // console.log(data.success);
                    $('.alert-success').show();

                    var url1=window.location.href;
                  window.location.replace(url1);  
                   // window.location.replace("{{route('home')}}");
                    /*window.location.reload();*/
                }
                
                 $(".alert-danger").empty();
                $.each(data.errors, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>'+value+'</p>');
                        });
             }

               });
      });

</script>



@endpush
