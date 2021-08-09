<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function index()
    {
        Session::put('unit_page', 'unit');

        return view('admin.unit.index');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['id'] == null) {
                $unit = new Unit();
                $unit->name
            }
        }
    }
}
