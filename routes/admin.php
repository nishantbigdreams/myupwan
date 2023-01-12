<?php

Route::get('home', 'HomeController@index')->name('admin.home');
Route::get('notification/{type}', 'HomeController@notification')->name('notification');
Route::get('homepage', 'HomePageController@index')->name('homepage.index');
Route::post('homepage/post', 'HomePageController@sectionUpdate')->name('homepage.post');
Route::post('complain/status/change', 'HomeController@updateComplainStatus')->name('complain.status.update');
Route::get('calculator', 'HomeController@calculatorIndex')->name('calculator.index');
Route::post('calculator/setting', 'HomeController@calculatorSetting')->name('calculator.setting');
//sms routes
Route::get('sms', 'SmsController@index')->name('sms.index');
Route::post('sms/send', 'SmsController@send')->name('sms.send');
//customer routes
Route::view('customer','admin.customer.index')->name('customer.index');
Route::get('customer/{user}/show', 'CustomerController@show')->name('customer.show');

Route::get('pincode','ProductController@pincode_index')->name('pincode');
Route::get('get_pincode','ProductController@get_pincode')->name('get_pincode');
Route::post('update_pincode_status','ProductController@update_pincode_status')->name('update_pincode_status');

//products routes 
Route::resource('product','ProductController');
Route::get('excel_view','ProductController@showExcel')->name('excel.view');
Route::get('download_template','ProductController@downloadTemplate')->name('excel.download_template');
Route::post('upload_template','ProductController@uploadTemplate')->name('excel.upload_template');
Route::get('download_product_template','ProductController@downloadProductTemplate')->name('excel.download_product_template');
Route::get('download_flipcart_template','ProductController@downloadForFlipcartTemplate')->name('excel.download_product_template');
Route::post('upload_product_template','ProductController@uploadProductTemplate')->name('excel.upload_product_template');
Route::get('product/clone/{product}', 'ProductController@cloneProduct')->name('clone.product');
Route::post('product/delete', 'ProductController@deletePermanent')->name('product.delete');
Route::post('check/sku_code', 'ProductController@checkSkuCode')->name('check.sku_code');
Route::post('dropzone/media/uploads', 'ProductController@mediaUploads')->name('uploads');
Route::put('update/product/{product}', 'ProductController@updateStock');
Route::post('unarchive/product', 'ProductController@unarchiveProduct')
        ->name('product.unarchive');
Route::post('archive/product', 'ProductController@archiveProduct')
        ->name('product.archive');
Route::post('media/delete', 'ProductController@deleteMedia')->name('media.delete');

//category routes
Route::resource('category','CategoryController');
Route::get('category/{category}','CategoryController@getSubCategory')
    ->name('category.get_sub_cat');

//Parent Category
Route::resource('parent_category','ParentCategoryController');
Route::post('datatable/parent/category/index','ParentCategoryController@datatableIndex')
->name('parent_category.datatable.index');


//order routes
Route::resource('order','OrderController');
Route::get('cancel_order/{id}','OrderController@cancelOrder')->name('cancel_order');
Route::get('order/download/manifest', 'OrderController@downloadManifest')->name('download.manifest');
Route::get('order/type/{type?}', 'OrderController@getOrderByType')->name('order.type');
// Route::get('order/{order}/confirm', 'OrderController@confirmOrder')->name('order.confirm');
Route::get('order/{order}/pack', 'OrderController@packOrder')->name('order.pack');
Route::post('order/pack/all', 'OrderController@packAll')->name('order.pack.all');
Route::get('order/{order}/pdf', 'OrderController@pdf')->name('invoice.pdf');
Route::get('order/{order}/out_for_delivery', 'OrderController@outForDelivery')->name('order.out_for_delivery');
Route::post('order/out_for_delivery/all', 'OrderController@allToTransit')->name('order.all_to_transit');

//datatable routes
Route::post('datatable/live/listing', 'DataTableController@liveListing')
    ->name('datatable.live.listing');

Route::post('datatable/archive/listing', 'DataTableController@archiveListing')
    ->name('datatable.archive.listing');

Route::get('datatable/customer/all', 'DataTableController@customerIndex')->name('customer.all');

Route::post('datatable/category', 'DataTableController@categoryIndex')->name('datatable.category.index');

Route::post('datatable/return_order_request', 'DataTableController@returnOrderIndex')->name('datatable.return_order_request.index');

Route::post('datatable/complains', 'DataTableController@complains')->name('datatable.complains.index');

Route::post('report/payment/filter/{date?}', 'DataTableController@payments')->name('payment.report.filter');

Route::post('reports/sales','DataTableController@salesReport')->name('sale.report.filter');
Route::post('reports/orders','DataTableController@ordersReport')->name('order.report.filter');

//Blue Dart routes
Route::post('register/orders/all', 'BlueDartController@registerAllOrders')
->name('register.all.orders');
Route::post('register_order', 'BlueDartController@registerOrder')->name('register.order');
Route::get('order/{order}/awb/download', 'BlueDartController@awbDownload')->name('download.awb');
Route::post('returnOrderRequest/{id}','BlueDartController@returnOrder')->name('return-order');

//reports
Route::view('report/payment', 'admin.reports.payment')->name('payment.report');
Route::view('reports/sales','admin.reports.sales')->name('sale.report');
Route::view('reports/order','admin.reports.orders')->name('order.report');

// Refund
Route::post('/refund_on_cancel/{id}','OrderController@refundOnCancel')->name('refund_on_cancel');
Route::get('/awbReturnOrder/pdf/{returnOrder}','OrderController@awbReturnOrder')->name('awb_return_order');
Route::post('/product_received/{returnOrder}','OrderController@productReceived')->name('product_received_confirm');




Route::post('refund/{id}','OrderController@refundOrder')->name('refund.order');
Route::get('check_order_status','BlueDartController@updateOrderStatus')->name('update.order_status');

Route::view('special_pages','admin.special.index')->name('special_page');
Route::view('add_special_page','admin.special.create')->name('add_special_page');
Route::view('edit_special_page','admin.special.edit')->name('edit_special_page');


// Route By Nandu

// Route::view('customer','admin.customer.index')->name('customer.index');
// Route::get('customer/{user}/show', 'CustomerController@show')->name('customer.show');

Route::view('all_delivery_boy','admin.deliveryboy.index')->name('deliveryboy.index');
Route::view('add_delivery_boy','admin.deliveryboy.create')->name('deliveryboy.create');
Route::post('save_delivery_boy_details','DeliveryBoyController@save_delivery_boy_details')->name('save_delivery_boy_details');
Route::get('datatable/deliveryboy/all', 'DataTableController@deliveryboyIndex')->name('deliveryboy.all');
Route::get('deliveryboyshow/{id}', 'DeliveryBoyController@show')->name('deliveryboyshow');


// regions
Route::view('add_region','admin.region.create')->name('region.create');
Route::view('all_region','admin.region.index')->name('region.index');
Route::get('datatable/region/all', 'DataTableController@regionIndex')->name('region.all');
Route::get('region/{user}/show', 'RegionController@show')->name('region.show');

Route::post('userapproval', 'CustomerController@userapproval')->name('userapproval');

Route::get('datatable/order/all', 'DataTableController@deliveryboyOrderIndex')->name('order.all');

Route::get('orderdetails/{id}', 'DeliveryBoyController@orderdetails')->name('orderdetails');
Route::get('datatable/purchaseorder/all', 'DataTableController@purchaseorderIndex')->name('purchaseorder.all');






//DELHIVERY API IMPLEMENTATION







