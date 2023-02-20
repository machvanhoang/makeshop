<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Imports\ImportProductCategories;
use App\Http\Controllers\Controller;

class ImportProductCategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            try {
                ini_set('max_execution_time', 720000);
                (new ImportProductCategories)->import($request->file_excel, null, \Maatwebsite\Excel\Excel::CSV);
                return redirect()->route('import.category')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                return redirect()->route('import.index')->with('_alert_failures', $failures);
            }
        }
        return view('import.product-category');
    }
}
