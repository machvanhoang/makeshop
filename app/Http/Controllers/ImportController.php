<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductCategoriesImport;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            Excel::import(new ProductCategoriesImport, $request->file_excel);
            return redirect()->route('import.index')->with('success', 'User Imported Successfully');
        }
        return view('import');
    }
}
