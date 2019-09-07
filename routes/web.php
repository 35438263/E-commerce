<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/

//frontend......................................
Route::get('/', 'HomeController@index');//home for user


//chechout ..................................
Route::get('/login-check', 'CheckoutController@login_check');
Route::post('/customer-register', 'CheckoutController@customer_register');
Route::post('/customer-login', 'CheckoutController@customer_login');
Route::get('/customer-logout', 'CheckoutController@customer_logout');


Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-shipping-details', 'CheckoutController@save_shipping_details');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/order', 'CheckoutController@order');





//backend.  admin.....................................
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');//login admin
Route::get('/dashboard', 'SuperAdminController@index');//home dashboard
Route::post('/admin-dashboard', 'AdminController@dashboard');//login verification
Route::get('/manage-order', 'AdminController@manage_order');
Route::get('/view-order/{order_id}', 'AdminController@view_order');


//category ..........................................
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');


//brand.....................................................
Route::get('/add-brand', 'ManufactureController@index');
Route::get('/all-brand', 'ManufactureController@all_brand');
Route::post('/save-brand', 'ManufactureController@save_brand');
Route::get('/unactive-brand/{brand_id}', 'ManufactureController@unactive_brand');
Route::get('/active-brand/{brand_id}', 'ManufactureController@active_brand');
Route::get('/edit-brand/{brand_id}', 'ManufactureController@edit_brand');
Route::post('/update-brand/{brand_id}', 'ManufactureController@update_brand');
Route::get('/delete-brand/{brand_id}', 'ManufactureController@delete_brand');


//product0.........................


Route::get('/add-product', 'ProductController@index');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/show-products', 'HomeController@show_product');

Route::post('/save-product', 'ProductController@save_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::post('/search-by-name', 'ProductController@search_by_name');


//product by category ......................
Route::get('/product-by-category/{category_id}', 'HomeController@product_by_category');

//product by brand......................
Route::get('/product-by-brand/{brand_id}', 'HomeController@product_by_brand');



Route::get('/product-details/{product_id}', 'HomeController@product_details');






//slider ................................................

Route::get('/add-slider', 'SliderController@index');
Route::get('/all-slider', 'SliderController@all_slider');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/unactive-slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}', 'SliderController@active_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');




//cart...................................
Route::post('/add-to-cart/{product_id}', 'CartController@add_to_cart');
Route::get('/delete-cart/{product_id}', 'CartController@delete_cart');
Route::get('/plus-cart/{product_id}', 'CartController@plus_cart');
Route::get('/minus-cart/{product_id}', 'CartController@minus_cart');

Route::get('/show-cart', function (){

    return view('pages.add_to_cart');

});