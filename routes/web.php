<?php

Route::get('/', 'User\HomeController@index')->name('omelas');
Route::get('products', 'User\HomeController@products')->name('products');
Route::get('products/{product}', 'User\HomeController@product')->name('product');
Route::get('whatsnew', 'User\HomeController@whatsnew')->name('whatsnew');
Route::get('bestsellers', 'User\HomeController@bestsellers')->name('bestsellers');
Route::get('men', 'User\HomeController@men')->name('men');
Route::get('women', 'User\HomeController@women')->name('women');
Route::get('children', 'User\HomeController@children')->name('children');
Route::get('shipping', 'User\HomeController@shipping')->name('shipping');
Route::get('sale', 'User\HomeController@sale')->name('sale');
Route::get('about_us', 'User\HomeController@about_us')->name('about_us');



Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::resource('cart', 'CartController');
Route::get('/cart/add-item/{id}', 'CartController@addItem')->name('cart.addItem');


Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
  Route::post('toggledeliver/{orderId}', 'OrderController@toggledeliver')->name('toggle.deliver');

Route::get('/', function(){
    return view('admin.index');
})->name('admin.index');

Route::resource('product', 'Admin\ProductsController');
Route::resource('category', 'Admin\CategoriesController');
Route::get('orders/{type?}', 'OrderController@Orders');
});

Route::resource('address', 'AddressController');

Route::group(['middleware'=> 'auth'], function (){
Route::get('shipping-info', 'CheckOutController@shipping')->name('checkout.shipping');


});

// Route::get('checkout', 'CheckOutController@step1');
Route::get('payment', 'CheckOutController@payment')->name('checkout.payment');
Route::post('store-payment','CheckOutController@storePayment')->name('payment.store');
