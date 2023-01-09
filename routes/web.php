<?php
// Route::view('returns','returns')->name('returns');
// Route::view('payment_details','payment_details')->name('payment_details');
Route::get('/config-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::get('/cartnew', function () {
    return view('website.cartnew');
});
Route::get('/order', function () {
    return view('website.order');
});
Route::get('/', 'UserIndexController@DisplayCategory');

/*Route::get('/account', function () {
    return view('website.account');
});*/
/*Route::get('/cartnew', 'UserController@getcart')->name('getcart');*/

// 'domain' => 'ddsadmin.devfbss.in',
/*Route::get('/admin/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
// Route::post('/admin/login', 'AdminAuth\LoginController@login')->name('admin.login');
Route::post('/admin/login', 'Auth\LoginController@adminPostLogin')->name('admin.login');
Route::post('/admin/logout', 'AdminAuth\LoginController@logout');*/

Route::post('send_otp', 'UserController@sendCodOrderOtp')->name('send_otp');

//Login Admin
Route::get('/admin/login', ['as' => 'admin.login', 'uses' => 'AdminAuth\LoginController@showLoginForm']);
Route::post('/admin/login', ['uses' => 'AdminAuth\LoginController@login']);
Route::post('/admin/login', 'AdminAuth\LoginController@adminPostLogin')->name('admin.login');
/*Route::get('/admin/logout', ['as' => 'AdminAuth.logout', 'uses' => 'AdminAuth\LoginController@logout']);*/
Route::post('/admin/logout', 'AdminAuth\LoginController@logout');

//Login User
Route::get('/', ['as' => 'user', 'uses' => 'UserAuth\LoginController@showLoginForm']);
Route::post('/', ['uses' => 'UserAuth\LoginController@login']);
Route::get('/UserLogout', ['as' => 'UserAuth.logout', 'uses' => 'UserAuth\LoginController@logout']);
Route::post('/Userprofileupdate', ['as' => 'UserAuth.profileupdate', 'uses' => 'UserAuth\LoginController@userprofileupdate']);
Route::post('/Userpasswordupdate', ['as' => 'UserAuth.passwordupdate', 'uses' => 'UserAuth\LoginController@userpasswordupdate']);


Route::get('password/reset/{token?}', 'UserAuth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');;
Route::post('password/reset', 'UserAuth\ResetPasswordController@reset');


// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
// Route::post('password/reset', 'Auth\ResetPasswordController@postReset');


//   Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::post('password/reset', 'Auth\PasswordController@reset')->name('password.reset');
// Route::get('password/resets/{token?}', 'Auth\PasswordController@showResetForm')->name('password.request');


Route::get('admin/home', 'HomeController@index')->name('admin.home');
Route::get('/admin/notification/{type}', 'HomeController@notification')->name('notification');
Route::get('/admin/homepage', 'HomePageController@index')->name('homepage.index');
Route::post('/admin/homepage/post', 'HomePageController@sectionUpdate')->name('homepage.post');
Route::post('/admin/complain/status/change', 'HomeController@updateComplainStatus')->name('complain.status.update');
Route::get('/admin/calculator', 'HomeController@calculatorIndex')->name('calculator.index');
Route::post('/admin/calculator/setting', 'HomeController@calculatorSetting')->name('calculator.setting');
//sms routes
Route::get('/admin/sms', 'SmsController@index')->name('sms.index');
Route::post('/admin/sms/send', 'SmsController@send')->name('sms.send');
//customer routes
Route::view('/admin/customer', 'admin.customer.index')->name('customer.index');
Route::get('/admin/customer/{user}/show', 'CustomerController@show')->name('customer.show');
Route::get('/admin/pincode', 'ProductController@pincode_index')->name('pincode');
Route::get('/admin/review', 'ProductController@review_index')->name('review');
Route::get('/admin/get_pincode', 'ProductController@get_pincode')->name('get_pincode');
Route::get('/admin/get_review', 'ProductController@get_review')->name('get_review');
Route::post('/admin/update_pincode_status', 'ProductController@update_pincode_status')->name('update_pincode_status');
Route::post('/admin/update_review_status', 'ProductController@update_review_status')->name('update_review_status');
//products routes 
Route::resource('/admin/product', 'ProductController');
Route::get('/admin/excel_view', 'ProductController@showExcel')->name('excel.view');
Route::get('/admin/download_template', 'ProductController@downloadTemplate')->name('excel.download_template');
Route::post('/admin/upload_template', 'ProductController@uploadTemplate')->name('excel.upload_template');
Route::get('/admin/download_product_template', 'ProductController@downloadProductTemplate')->name('excel.download_product_template');
Route::get('/admin/download_flipcart_template', 'ProductController@downloadForFlipcartTemplate')->name('excel.download_product_template');
Route::post('/admin/upload_product_template', 'ProductController@uploadProductTemplate')->name('excel.upload_product_template');
Route::get('/admin/product/clone/{product}', 'ProductController@cloneProduct')->name('clone.product');
Route::post('/admin/product/delete', 'ProductController@deletePermanent')->name('product.delete');
Route::post('/admin/check/sku_code', 'ProductController@checkSkuCode')->name('check.sku_code');
Route::post('/admin/dropzone/media/uploads', 'ProductController@mediaUploads')->name('mediaUploads');
Route::put('/admin/update/product/{product}', 'ProductController@updateStock');
Route::post('/admin/unarchive/product', 'ProductController@unarchiveProduct')->name('product.unarchive');
Route::post('/admin/archive/product', 'ProductController@archiveProduct')->name('product.archive');
Route::post('/admin/media/delete', 'ProductController@deleteMedia')->name('media.delete');

