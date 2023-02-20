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
            try {
                $import = Excel::import(new ProductCategoriesImport, $request->file_excel);
                return redirect()->route('import.index')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                return redirect()->route('import.index')->with('_alert_failures', $failures);
            }
        }
        return view('import.category');
    }
}
