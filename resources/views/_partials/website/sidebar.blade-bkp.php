<?php
$parentCategories = DB::table('parent_categories')->get();
?>

<style type="text/css">
  /* Menu Styles */
  .menu-dropdown li .icon:hover{
    color: #000;
  }
  .primary-nav {
    position: fixed;
    z-index: 999;
  }

  .menu {
    position: relative;
  }

  .menu ul {
    margin: 0;
    /*padding: 0;*/
    padding: 0px 10px;
    list-style: none;
  }

  .open-panel {
    border: none;
    background-color:#fff;
    padding: 0;
  }

  .hamburger {
    /*background: #84c225;*/
    position: relative;
    display: block;
    text-align: center;
    padding: 3px 0;
    width: 50px;
    height: 44px;
    left: 0;
    top: 0;
    z-index: 1000;
    cursor: pointer;
  }

  .hamburger:before {
    content:"\2630"; /* hamburger icon */
    display: block;
    color: #000;
    line-height: 32px;
    font-size: 20px;
  }

  .openNav .hamburger:before {
    content:"\2715"; /* close icon */
    display: block;
    color: #000;
    line-height: 32px;
    font-size: 20px;
  }

  .hamburger:hover:before {
    color: #000;
  }

  .primary-nav .menu li {
    position: relative;
  }

  .menu .icon {
    position: absolute;
    top: 12px;
    right: 10px;
    pointer-events: none;
    width: 24px;
    height: 24px;
    color: #fff;
    font-size: 13px;
  }

  .menu,
  .menu a,
  .menu a:visited {
    color: #000;
    text-decoration: none!important;
    position: relative;
  }

  .menu a {
    display: block;
    white-space: nowrap;
    padding: 0.5em;
    font-size: 14px;
  }

  .menu a:hover {
    color: #84C225;
  }

  .menu {
    margin-bottom: 3em;
    background-color: #fff;
  }

  .menu-dropdown li .icon {
    color: #000;
  }

  .menu-dropdown li:hover .icon {
    color: #3ab54a;
  }

  .menu label {
    margin-bottom: 0;
    display: block;
  }

  .menu label:hover {
    cursor: pointer;
  }

  .menu input[type="checkbox"] {
    display: none;
  }

  input#menu[type="checkbox"] {
    display: none;
  }

  .sub-menu-dropdown {
    display: none;
  }

  .new-wrapper {
    position: absolute;
    left: 50px;
    width: calc(100% - 50px);
    transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
  }

  #menu:checked + ul.menu-dropdown {

    left: 0;
    -webkit-animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
    animation: all .45s cubic-bezier(0.77, 0, 0.175, 1);
  }

  .sub-menu-checkbox:checked + ul.sub-menu-dropdown {
    display: block!important;
    -webkit-animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
    animation: grow .45s cubic-bezier(0.77, 0, 0.175, 1);
  }

  .openNav .new-wrapper {
    position: absolute;
    transform: translate3d(200px, 0, 0);
    width: calc(100% - 250px);
    transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
  }

  .downarrow {
    background: transparent;
    position: absolute;
    /*right: 50px;*/
    right: 2px;
    top: 12px;
    color: #000;
    width: 24px;
    height: 24px;
    text-align: center;
    display: block;
  }

  .downarrow:hover {
    color: #fff;
  }

  .menu {
    position: absolute;
    display: block;
    left: -200px;
    top: 0;
    width: 290px;
    transition: all 0.45s cubic-bezier(0.77, 0, 0.175, 1);
    background-color: #000;
    /*z-index: 999;*/
    z-index: 1;
  }

  .menu-dropdown {
    top: 0;
    /*overflow-y: auto;*/
  }

  .overflow-container {
    position: relative;
    height: calc(106vh - 0px)!important;
    /*overflow-y: auto;*/
    /*  border-top: 73px solid #fff;*/
    z-index: -1;
    display:block;
    background-color: #fff;
    padding-top: 80px;
    box-shadow: 0px 0px 10px 0px #989696;
  }

  .overflow-container ul li a:hover {
    color: #84c225;
    background-color:#efefef!important;
  }

  .menu-hide{
    display: none;
  }

  .menu a.logotype {
    position: absolute!important;
/*top: 11px;
left: 55px;*/
left: 75px;
display: block;
font-family: 'Work Sans', sans-serif;
text-transform: uppercase;
font-weight: 800;
color: #000;
font-size: 21px;
padding: 10px;
}

