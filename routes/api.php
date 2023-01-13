<?php

use Illuminate\Http\Request;

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|*/
Route::get('mhome', 'ApiController@home');
Route::get('slider', 'ApiController@slider');
Route::post('mlogin', 'ApiController@postLogin');
//Route::get('mlogin', 'ApiController@Login');

Route::post('mregister', 'ApiController@register');
Route::post('addAddress', 'ApiController@addAddress');
Route::get('category', 'ApiController@categoryShow');
// Route::get('category/{name}', 'ApiController@categoryShow');
Route::get('search/{keyword}', 'ApiController@search');
Route::post('profile/update', 'ApiController@profileUpdate');
Route::post('profile', 'ApiController@profile');
Route::get('profile_details', 'ApiController@profile_details');

Route::post('myorders', 'ApiController@myorders');

Route::post('singlelisting', 'ApiController@product');
Route::post('addcart', 'ApiController@addCart');
Route::post('addTocart', 'ApiController@addCart');

Route::get('checkout', 'ApiController@checkout');
Route::post('timeslot', 'ApiController@timeslot');
// Route::get('timeslot', 'ApiController@timeslot');


Route::get('repeatorder/{id}' , 'ApiController@repeatorder');
Route::post('checkout', 'ApiController@captureOrderapi');
Route::post('sendLoginOtp', 'ApiController@sendLoginOtp');
Route::post('sendCodOtp', 'ApiController@sendCodOtp');
Route::post('VerifyCodOtp', 'ApiController@VerifyCodOtp');

Route::post('loginWithOtp', 'ApiController@loginWithOtp');
Route::post('removeFromCart', 'ApiController@removeFromCart');



//  khurshid api 

Route::post('get_subcateg_byname', 'ApiController@get_subcateg_byname');
Route::post('get_by_subname', 'ApiController@get_product_bysubcategname');
// Route::post('get_by_prod_sku', 'ApiController@get_by_prod_sku');
Route::post('get_more_categ_name', 'ApiController@get_more_categ_name');
Route::post('get_prod_by_id_model', 'ApiController@get_prod_by_id_model');
Route::post('popular_2022', 'ApiController@popular_2022');
Route::post('addtowishlist', 'ApiController@addtowishlist');
Route::post('search_products', 'ApiController@search_products');
Route::post('confirmSubs', 'ApiController@confirmSubs');
Route::post('subreview', 'ApiController@subreview');
Route::post('display_my_wishlist', 'ApiController@display_my_wishlist');





