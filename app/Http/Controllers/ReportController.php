<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Pos;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller {
    public function saleReport() {
        Session::put('admin_page', 'Sales Report');
        $salesLastWeek = 9;
        $year = 2021; // send data from post method here
        $row = [];
        for($i=1; $i<=12; $i++){
            $d = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            // echo $i . ': ' . $d . '<br>';
            $from = date($year . '-' . $i . '-' . '01');
            $to = date($year . '-' . $i . '-' . $d);
            $quantity = Pos::whereBetween('created_at', [$from, $to])->count();
            $tax = Pos::whereBetween('created_at', [$from, $to])->sum('tax');
            $discount = Pos::whereBetween('created_at', [$from, $to])->sum('discount');
            $total = Pos::whereBetween('created_at', [$from, $to])->sum('total');
            // echo 'quantity: ' . $quantity . '<br>';
            // echo 'tax: ' . $tax . '<br>';
            // echo 'total: ' . $total . '<br>';
            $month = DateTime::createFromFormat('!m', $i);
            $row[] = [
                'month' => $month->format('F'),
                'quantity' => $quantity,
                'tax' => $tax,
                'discount' => $discount,
                'remaining' => '',
                'total' => $total,
            ];
            // echo $month->format('F');
            // echo "------------<br>";
        }
        // die;
        return view('admin.reports.salesReports.sales-report', compact('row'));
    }

    public function expenseReport() {
        Session::put('admin_page', 'Expenses Report');

        // $expenseReport = Expense::where('created_at', '<', date('Y-m-d H:i:s'))->count();
        $expenseReport = Expense::where('created_at', '<', now()->toDateTimeString())->get();
        // dd(now()->toDateTimeString());

        return view('admin.reports.expenses-report', compact('expenseReport'));
    }
    // for weekly sales report
    public function weeklySalesReport() {
    }
}
