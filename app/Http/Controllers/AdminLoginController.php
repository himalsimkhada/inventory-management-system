<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    // Admin Login
    public function adminLogin(){
        return view ('admin.auth.login');
    }

    // Admin Dashboard
    public function dashboard(){
        return view ('admin.dashboard');
    }
}
