<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Expense;
use App\Models\Image;
use App\Models\Pos;
use App\Models\PosItems;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminLoginController extends Controller {
    // Admin Login
    public function adminLogin(Request $request) {
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
    public function dashboard() {
        Session::put('admin_page', 'Dashboard');
        $expense = Expense::all()->sum('amount');
        $sales = Pos::all()->sum('total');
        $user = User::all()->sum('total');
        $profit = $sales - $expense;
        $bestSelling = [];
        $top5 = PosItems::select('pos_items.product_id', 'products.name', 'products.price', DB::raw('SUM(pos_items.quantity) as qty'))
            ->join('products', 'products.id', '=', 'pos_items.product_id')
            ->groupBy('pos_items.product_id')
            ->orderBy('qty', 'DESC')
            ->limit(5)
            ->get();
        foreach ($top5 as $value) {
            $image = Image::where('product_id', $value->product_id)->first();
            $bestSelling[] = [
                'name' => $value->name,
                'price' => $value->price,
                'image' => $image,
            ];
        }
        $sixMonthData = [];
        $date = date('m');
        for ($i = 6; $i >= 1; $i--) {
            $month = DateTime::createFromFormat('!m', $date);
            $monthlySales = Pos::whereMonth('created_at', $date)->sum('total');
            $monthlyExpense = Expense::whereMonth('created_at', $date)->sum('amount');
            $sixMonthData[] = [
                'mothlySales' => $monthlySales,
                'monthlyExpense' => $monthlyExpense,
                'month' => $month->format('F'),
                // 'expense' => $value->price,
                // 'sales' => 1,
            ];
            $date--;
        }
        // die;
        // dd($bestSelling);
        return view('admin.dashboard', compact('expense', 'sales', 'user', 'profit', 'bestSelling'));
    }
    // Admin Logout
    public function adminLogout() {
        Auth::guard('admin')->logout();
        Session::flash('info_message', 'Logout Successfull');
        return redirect()->route('adminLogin');
    }

    // Forget Password
    public function forgetPassword(Request $request) {
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
