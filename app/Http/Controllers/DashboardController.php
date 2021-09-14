<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Image;
use App\Models\Pos;
use App\Models\PosItems;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller {
    public function index() {
        Session::put('admin_page', 'Dashboard');
        $expense = Expense::all()->sum('amount');
        $sales = Pos::all()->sum('total');
        if ($sales == null) {
            $sales = 1;
        }
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
        $mothlySales = [];
        $monthlyExpense = [];
        $sixMonth = [];
        $date = date('m');
        for ($i = 6; $i >= 1; $i--) {
            $month6 = DateTime::createFromFormat('!m', $date);
            $sales6 = Pos::whereMonth('created_at', $date)->sum('total');
            $expense6 = Expense::whereMonth('created_at', $date)->sum('amount');
            array_push($mothlySales, $sales6);
            array_push($monthlyExpense, $expense6);
            array_push($sixMonth, $month6);
            $date--;
        }
        return view('admin.dashboard', compact('expense', 'sales', 'user', 'profit', 'bestSelling', 'mothlySales', 'monthlyExpense', 'sixMonth'));
    }
}
