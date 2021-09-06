<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AlterEnvController;
use App\Http\Controllers\SovitController;
use Illuminate\Support\Facades\Route;



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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->group(function () {
    // Admin Login
    Route::match(['get', 'post'], '/login', 'AdminLoginController@adminLogin')->name('adminLogin');

    Route::group(['middleware' => 'admin'], function () {
        // Admin Dashboard
        Route::get('/dashboard', 'AdminLoginController@dashboard')->name('adminDashboard');
        // Admin Profile
        Route::get('/profile', 'AdminProfileController@profile')->name('profile');
        // Admin Profile Update
        Route::post('/profile/update/{id}', 'AdminProfileController@profileUpdate')->name('profileUpdate');
        // Admin Password Change
        Route::match(['get', 'post'], '/changePassword/', 'AdminProfileController@changePassword')->name('changePassword');
        // Admin Check Password
        Route::post('/profile/check_password', 'AdminProfileController@checkPassword')->name('checkUserPassword');
        //Admin Theme Settings
        Route::match(['get', 'post'], '/theme/setting', 'AdminProfileController@themeSetting')->name('themeSetting');
        //Admin Mail Settings
        Route::match(['get', 'post'], '/mail/setting', 'AlterEnvController@caller')->name('mailSetting');

        // Category
        Route::get('/category/view', 'CategoryController@index')->name('category.index');
        Route::match(['get', 'post'], '/category/get', 'CategoryController@get')->name('category.get');
        Route::post('/category/store', 'CategoryController@store')->name('category.store');
        Route::post('/category/destroy', 'CategoryController@destroy')->name('category.destroy');

        // Brand
        Route::get('/brand/view', 'BrandController@index')->name('brand.index');
        Route::match(['get', 'post'], '/brand/get', 'BrandController@get')->name('brand.get');
        Route::post('/brand/store', 'BrandController@store')->name('brand.store');
        Route::post('brand/destroy', 'BrandController@destroy')->name('brand.destroy');

        //unit
        Route::get('/unit/view', 'UnitController@index')->name('unit.index');
        Route::match(['get', 'post'], '/unit/get', 'UnitController@get')->name('unit.get');
        Route::post('/unit/store', 'UnitController@store')->name('unit.store');
        Route::post('/unit/destroy', 'UnitController@destroy')->name('unit.destroy');

        // Ware House
        Route::get('/warehouse/view', 'WareHouseController@index')->name('wareHouse.index');
        Route::match(['get', 'post'], '/warehouse/get', 'WareHouseController@get')->name('wareHouse.get');
        Route::post('/warehouse/store', 'WareHouseController@store')->name('wareHouse.store');
        Route::post('/warehouse/destroy', 'WareHouseController@destroy')->name('wareHouse.destroy');

        //Product
        Route::get('/product/view', 'ProductController@index')->name('product.index');
        Route::get('/product/get/', 'ProductController@get')->name('product.get');
        Route::get('/product/get/{id}', 'ProductController@get')->name('product.edit');
        Route::post('/product/destroy', 'ProductController@destroy')->name('product.destroy');
        Route::get('/product/add', 'ProductController@add')->name('product.add');
        Route::post('/product/store', 'ProductController@store')->name('product.store');
        Route::post('/product/images', 'ProductController@image')->name('product.images');
        Route::post('/product/image/remove', 'ProductController@removeImage')->name('product.image.remove');
        Route::post('/product/detail/', 'ProductController@detail')->name('product.detail');
        Route::get('/product/detail/{id}', 'ProductController@detail')->name('product.detail2');

        // Barcode
        Route::get('/barcode', 'BarcodeController@index')->name('barcode.index');
        Route::post('/product/search', 'ProductController@productSearch')->name('product.search');
        Route::post('/product/sku/search', 'ProductController@skuSearch')->name('product.sku.search');
        Route::post('/barcode/get', 'BarcodeController@get')->name('barcode.get');

        // POS
        Route::get('/pos', 'PosController@index')->name('pos.index');
        Route::post('/pos/category/get', 'PosController@categoryGet')->name('pos.category.get');
        Route::post('/pos/brand/get', 'PosController@brandGet')->name('pos.brand.get');
        Route::post('/pos/barcode', 'PosController@barcode')->name('pos.barcode');
        Route::post('/pos/store', 'PosController@store')->name('pos.store');

        // sales routes
        Route::get('/sales','SalesController@index')->name('sales.index');
        Route::get('/sales/saleslist', 'SalesController@get')->name('sales.get');

        //Product Attribute
        Route::get('/product/{id}/view', 'ProductAttributeController@index')->name('product.attr.index');
        Route::match(['get', 'post'], '/product/{id}/get', 'ProductAttributeController@get')->name('product.attr.get');
        Route::post('/product/attributes/store', 'ProductAttributeController@store')->name('product.attr.store');
        Route::post('/product/attribute/destroy', 'ProductAttributeController@destroy')->name('product.attr.destroy');

        //CKEditor
        Route::post('ckeditor', 'CkeditorFileUploadController@store')->name('ckeditor.store');

        //Dropzone
        Route::post('/image', 'ImageController@store')->name('product.image');
        Route::post('/product/image/destroy', 'ImageController@destroy')->name('image.destroy');

        // customers
        Route::get('/customer/index', 'CustomerController@index')->name('customer.index');
        Route::get('/customer/get/', 'CustomerController@get')->name('customer.get');
        Route::get('/customer/add', 'CustomerController@addedit')->name('customer.add');
        Route::get('/customer/edit/{id}', 'CustomerController@addEdit')->name('customer.edit');
        Route::post('/customer/store', 'CustomerController@store')->name('customer.store');

        Route::get('/customer/delete/{id}', 'CustomerController@destroy')->name('customer.destroy');

        //customer group
        Route::get('/group/index', 'CustomerGroupController@index')->name('group.index');
        Route::match(['get', 'post'], '/group/get', 'CustomerGroupController@get')->name('group.get');
        Route::post('/group/store', 'CustomerGroupController@store')->name('group.store');
        Route::get('/group/destroy/{id}', 'CustomerGroupController@destroy')->name('group.destroy');

    });

    // logout
    Route::get('/logout', 'AdminLoginController@adminLogout')->name('adminLogout');

    // qwe
    Route::get('/qwe', 'AdminProfileController@qwe')->name('qwe');

    // Forget Password
    Route::match(['get', 'post'], '/forget-password', 'AdminLoginController@forgetPassword')->name('forgetPassword');
});
