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

//frontend route
Route::get('/', 'HomeController@index');
Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product-by-manufacture/{manufacture_id}', 'HomeController@product_by_manufacture');
Route::get('/view-product-details/{product_id}', 'HomeController@view_product_details');



Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::post('/update-to-cart', 'CartController@update_to_cart');
Route::get('/show_cart_details', 'CartController@show_cart_details');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');



Route::get('/login-check', 'CheckoutController@login_checkout');
Route::post('/customer_registration', 'CheckOutController@customer_registration');
Route::get('/checkout', 'CheckOutController@checkout');
Route::post('/save-shipping-details', 'CheckOutController@save_shipping_details');
Route::post('/customer_login', 'CheckOutController@customer_login');
Route::get('/customer_logout', 'CheckOutController@customer_logout');

Route::get('/payment', 'CheckOutController@payment');
Route::post('/order-place', 'CheckOutController@place_order');
Route::get('/manage-order', 'CheckOutController@manage_order');






//backend route
Route::get('/login', 'AdminController@index');
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin_dashboard', 'AdminController@dashboard');




//category related route
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category');




//Brand related route
Route::get('/add-brand', 'BrandController@index');
Route::get('/all-brand', 'BrandController@all_brand');
Route::post('/save-brand', 'BrandController@save_brand');
Route::get('/edit-brand/{manufacture_id}', 'BrandController@edit_brand');
Route::post('/update-brand/{manufacture_id}', 'BrandController@update_brand');
Route::get('/delete-brand/{manufacture_id}', 'BrandController@delete_brand');
Route::get('/unactive-brand/{manufacture_id}', 'BrandController@unactive_brand');
Route::get('/active-brand/{manufacture_id}', 'BrandController@active_brand');



//Product related route
Route::get('/add-product', 'ProductController@index');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/update-product/{product_id}', 'ProductController@update_product');




//Slider related route
Route::get('/add-slider', 'SliderController@index');
Route::get('/all-slider', 'SliderController@all_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/unactive-slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}', 'SliderController@active_slider');