.menu a:hover{
  color: #84C225;
}

.menu a.logotype span {
  font-weight: 400;
}

.menu a.logotype:hover {
  color: #777;
}

.sub-menu-dropdown {
  background-color: #333;
}

.menu:hover {
/*  position: absolute;
left: 0;
top: 0;*/
}

.openNav .menu:hover {
  position: absolute;
  left: -200px;
  top 73px;
}

.openNav .menu {
  top 73px;
  transform: translate3d(200px, 0, 0);
  transition: transform .45s cubic-bezier(0.77, 0, 0.175, 1);
}

/* label.hamburger {display: none;} */

/* look and feel only, not needed for core menu*/

@-webkit-keyframes grow {

  0% {
    display: none;
    opacity: 0;
  }
  50% {
    display: block;
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }

}

@keyframes grow {

  0% {
    display: none;
    opacity: 0;
  }
  50% {
    display: block;
    opacity: 0.5;
  }
  100% {
    opacity: 1
  }

}

/* Text meant only for screen readers. */

.screen-reader-text {
  clip: rect(1px, 1px, 1px, 1px);
  position: absolute !important;
  height: 1px;
  width: 1px;
  overflow: hidden;
}

.screen-reader-text:focus {
  background-color: #f1f1f1;
  border-radius: 3px;
  -webkit-box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
  box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
  clip: auto !important;
  color: #21759b;
  display: block;
  font-size: 14px;
  font-size: 0.875rem;
  font-weight: bold;
  height: auto;
  left: 5px;
  line-height: normal;
  padding: 15px 23px 14px;
  text-decoration: none;
  top: 5px;
  width: auto;
  z-index: 100000;
  /* Above WP toolbar. */
}

/* Resposive Typography */

body,
button,
input,
select,
optgroup,
textarea {
  color: #000;
  font-size: 15px;
  line-height: 1.5;
  font-weight: 300;

}

h1, h2, h3, h4, h5, h6 {
  clear: both;
  font-weight: 800;
}

dfn, cite, em, i {
  font-style: italic;
}

blockquote {
  margin: 0 1.5em;
}

address {
  margin: 0 0 1.5em;
}

pre {
  background: #eee;
  font-family: "Courier 10 Pitch", Courier, monospace;
  font-size: 15px;
  font-size: 0.9375rem;
  line-height: 1.6;
  margin-bottom: 1.6em;
  max-width: 100%;
  overflow: auto;
  padding: 1.6em;
}

code, kbd, tt, var {
  font-family: Monaco, Consolas, "Andale Mono", "DejaVu Sans Mono", monospace;
  font-size: 15px;
  font-size: 0.9375rem;
}

abbr, acronym {
  border-bottom: 1px dotted #666;
  cursor: help;
}

mark, ins {
  background: #fff9c0;
  text-decoration: none;
}

big {
  font-size: 125%;
}

.light {
  color:#ddd;
}

strong {
  font-weight: 600;
}

cite,
em,
i {
  font-style: italic;
}

p.big {
  font-size: 140%;
  line-height: 1.3em;
}

p.small {
  font-size: 80%;
}

blockquote {
  display:block;
  margin: 1em 20px;
  padding: 0 1em;
  position:relative;
}

blockquote:before {

}

blockquote cite,
blockquote em,
blockquote i {
  font-style: italic;
}

abbr,
acronym {
  border-bottom: 1px dotted #666;
  cursor: help;
}

sup,
sub {
  height: 0;
  line-height: 1;
  vertical-align: baseline;
  position: relative;
}

sup {
  bottom: 1ex;
}

sub {
  top: .5ex;
}


p {
  font-size: 1em;
  margin: 0 0 2em 0;
}

article:last-of-type, p:last-of-type {
  margin-bottom: 0;
}

