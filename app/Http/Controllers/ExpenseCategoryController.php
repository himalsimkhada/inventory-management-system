<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Session::put('admin_page', 'Expense Category');
        $ecategory = ExpenseCategory::all();
        return view('admin.expenseCategory.index', compact('ecategory'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            $rule = [
                'code' => 'required',
                'name' => 'required|max:255',
            ];
            $customMessage = [
                'code.required' => 'Please Select Expense Category Code.',
                'name.required' => 'Please Enter Expense Category Name.',
            ];
            $this->validate($request, $rule, $customMessage);


                $category = new ExpenseCategory();
                $category->name = $data['name'];
                $category->code = $data['code'];
                $response = $category->save();
                return redirect()->route('expense_category.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = ExpenseCategory::all()->sortByDesc('id');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = ExpenseCategory::where('id', $id)->first();

        return view('admin.expenseCategory.addEdit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = ExpenseCategory::where('id', $id)->delete();

        if ($delete) {
            return redirect()->back();
        } else {
            return redirect();
        }
    }
}
