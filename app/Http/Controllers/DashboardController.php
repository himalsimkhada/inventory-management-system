<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Image;
use App\Models\Pos;
use App\Models\PosItems;
use App\Models\User;
use DateTime;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller {
    public function index() {
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
        $tempMonthlySales = [];
        $tempMonthlyExpense = [];
        $tempSixMonth = [];
        $date = date('m');
        for ($i = 6; $i >= 1; $i--) {
            $m6 = DateTime::createFromFormat('!m', $date);
            $s6 = Pos::whereMonth('created_at', $date)->sum('total');
            $e6 = Expense::whereMonth('created_at', $date)->sum('amount');
            array_push($tempMonthlySales, $s6);
            array_push($tempMonthlyExpense, $e6);
            array_push($tempSixMonth, $m6->format('F'));
            $date--;
        }
        $monthlySales = array_reverse($tempMonthlySales);
        $monthlyExpense = array_reverse($tempMonthlyExpense);
        $sixMonth = array_reverse($tempSixMonth);

        // Top 4 new customer
        $newCustomer = Customer::latest()->take(5)->get();

        return view('admin.dashboard', compact('expense', 'sales', 'user', 'profit', 'bestSelling', 'monthlySales', 'monthlyExpense', 'sixMonth', 'newCustomer'));
    }
}
