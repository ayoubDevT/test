<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RegistrationsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'import' => 'required',
        ]);

        Excel::import(new RegistrationsImport, request()->file('import'));
        
        return back()->with('success', 'setted');
        
    }
}
