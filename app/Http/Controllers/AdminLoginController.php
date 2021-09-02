<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

class AdminLoginController extends Controller
{
    // Admin Login
    public function adminLogin(Request $request)
    {
        if ($request->isMethod('post')) {
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

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('adminDashboard');
            } else {
                Session::flash('error_message', 'Invalid Username or Password');
                return redirect()->route('adminLogin');
            }
        }
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminDashboard');
        } else {
            return view('admin.auth.login');
        }
    }

    // Admin Dashboard
    public function dashboard()
    {
        Session::put('admin_page', 'Dashboard');
        return view('admin.dashboard');
    }

    // Admin Logout
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        Session::flash('info_message', 'Logout Successfull');
        return redirect()->route('adminLogin');
    }

    // Forget Password
    public function forgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validateData = $request->validate([
                'email' => 'required|email',
            ]);
            $adminCount = Admin::where('email', $data['email'])->count();
            if ($adminCount == 0) {
                return redirect()->back()->with('error_message', 'email doesnot exist in our database');
            }
            $adminDetail = Admin::where('email', $data['email'])->first();

            // Generate Password
            $randomPassword = str::random(10);
            $newPassword = bcrypt($randomPassword);
            Admin::where('email', $data['email'])->update(['password' => $newPassword]);

            // Send Mail
            $email = $data['email'];
            $name = $adminDetail->name;
            $messageData = ['email' => $email, 'password' => $randomPassword, 'name' => $name];
            Mail::send('email.forgetPassword', $messageData, function ($message) use ($email) {
                $message->from($email)->to($email)->subject('New Password');
            });
            return redirect('admin/login')->with('info_message', 'Check you email for Updated Password');
        }
        return view('admin.auth.forget');
    }
}
