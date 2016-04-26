<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', 'HomeController@displayIndexPage');
Route::get('mat-kinh/{id}', 'HomeController@displayDetailProductPage');
Route::get('bai-viet/{id}', 'HomeController@displayDetailBlogPage');
Route::get('tim-kiem', 'HomeController@displaySearchPage');

Route::get('cart/add', 'CartController@displayIndexPage');
Route::post('cart/add', 'CartController@addCart');
Route::get('cart', 'CartController@displayIndexPage');
Route::get('cart/destroy', 'CartController@deleteCart');
Route::post('cart/update', 'CartController@updateCart');
Route::post('cart/save', 'CartController@saveCart');

Route::controller('admin/users', 'ManageUserController');
Route::controller('admin/blogs', 'ManageBlogController');
Route::controller('admin/products', 'ManageProductController');
Route::controller('admin/categories', 'ManageCategoryController');
Route::controller('admin/producers', 'ManageProducerController');
Route::controller('admin/orders', 'ManageOrderController');
Route::controller('admin/block_htmls', 'ManageBlockHtmlController');
Route::controller('admin/menu_kinhs', 'ManageMenuKinhController');
Route::controller('admin/sliders', 'ManageSliderController');

Route::controller('admin', 'AdminController');

Route::get('{id}', 'HomeController@displayCategoryPage');

//ADMIN ACCOUNT
Route::get('admin/account', 'HomeController@displayIndexPage');



