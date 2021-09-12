<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function saleReport()
    {
        Session::put('admin_page', 'Sales Report');

        return view('admin.reports.sales-report');
    }

    public function expenseReport()
    {
        Session::put('admin_page', 'Expenses Report');

        $expenseReport = Expense::where('created_at', date('Y-m-d'))->count();

        return view('admin.reports.expenses-report', compact('expenseReport'));
    }
}
