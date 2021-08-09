<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AlterEnvController;
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


Route::prefix('/admin')->group(function(){
    // Admin Login
    Route::match(['get', 'post'], '/login', 'AdminLoginController@adminLogin')->name('adminLogin');

    Route::group(['middleware' => 'admin'], function(){
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
        Route::match(['get', 'post'],'/category', 'CategoryController@category',)->name('category');
        Route::match(['get', 'post'], '/getCategory', 'CategoryController@getCategory')->name('getCategory');

        Route::post('/storeCategory', 'CategoryController@category')->name('storeCategory');
        //Admin View Categories
        Route::get('/category/view', 'CategoryController@view')->name('categoryView');

        //Admin Add Category
        Route::match(['get', 'post'], '/category/add', 'CategoryController@create')->name('categoryCreate');
        Route::post('/category/delete', 'CategoryController@destroy')->name('category.destroy');

        // Brand
        Route::get('/brand', 'BrandController@index')->name('brand.index');
        Route::match(['get', 'post'], '/getBrand', 'BrandController@get')->name('brand.get');
        Route::post('storeBrand', 'BrandController@store')->name('brand.store');
        Route::post('destroyBrand', 'BrandController@destroy')->name('brand.destroy');

        // Ware House
        Route::get('/wareHouse', 'WareHouseController@index')->name('wareHouse.index');
        Route::match(['get', 'post'], '/getWareHouse', 'WareHouseController@get')->name('wareHouse.get');
        Route::post('storeWareHouse', 'WareHouseController@store')->name('wareHouse.store');
        Route::post('destroyWareHouse', 'WareHouseController@destroy')->name('wareHouse.destroy');
    });

    // Admin Logout
    Route::get('/logout', 'AdminLoginController@adminLogout')->name('adminLogout');

    Route::get('/qwe', 'AdminProfileController@qwe')->name('qwe');

    // Forget Password
    Route::match(['get', 'post'], '/forget-password', 'AdminLoginController@forgetPassword')->name('forgetPassword');

});