//Slider
Route::resource('/admin/slider', 'SliderController');
Route::post('/admin/datatable/slider', 'DataTableController@slider')->name('datatable.slider.index');

Route::post('/admin/slider/delete', 'SliderController@deleteslider')->name('slider.delete');



//Product AttributeMAsterRoute
Route::resource('/admin/productattributemaster', 'ProductAttributeMasterController');
Route::post('/admin/datatable/productattributemaster', 'DataTableController@productmasterattribute')->name('datatable.productmasterattribute.index');
Route::post('/admin/productattributemaster/delete', 'ProductAttributeMasterController@deletepromasteratt')->name('productattributemaster.delete');


//Product AttributeRoute
Route::resource('/admin/productattibute', 'ProductAttributeController');
Route::post('/admin/datatable/productattribute', 'DataTableController@productattribute')->name('datatable.productattribute.index');
Route::post('/admin/productattribute/delete', 'ProductAttributeController@deleteattribute')->name('productattribute.delete');
Route::post('/admin/productattribute/delete', 'ProductAttributeController@deleteattribute')->name('productattribute.delete');

//Contact Info
Route::get('/admin/contactuser', 'DataTableController@contactuserindex');
Route::post('/admin/datatable/contactuser', 'DataTableController@contactuser')->name('datatable.contactuser.index');

//category routes
Route::resource('/admin/category', 'CategoryController');
Route::get('/admin/category/{category}', 'CategoryController@getSubCategory')->name('category.get_sub_cat');
//Parent Category
Route::resource('/admin/parent_category', 'ParentCategoryController');
Route::post('/admin/datatable/parent/category/index', 'ParentCategoryController@datatableIndex')->name('parent_category.datatable.index');
//order routes
Route::resource('/admin/order', 'OrderController');
Route::get('/admin/cancel_order/{id}', 'OrderController@cancelOrder')->name('cancel_order');
Route::get('/admin/order/download/manifest', 'OrderController@downloadManifest')->name('download.manifest');
Route::get('/admin/order/type/{type?}', 'OrderController@getOrderByType')->name('order.type');
// Route::get('order/{order}/confirm', 'OrderController@confirmOrder')->name('order.confirm');
Route::get('/admin/order/{order}/pack/{qty}', 'OrderController@packOrder')->name('order.pack');
Route::get('/admin/order/{order}/handover/{qty}', 'OrderController@handoverOrder')->name('order.handover');
Route::post('/admin/order/pack/all', 'OrderController@packAll')->name('order.pack.all');
Route::get('/admin/order/{order}/pdf', 'OrderController@pdf')->name('invoice.pdf');
Route::get('/admin/order/{order}/out_for_delivery', 'OrderController@outForDelivery')->name('order.out_for_delivery');
Route::post('/admin/order/out_for_delivery/all', 'OrderController@allToTransit')->name('order.all_to_transit');
//datatable routes
Route::post('/admin/datatable/live/listing', 'DataTableController@liveListing')->name('datatable.live.listing');
Route::post('/admin/datatable/archive/listing', 'DataTableController@archiveListing')->name('datatable.archive.listing');


