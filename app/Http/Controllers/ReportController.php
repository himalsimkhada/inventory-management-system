<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Pos;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller {
    public function saleYearlyReport(Request $request) {
        Session::put('admin_page', 'Sales Report Yearly');
        $year = $request->input('year');
        if ($year == null) {
            $year = date('Y');
        }
        $row = [];
        for ($i = 1; $i <= 12; $i++) {
            $d = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            $from = date($year . '-' . $i . '-' . '01');
            $to = date($year . '-' . $i . '-' . $d);
            $quantity = Pos::whereBetween('created_at', [$from, $to])->count();
            $tax = Pos::whereBetween('created_at', [$from, $to])->sum('tax');
            $discount = Pos::whereBetween('created_at', [$from, $to])->sum('discount');
            $total = Pos::whereBetween('created_at', [$from, $to])->sum('total');
            $month = DateTime::createFromFormat('!m', $i);
            $row[] = [
                'month' => $month->format('F'),
                'quantity' => $quantity,
                'tax' => $tax,
                'discount' => $discount,
                'remaining' => '',
                'total' => $total,
            ];
        }
        return view('admin.reports.salesReports.sales-report-yearly', compact(['row', 'year']));
    }

    public function salesMonthlyReport(Request $request) {
        Session::put('admin_page', 'Sales Report Monthly');

        $year = $request->input('year');
        $month = $request->input('month');

        if ($year == null && $month == null) {
            $year = date('Y');
            $month = date('m');
        }

        return view('admin.reports.salesReports.sales-report-monthly', compact(['year', 'month']));
    }

    public function salesDailyReport(Request $request) {
        Session::put('admin_page', 'Sales Report Daily');

        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');

        if ($year == null && $month == null && $day == null) {
            $year = date('Y');
            $year = date('m');
            $year = date('d');
        }

        return view('admin.reports.salesReports.sales-report-daily', compact(['year', 'month', 'day']));
    }

    public function expenseYearlyReport(Request $request) {
        Session::put('admin_page', 'Expenses Report Yearly');
        $year = $request->input('date');
        if ($year == null) {
            $year = 2021;
        }

        // send data from post method here
        $row = [];
        for ($i = 1; $i <= 12; $i++) {
            $d = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            // echo $i . ': ' . $d . '<br>';
            $from = date($year . '-' . $i . '-' . '01');
            $to = date($year . '-' . $i . '-' . $d);
            $quantity = Expense::whereBetween('created_at', [$from, $to])->count();
            $amount = Expense::whereBetween('created_at', [$from, $to])->sum('amount');
            $month = DateTime::createFromFormat('!m', $i);
            $row[] = [
                'month' => $month->format('F'),
                'quantity' => $quantity,
                'amount' => $amount,
            ];
        }

        return view('admin.reports.expensesReports.expenses-report-yearly', compact(['row', 'year']));
    }

    public function expensesMonthlyReport(Request $request) {
        Session::put('admin_page', 'Expenses Report Monthly');

        $year = $request->input('year');
        $month = $request->input('month');

        if ($year == null && $month == null) {
            $year = date('Y');
            $month = date('m');
        }

        return view('admin.reports.expensesReports.expenses-report-monthly', compact(['year', 'month']));
    }

    public function expensesDailyReport(Request $request) {
        Session::put('admin_page', 'Expenses Report Daily');

        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');

        if ($year == null && $month == null && $day == null) {
            $year = date('Y');
            $year = date('m');
            $year = date('d');
        }

        return view('admin.reports.expensesReports.expenses-report-daily', compact(['year', 'month', 'day']));
    }
}
