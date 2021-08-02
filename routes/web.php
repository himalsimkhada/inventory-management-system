<?php

use App\Http\Controllers\AdminLoginController;
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
<<<<<<< HEAD
        Route::match(['get', 'post'], '/changePassword/', 'AdminProfileController@changePassword')->name('changePassword');
=======

        Route::match(['get', 'post'], '/profile/password/change', 'AdminProfileController@passwordChange')->name('passwordChange');
        Route::match(['get', 'post'], '/changePassword/', 'AdminProfileController@changePassword')->name('changePassword');
        ROute::post('/profile/check_password', 'AdminProfileController@checkPassword')->name('checkUserPassword');
>>>>>>> 585632d34d1dfd822f142826649403cd53594a99

    });

    // Admin Logout
    Route::get('/logout', 'AdminLoginController@adminLogout')->name('adminLogout');

    Route::get('/qwe', 'AdminProfileController@qwe')->name('qwe');
   
});