Route::get('/admin/datatable/customer/all', 'DataTableController@customerIndex')->name('customer.all');
Route::post('/admin/datatable/category', 'DataTableController@categoryIndex')->name('datatable.category.index');
Route::post('/admin/datatable/return_order_request', 'DataTableController@returnOrderIndex')->name('datatable.return_order_request.index');
Route::post('/admin/datatable/complains', 'DataTableController@complains')->name('datatable.complains.index');
Route::post('/admin/report/payment/filter/{date?}', 'DataTableController@payments')->name('payment.report.filter');
Route::post('/admin/reports/sales', 'DataTableController@salesReport')->name('sale.report.filter');
Route::post('/admin/reports/orders', 'DataTableController@ordersReport')->name('order.report.filter');
//Blue Dart routes
Route::post('/admin/register/orders/all', 'BlueDartController@registerAllOrders')
    ->name('register.all.orders');
Route::post('/admin/register_order', 'BlueDartController@registerOrder')->name('register.order');
Route::get('/admin/order/{order}/awb/download', 'BlueDartController@awbDownload')->name('download.awb');
Route::post('/admin/returnOrderRequest/{id}', 'BlueDartController@returnOrder')->name('return-order');
//reports
Route::view('/admin/report/payment', 'admin.reports.payment')->name('payment.report');
Route::view('/admin/reports/sales', 'admin.reports.sales')->name('sale.report');
Route::view('/admin/reports/order', 'admin.reports.orders')->name('order.report');
// Refund
Route::post('/admin/refund_on_cancel/{id}', 'OrderController@refundOnCancel')->name('refund_on_cancel');
Route::get('/admin/awbReturnOrder/pdf/{returnOrder}', 'OrderController@awbReturnOrder')->name('awb_return_order');
Route::post('/admin/product_received/{returnOrder}', 'OrderController@productReceived')->name('product_received_confirm');
Route::post('/admin/refund/{id}', 'OrderController@refundOrder')->name('refund.order');
Route::get('/admin/check_order_status', 'BlueDartController@updateOrderStatus')->name('update.order_status');
Route::view('/admin/special_pages', 'admin.special.index')->name('special_page');
Route::view('/admin/add_special_page', 'admin.special.create')->name('add_special_page');
Route::view('/admin/edit_special_page', 'admin.special.edit')->name('edit_special_page');
/*End of admin urls*/
Route::get('category/{name}', 'UserController@categoryShow')->name('showCategory');
Route::get('product/{category}/{model}/{product}', 'UserController@productShow')->name('product.show');
Route::get('product1/{category}/{model}/{product}', 'UserController@productShow1')->name('product.show1');
Route::post('product/search', 'UserController@filterProduct')->name('filter.product');
Route::post('cart/{product}', 'UserController@addToCart')->name('add_to_cart');
Route::post('wishlistcartadd', 'UserController@wishlistcartadd')->name('wishlistcartadd');
Route::post('cartadd', 'UserController@ajaxaddToCart')->name('ajaxaddToCart');
Route::post('homecart/{product}', 'UserController@addToCartnew')->name('add_to_cartnew');
/*Route::get('add_to_cartnew', 'UserController@addToCartnew')->name('add_to_cartnew');*/

Route::get('getcart', 'UserController@getcart')->name('getcart');
Route::get('mobilenocheck', 'UserController@mobilenocheck')->name('mobilenocheck');


Route::get('buy_now/{product}', 'UserController@buy_now')->name('buy_now');
Route::get('cart', 'UserController@userCart')->name('user.cart');
Route::post('change/cart/update', 'UserController@updateCart')->name('update.cart');
Route::post('change/cart/remove', 'UserController@removeFromCart')->name('update.remove');
Route::post('signup', 'UserController@signUp')->name('signup');
Route::post('contact', 'UserController@postContact')->name('post.contact');
Route::post('/getProductWithSku/{sku}', 'UserController@getProductWithSku')->name('product.with_sku');
Route::get('cart/{product}', 'UserController@addToCart')->name('add_to_cart');
// vishal code
Route::get('demo-index', 'UserController@index2')->name('about_us');
Route::get('/', 'UserController@index')->name('index');
Route::get('/dynamic', 'UserController@dynamic');

Route::view('about_us', 'website.about-us')->name('about_us');
Route::view('contact', 'website.contact')->name('contact');
Route::view('gifting', 'website.gifting')->name('gifting');
Route::view('offers', 'website.offer')->name('offers');
Route::view('subscription', 'website.subscription')->name('subscription');
Route::view('own-grown', 'website.own-grown')->name('own-grown');
Route::view('privacy_policy', 'website.privacy-policy')->name('privacy_policy');
Route::view('return_policy', 'website.shipp-policy')->name('return_policy');
Route::view('terms_condition', 'website.terms-condition')->name('terms_condition');
Route::view('disclaimer', 'website.disclaimer')->name('disclaimer');
Route::view('careers', 'website.careers')->name('careers');
Route::view('blogpost1', 'website.blog1')->name('blogpost1');
Route::view('blogpost2', 'website.blog2')->name('blogpost2');
Route::view('blogpost3', 'website.blog3')->name('blogpost3');