p.intro {
  font-size:1.25em;
  line-height: 1.5;
  font-weight:300;
  margin: 0 0 1.5em 0;
}

h1, h2 {
  letter-spacing: -1px;
}

h1, .h1, h2, .h2, h3, .h3, h4, .h4 {
  margin: 0 0 0.5em 0;
  line-height: 1.1;
}

h1, .h1 {font-size: 2.074em;}

h2, .h2 {font-size: 1.728em;}

h3, .h3 {font-size: 1.44em;}

h4, .h4 {font-size: 1.2em;}

/* Medium Screen Typography - Scale: 1.333 Perfect Fourth (thanks http://type-scale.com/)  */

@media screen and (min-width: 42em) {

  h1, .h1 { letter-spacing: -2px; }

  h1, .h1 {font-size: 3.157em;}

  h2, .h2 {font-size: 2.369em;}

  h3, .h3 {font-size: 1.777em;}

  h4, .h4 {font-size: 1.333em;}

  p { font-size:1.0625em; }

  p.intro { font-size:1.3em; }
}

/* Large Screen Typography  - Scale: 1.414 Augmented Fourth (thanks http://type-scale.com/)  */

@media screen and (min-width: 72em) {

  h1 { letter-spacing: -3px; }

  h1, .h1 { margin-bottom: 0.35em; font-size: 3.998em; }

  h2, .h2  { font-size: 2.827em; }

  h3, .h3 { font-size: 1.999em; }

  h4, .h4 { font-size: 1.414em; }

  p { font-size:1.125em; }

  p.intro { font-size:1.4em; }
}
</style>

<style type="text/css">
  .nav1{
    height:6rem;
    display: flex;
    justify-content:space-between;
    align-items:center;
    padding:0 2rem;
    position:absolute;
    width:100%;
    background: #9aa739;
    /*transition:all .4s ease-in-out;*/
    z-index:10;
    &__logo{
      font-size:2rem;
      color:#fff;
      display:flex;
      cursor:pointer;
      .name{
        font-size:1.7rem;
        margin-left:.4rem;
      }
    }
    &__list{
      display:flex;
      list-style-type:none;
    }
    &__item{
      &:not(:last-child){
        margin-right:1.2rem;
      }
    }

    &__link{
      font-size:1.4rem;
      text-decoration:none;
      color:#fff;
      padding:1.5rem 0rem;
      display:inline-block;
      position:relative;
      font-weight:300;

      &::before{
        content:'';
        position:absolute;
        bottom:0;
        left:0;
        width:0;
        height:.3rem;
        background:$link;
        transition:all .3s ease-in-out;
      }
      &:hover{
        color:$link;
        &::before{
          width:100%;
        }
      }
    }
  }

  .lighten{
    background:#fff !important;
    transition:all .4s ease-in-out;
    position:fixed;
    animation:slide-down .5s;
    .nav__logo{
      color:$link !important;
    }
    .nav__link{
      color:#1a1a1a !important;
    }
  }
</style>
<style type="text/css">
  .active-pink-4 input[type=text]:focus:not([readonly]) {
    border: 1px solid #f48fb1;
    box-shadow: 0 0 0 1px #f48fb1;
  }
  .active-pink-3 input[type=text] {
    border: 1px solid #f48fb1;
    box-shadow: 0 0 0 1px #f48fb1;
  }
  .active-purple-4 input[type=text]:focus:not([readonly]) {
    border: 1px solid #ce93d8;
    box-shadow: 0 0 0 1px #ce93d8;
  }
  .active-purple-3 input[type=text] {
    border: 1px solid #ce93d8;
    box-shadow: 0 0 0 1px #ce93d8;
  }
  .active-cyan-4 input[type=text]:focus:not([readonly]) {
    border: 1px solid #4dd0e1;
    box-shadow: 0 0 0 1px #4dd0e1;
  }
  .active-cyan-3 input[type=text] {
    border: 1px solid #4dd0e1;
    box-shadow: 0 0 0 1px #4dd0e1;
  }

  .overflow-container ul li a:hover
  {
    color:#3ab54a;
  }

  .contact100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    min-width: 160px;
    height: 50px;
    background-color: #84c225;
    border-radius: 6px;
    font-family: Poppins-Regular;
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }

  .contact100-form-btn: hover{
    background-color: 
  }
  .contact100-form-btn:hover {
    background-color: #d4d4d4;
  }

  .footerbtn{
    margin-left: 27px;
  }
