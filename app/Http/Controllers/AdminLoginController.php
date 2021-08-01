<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    // Admin Login
    public function adminLogin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rule = [
               'email' => 'required|email|max:255',
               'password' => 'required'
            ];
            $customMessage = [
              'email.required' => 'Please Enter E-Mail Address',
              'email.email' => 'Please Enter a Valid E-Mail Address',
              'email.max' => 'You are not allowed to enter more than 255 characters',
              'password.required' => 'Please Enter Password'
            ];
            $this->validate($request, $rule, $customMessage);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect()->route('adminDashboard');
            } else {
                Session::flash('error_message', 'Invalid Username or Password');
                return redirect()->route('adminLogin');
            }
        }
           if (Auth::guard('admin')->check()){
               return redirect()->route('adminDashboard');
           } else {
               return view ('admin.auth.login');
           }
    }

    // Admin Dashboard
    public function dashboard(){
        return view ('admin.dashboard');
    }

    // Admin Logout
    public function adminLogout(){
        Auth::guard('admin')->logout();
        Session::flash('info_message', 'Logout Successfull');
        return redirect()->route('adminLogin');
    }

    public function changePassword(){
        return view('admin.changePassword');
    }
}