Route::post('wishlist/{product}', 'UserController@addToWishlist')->name('wishlist');
Route::get('mywishlist', 'UserController@displaywishlist')->name('display.Wishlist');
/*Route::post('mywishlist', 'UserController@destroyWishlist')->name('destroy.Wishlist');*/
Route::get('mywishlist/delete/{id}', ['as' => 'destroyWishlist', 'uses' => 'UserController@destroyWishlist']);


Route::get('my_wishist', 'UserController@wishlist')->name('view.wishlist');
Route::get('wishlist/{row_id}/remove', 'UserController@removeFromWishlist')->name('remove.wishlist');
Route::post('get_state_city', 'UserController@getStateCity')->name('get_state_city');
Route::post('send/login/otp', 'UserController@sendLoginOtp')->name('send.login.otp');
Route::post('resend/login/otp', 'UserController@resendLoginOtp')->name('resend.login.otp');
Route::post('otp/login', 'UserController@loginWithOtp')->name('login.with.otp')->middleware('throttle:10,1');
Route::get('ordercomplete', 'OrderController@ordercomplete');

Route::group(['middleware' => 'auth'], function () {
    //razor pay route
    Route::post('/captureOrder', 'UserController@captureOrder')->name('captureOrder');
    Route::post('/subscription', 'UserController@subscription_store')->name('subscription_store');
    Route::get('checkout', 'UserController@confirmOrder')->name('confirm_order');
    Route::get('subs_checkout/{price}','UserController@confirmSubs')->name('confirm_subs');
    Route::post('checkout', 'OrderController@store')->name('checkout_order');
    Route::get('home', 'UserController@oldhome')->name('home');
    Route::get('testlogin', 'UserController@home');

    Route::post('profile/update', 'UserController@profileUpdate')->name('profile.update');
    Route::post('billing/update', 'UserController@updateBilling')->name('billing.update');
    Route::post('order/cancel/{order}', 'UserController@cancelOrder')->name('cancel_order');
    Route::get('order/placed/{order}', 'UserController@orderPlaced')->name('order_placed');
    Route::post('payment/response/{token}', 'UserController@paymentResponse')->name('payment.response');
    Route::get('payment/response/{token}', 'UserController@home');
    Route::post('post/question/{product}', 'UserController@postQuestion')->name('ask.question');
    Route::post('reply/question', 'UserController@replyQuestion')->name('reply.question');
    Route::post('complain/{order}', 'ComplainController@store')->name('complain.store');
    Route::post('return/{order}', 'UserController@returnOrder')->name('return_order');
    Route::post('profile/updaterestoinfo', 'UserController@updaterestoinfo')->name('profile.updaterestoinfo');
});
Route::get('confirmOrderGuest', 'UserController@confirmOrderGuest')->name('confirmOrderGuest');
Route::post('checkoutGuest', 'OrderController@storeGuest')->name('checkoutGuest');
Route::get('newsletter/unsubscribe/{email}/{user_hash}', 'UserController@newsletterUnsubcribe')->name('newsletter.unsubscribe');
Route::post('shipment_to_pincode/', 'BlueDartController@checkShippingAvailability')->name('shipping_availability');
Route::post('verify_otp', 'UserController@verifyOtp')->name('verify_otp')->middleware('throttle:10,1');

Route::post('verify_coupen', 'OrderController@verify_coupen')->name('verify_coupen');
// composer require phpseclib/mcrypt_compat
//libssl1.0-dev
// Route::view('privacy_policy','website.privacy-policy')->name('privacy_policy')
Route::post('get-products', 'HomeController@get_products');
Route::post('ThankYou', 'UserController@getThankYouPage')->name('thank_you_page');
// Route::view('demo', 'website.demo')->name('demo');
Route::get('/trackOrders/{awb?}', function ($awb) {
    $data = [$awb];
    $co = new \App\Repository\Bluedart\TrackOrders($data);
    $co->track();
});
//Landing Pages Route
// Route::view('womens_wear','website.landing.womens_wear');
Route::view('health_and_beauty', 'website.landing.health_and_beauty');
Route::view('womens_accessories', 'website.landing.womens_accessories');
Route::view('home_and_kitchen', 'website.landing.home_and_kitchen');
Route::view('Health-And-Beauty', 'website.landing.Health-And-Beauty');
Route::view('Womens-Wear', 'website.landing.Womens-Wear');
Route::view('Womens-Accessories', 'website.landing.Womens-Accessories');
Route::view('Home-And-Kitchen', 'website.landing.Home-And-Kitchen');
Route::get('get_order/{id}', 'UserController@getorderbyorder_id')->name('get_order');
Route::post('get_subcription', 'UserController@getsubscribe')->name('get_subcription');