</style>

<div class="primary-nav">

  <button href="#" class="hamburger open-panel nav-toggle">
    <span class="screen-reader-text">Menu</span>
  </button>

  <nav role="navigation" class="menu">
    <a href="" class="logotype"><img src="http://farmtoresto.com/website/img/logo.png" style="width: 80%;"></a>
    <div class="overflow-container" id="menu-hide">

<!-- <ul class="menu-dropdown">
@isset($parentCategories) 
@foreach($parentCategories as $parentkey=>$parentcat)
<?php
$categories = DB::table('categories')->where('parent_category_id', $parentcat->id)->get();
?>
<li class="menu-hasdropdown">
<a href="#"><img src="http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables-and-fruits.png" class="navIcon" alt="" title="">{{$parentcat->name}}</a>
<label title="toggle menu" for="settings-{{$parentkey}}">
@if(count($categories))
<span class="downarrow"><i class="fa fa-caret-down" style="color: #000;font-size: 14px;"></i></span>
@endif
</label>
<input type="checkbox" class="sub-menu-checkbox" id="settings-{{$parentkey}}" />

@isset($categories) 
<ul class="sub-menu-dropdown" style="background-color: #fff;">

@foreach($categories as $catkey=>$catetory)
<li><a href="{{url('category' ,$catetory->name )}}">{{$catetory->name}}</a></li>

@endforeach
</ul>
@endisset

</li>

@endforeach
@endisset
</ul> -->



<!--       
<div class="dropdown">
<button class="dropbtn">
<img src="http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables-and-fruits.png" class="navIcon" /> Vegetables</button>
<div class="dropdown-content">
<a href="http://workfarmtoresto.bigdreams.in/category/Fresh%20Vegetables">Fresh Vegetables</a>
<a href="http://workfarmtoresto.bigdreams.in/category/Herbs%20And%20Seasonings">Herbs And Seasonings</a>
<a href="http://workfarmtoresto.bigdreams.in/category/Organic%20Vegitables">Organic Vegitables</a>
</div>
</div>

<div class="clearfix"></div>
<div class="dropdown">
<button class="dropbtn">
<img src="http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables-and-fruits.png" class="navIcon" /> Fruit</button>
<div class="dropdown-content">
<a href="http://workfarmtoresto.bigdreams.in/category/Fresh%20Vegetables">Fresh Vegetables</a>
<a href="http://workfarmtoresto.bigdreams.in/category/Herbs%20And%20Seasonings">Herbs And Seasonings</a>
<a href="http://workfarmtoresto.bigdreams.in/category/Organic%20Vegitables">Organic Vegitables</a>
</div>
</div>
-->

<?php 
$iconArray = [
  '0' => "http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables-and-fruits.png",
  '1' => "http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables.png",
  '2' => "http://workfarmtoresto.bigdreams.in/website/img/icons/fruits.png",
];
?>
@isset($parentCategories) 
@foreach($parentCategories as $parentkey=>$parentcat)
<?php
$categories = DB::table('categories')->where('parent_category_id', $parentcat->id)->get();

?>  
<a class="clearfix"></a>
<div class="dropdown" >             
  <button class="dropbtn">
    <img src="{{$iconArray[$parentkey]}}" class="navIcon" /> {{$parentcat->name}}</button>
    @isset($categories) 
    <div class="dropdown-content">
      @foreach($categories as $catkey=>$catetory)
      <a href="{{url('category' ,$catetory->name )}}">{{$catetory->name}}</a>
      @endforeach
    </div>
  </div>
  @endisset
  @endforeach
  @endisset

