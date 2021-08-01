<?php

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

// Admin Login
Route::match(['get', 'post'], '/admin/login', 'AdminLoginController@adminLogin')->name('adminLogin');

// Admin Dashboard
Route::get('/admin/dashboard', 'AdminLoginController@dashboard')->name('adminDashboard');