Route::post('sub_review', 'UserController@subreview')->name('sub_review');
// Womens-Wear

// Routes by Nandu
Route::post('register', 'UserController@register')->name('register');
Route::get('postLogin', 'UserAuth\LoginController@formload');
Route::get('account', 'UserController@account')->name('account');
Route::get('social/{provider}/redirect/{action}', 'UserController@redirect');
Route::post('social/{provider}/callback','UserController@Callback');


Route::Post('newlogin', 'UserController@newlogin')->name('newlogin');
Route::post('postRegistration', 'UserAuth\LoginController@postRegistration')->name('postRegistration');
/*Route::post('UserLogin', 'UserAuth\LoginController@UserLogin')->name('UserLogin');*/
Route::post('UserLogout', 'UserAuth\LoginController@UserLogout')->name('UserLogout');
/*Route::get('postLogin', 'Auth\LoginController@formload');

Route::Post('newlogin', 'UserController@newlogin')->name('newlogin');
Route::post('postRegistration', 'Auth\LoginController@postRegistration')->name('postRegistration');
Route::post('UserLogin', 'Auth\LoginController@UserLogin')->name('UserLogin');
Route::post('UserLogout', 'Auth\LoginController@UserLogout')->name('UserLogout');*/

Route::post('checkoutpostLogin', 'UserAuth\LoginController@checkoutpostLogin')->name('checkoutpostLogin');
Route::view('/admin/all_delivery_boy', 'admin.deliveryboy.index')->name('admin.deliveryboy.index');
Route::view('/admin/add_delivery_boy', 'admin.deliveryboy.create')->name('admin.deliveryboy.create');
Route::post('/admin/save_delivery_boy_details', 'DeliveryBoyController@save_delivery_boy_details')->name('admin.save_delivery_boy_details');
Route::get('/admin/datatable/deliveryboy/all', 'DataTableController@deliveryboyIndex')->name('deliveryboyshow');
// Route::get('/admin/datatable/customer/all', 'DataTableController@customerIndex')->name('customer.all');
Route::get('/admin/deliveryboyshow/{id}', 'DeliveryBoyController@show')->name('admin.deliveryboy.show');
Route::view('/admin/restoprofile', 'website.restoprofile');
Route::view('/admin/restrodeliveryboy', 'website.restrodeliveryboy');
Route::view('/admin/orderdetails', 'website.orderdetails');
Route::get('deliveryboydashboard', 'DeliveryBoyController@deliveryboydashboard')->name('deliveryboydashboard');
Route::post('/admin/userapproval', 'CustomerController@userapproval')->name('admin.userapproval');
Route::get('repeatorder/{id}', 'UserController@repeatorder')->name('repeatorder');
Route::get('/admin/datatable/order/all', 'DataTableController@deliveryboyOrderIndex')->name('admin.order.all');
Route::get('demo', 'DataTableController@deliveryboyOrderIndex')->name('demo');
Route::get('orderdetails/{id}', 'DeliveryBoyController@orderdetails')->name('orderdetails');
Route::post('orderdelivered', 'OrderController@orderdelivered')->name('orderdelivered');
Route::post('orderrejection', 'OrderController@orderrejection')->name('orderrejection');
Route::post('search', 'UserController@search')->name('search');
/*Route::get('search/{keyword}', 'UserController@search')->name('search');*/

Route::get('/admin/purchaseorder', 'OrderController@purchaseorder')->name('purchaseorder');
//Route::get('/admin/purchaseorderExport','OrderController@export')->name('purchaseorderExport');
/*Route::get('/admin/purchaseorderExportexcel','OrderController@export')->name('admin.purchaseorder.all');*/


Route::get('/admin/datatable/purchaseorder/all', 'DataTableController@purchaseorderIndex')->name('deliveryboyshow');
Route::get('demo', 'DataTableController@purchaseorderIndex')->name('demo');
Route::post('/cat/attribute/{q}', 'UserController@catresult')->name('catresult');

Route::get('/All-Vegetables-And-Fruits', 'UserController@allveg');

Route::post('add_to_my_cart', 'UserController@add_to_my_cart')->name('add_to_my_cart');
Route::resource('/admin/warehouse','DelhiveryController');


 
 
