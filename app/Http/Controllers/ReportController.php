<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function saleReport()
    {
        Session::put('admin_page', 'Sales Report');

        $salesLastWeek = Pos::select('created_at')
        ->where('created_at', '>', now()->subWeek()->startOfWeek())
        ->where('created_at', '<', now()->subWeek()->endOfWeek())
        ->get();


        return view('admin.reports.sales-report', compact('salesLastWeek'));
    }

    public function expenseReport()
    {
        Session::put('admin_page', 'Expenses Report');

        return view('admin.reports.expenses-report');
    }
    // for weekly sales report
    public function weeklySalesReport()
    {

    }
}
