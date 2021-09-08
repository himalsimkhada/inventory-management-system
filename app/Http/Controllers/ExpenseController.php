<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExpenseController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        Session::put('admin_page', 'Expense');

        $expense = Expense::all();

        return view('admin.expense.index', compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        Session::put('admin_page', 'Add Expense');
        $warehouse = WareHouse::all();
        $categories = ExpenseCategory::all();
        $accounts = Account::all();

        return view('admin.expense.addEdit', compact(['warehouse', 'categories', 'accounts']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();

        $expense = new Expense();
        $expense->amount = $data['amount'];
        $expense->account_id = $data['account_id'];
        $expense->note = $data['note'];
        $expense->expense_category_id = $data['expense_category_id'];
        $expense->warehouse_id = $data['warehouse_id'];
        $random = rand(1, 10);
        $expense->reference_number = $random;
        $expense->save();

        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        dd('working');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $expense = Expense::with(['warehouse', 'expense_category', 'account'])->where('id', $id)->first();
        $warehouse = WareHouse::all();
        $categories = ExpenseCategory::all();
        $accounts = Account::all();

        return view('admin.expense.addEdit', compact(['expense', 'warehouse', 'categories', 'accounts']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->all();

        $expense = Expense::findorfail($id);
        $expense->amount = $data['amount'];
        $expense->account_id = $data['account_id'];
        $expense->note = $data['note'];
        $expense->expense_category_id = $data['expense_category_id'];
        $expense->warehouse_id = $data['warehouse_id'];
        $random = rand(1, 10);
        $expense->reference_number = $random;
        $expense->save();

        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // dd('working');
        $delete = Expense::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        } else {
            dd('Error');
        }
    }
}