<!-- <div class="footerbtn">
<button class="contact100-form-btn" type="button" name="submit" data-toggle="modal" data-target="#Delivered" style="    margin-right: 13px;margin-top: 205px;">
<span>
<a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text" style="    font-weight: normal; color: #fff;">SIGN IN</a>
<!-- <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i> -->
<!-- </span>
</button>

<br>
<br>
<button class="contact100-form-btn" type="button" name="submit" data-toggle="modal" data-target="#Delivered" style="    margin-right: 13px;margin-top: -16px;">
<span>
<a href="#nav-account-dialog" data-effect="mfp-move-from-top" class="popup-text" style="    font-weight: normal; color: #fff;"> REGISTER </a>
<!-- <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i> -->
<!-- </span>
</button>
</div> -->






<!-- Ruchira -->
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    <img src="http://workfarmtoresto.bigdreams.in/website/img/icons/vegetables.png" class="navIcon"> Vegetables
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="http://workfarmtoresto.bigdreams.in/category/Fresh%20Vegetables">Fresh Vegetables</a></li>
    <li><a href="http://workfarmtoresto.bigdreams.in/category/Herbs%20And%20Seasonings">Herbs And Seasonings</a></li>
    <li><a href="http://workfarmtoresto.bigdreams.in/category/Organic%20Vegitables">Organic Vegitables</a></li>
  </ul>
</div>
<!-- Ruchira -->






<div class="footerbtn">
  <div style="display: inline-block;">
    @if(!Auth::user())
    <button class="contact100-form-btn" type="button" name="submit" data-toggle="modal" data-target="#Delivered" style="    margin-right: 13px;margin-top:190px;">
      <span>
        <a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text" style="    font-weight: normal; color: #fff; font-family: 'Lato', sans-serif;">SIGN IN</a>
      </span>
    </button>
    @else
    <a href="/home" class="contact100-form-btn text-center" style="font-weight: normal; color: #fff; " >

      Profile
    </a>
    @endif
  </div>
  <br/>
  @if(!Auth::user())
  <div style="display: inline-block;">
    <button class="contact100-form-btn" type="button" name="submit" data-toggle="modal" data-target="#Delivered" style="    margin-right: 13px;margin-top:14px;">
      <span>
        <a href="#nav-account-dialog" data-effect="mfp-move-from-top" class="popup-text" style="    font-weight: normal; color: #fff;font-family: 'Lato', sans-serif;"> REGISTER </a>
      </span>
    </button>
  </div>
  @endif
</div>
</div>
</nav>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  window.addEventListener("scroll", onScroll);
  function onScroll(e){ 
    var x=document.documentElement.scrollTop || document.body.scrollTop;
    if(x >= 75){   document.querySelector('nav1').classList.add('lighten');
  }
  else if(x==0){
    document.querySelector('nav1').classList.remove('lighten');
  }
} 
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $(window).scroll(function() {    
      var scroll = $(window).scrollTop();

      if (scroll >= 75) {
        $(".nav1").addClass("lighten");
      } else {
        $(".nav1").removeClass("lighten");
      }
    });

//   $( '#menu-hide' ).removeClass("menu:hover" );
//    // $( '#menu-hide' ).addClass( "menu-hide" );
//   $('.chamburger').toggle(
//       function() {
//          alert("show");
//         $( this ).addClass( "menu:hover" );
//        // $('#menu-hide' ).removeClass("menu-hide" );


//       }, function() {
//           alert("hide");
//         $( this ).removeClass("menu:hover" );

//          // $( '#menu-hide' ).addClass( "menu-hide" );
//       }
//     );
// });

$( '#menu-hide' ).removeClass("menu:hover" );
$( '#menu-hide' ).addClass( "menu-hide" );
$('.hamburger').toggle(
  function() {

// $( this ).addClass( "menu:hover" );
$('#menu-hide' ).removeClass("menu-hide" );


}, function() {

// $( this ).removeClass("menu:hover" );

$( '#menu-hide' ).addClass( "menu-hide" );
}
);
});

  $('.nav-toggle').click(function(e) {

    e.preventDefault();
    $("html").toggleClass("openNav");
    $(".nav-toggle").toggleClass("active");

  });
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
