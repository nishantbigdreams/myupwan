<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?php echo e(route('admin.home')); ?>" class="logo">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo" class="img-responsive" width="164" height="53"/>

                </a>
                
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">
                <ul class="nav navbar-nav navbar-right pull-right">
                     
                    <li class="dropdown navbar-c-items">                      
                    <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                                

                    <li class="dropdown navbar-c-items ">
                        <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo e(asset('images/users/avatar-1.png')); ?>" alt="user-img" class="img-circle"> </a>
                      <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                         
                            <li>
                                <a href="javascript:void(0)" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-power-off m-r-5"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(url('/admin/logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>

                    </ul>

                </li>
            </ul>
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>
        <!-- end menu-extras -->
    </div> <!-- end container -->
</div>
<!-- end topbar-main -->


<?php
   if( Auth::guard('admin')->user() && Auth::guard('admin')->user()->usertype === 'Admin'){
?>

<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li class="has-submenu">
                    <a href="<?php echo e(route('admin.home')); ?>" >
                        <i class="mdi mdi-view-dashboard"></i>Dashboard
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="#">
                        <i class="mdi mdi-layers"></i>Listings
                    </a>
                    <ul class="submenu">
                        <li>
                             <a href="<?php echo e(url('/admin/excel_view')); ?>">
                                My Excel
                            </a>
                           <!--  <a href="<?php echo e(route('admin.excel.view')); ?>">
                                My Excel
                            </a> -->
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/product')); ?>">
                                My Listings
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/product/create')); ?>">
                                Add Listings
                            </a>
                        </li>
                         <!--<li>
                            <a href="<?php echo e(route('admin.special_page')); ?>">
                                Special Offer Page
                            </a>
                        </li>-->
                        <li class="has-submenu">
                            <a href="#">
                                <i class="mdi mdi-file"></i> Categories
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="<?php echo e(url('/admin/parent_category/create')); ?>">
                                        Parent Category
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/category/create')); ?>">
                                        New Category
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/category')); ?>">
                                        List Categories
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">
                        <i class="mdi mdi-layers"></i>Slider
                    </a>
                    <ul class="submenu">

                        <li>
                            <a href="<?php echo e(url('/admin/slider')); ?>">
                                Slider Manage
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/slider/create')); ?>">
                                Add Slider
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">
                        <i class="fa fa-bars"></i> Product Attribute
                    </a>
                    <ul class="submenu">
                        <li class="has-submenu">
                            <a href="#">
                                <i class="mdi mdi-file"></i> Product Attribute Master
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="<?php echo e(url('/admin/productattributemaster/create')); ?>">
                                        New Attribute Master
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/admin/productattributemaster')); ?>">
                                        List Attribute Master
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo e(url('/admin/productattibute')); ?>">
                                List Attribute
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('admin/productattibute/create')); ?>">
                                Add Attribute
                            </a>
                        </li>
                        <!--<li>
                            <a href="<?php echo e(route('admin.special_page')); ?>">
                                Special Offer Page
                            </a>
                        </li>-->
                    </ul>

                </li>

                <li class="has-submenu">
                    <a href="#">
                        <i class="mdi mdi-book-multiple"></i> Orders
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo e(url('/admin/order/type/active')); ?>">
                                Active
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/order/type/delivered')); ?>">
                                Completed
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/order/type/cancelled')); ?>">
                                Cancelled
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/order/type/return')); ?>">
                                Order Return Requests
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="fa fa-user"></i>Customers</a>
                    <ul class="submenu">
                        <li><a href="<?php echo e(url('/admin/customer')); ?>">All Customers</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-user"></i>Contact Info</a>
                    <ul class="submenu">
                        <li><a href="<?php echo e(url('/admin/contactuser')); ?>">All Customers</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">
                        <i class="mdi mdi-cash-multiple"></i> Reports
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo e(url('/admin/report/payment')); ?>">
                                Payments Reports
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/reports/sales')); ?>">
                                Sales Reports
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/admin/reports/order')); ?>">
                                Order Reports
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo e(url('/admin/sms')); ?>">
                        <i class="fa fa-envelope-o"></i> Bulk SMS
                    </a>
                </li>

               <!--  <li>
                    <a href="http://vendor.novasell.in/vendor-list" target="_blank">
                        <i class="fa fa-shopping-bag"></i> Vendors
                    </a>
                </li> -->

                <li>
                    <a href="<?php echo e(url('/admin/pincode')); ?>">
                        <i class="fa fa-map-marker"></i> Pincodes
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(url('/admin/review')); ?>">
                        <i class="fa fa-envelope-o"></i> Review
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="#">
                        <i class="fa fa-user"></i> Delivery Boy Section
                    </a>
                    <ul class="submenu">

                        <li>
                            <a href="<?php echo e(url('/admin/add_delivery_boy')); ?>">
                                Add Delivery Boy
                            </a>
                        </li>
                         
                        <li>
                            <a href="<?php echo e(url('/admin/all_delivery_boy')); ?>">
                                All Delivery Boy
                            </a>
                        </li>
                        
                    </ul>
                </li>
                 <!-- <li class="has-submenu">
                    <a href="#">
                        <i class="fa fa-user"></i> Region Section
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo e(route('admin.region.create')); ?>">
                                Add Region
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin.region.index')); ?>">
                                All Region
                            </a>
                        </li>

                    </ul>
                </li> -->

                <!-- <li class="has-submenu pull-right">
                    <a href="#">
                        <i class="mdi mdi-settings fa-spin"></i> Settings
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo e(route('admin.homepage.index')); ?>" target="_blank">
                             Home Page
                         </a>
                     </li>
                     <li>
                        <a href="<?php echo e(route('admin.calculator.index')); ?>">
                            Calculator
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
</div>

<?php } ?>
</header>
