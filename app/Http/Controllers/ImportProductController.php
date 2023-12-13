<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductImport;

class ImportProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            ini_set('max_execution_time', 36000);
            try {
                $import = (new ProductImport)->import($request->file_excel, null, \Maatwebsite\Excel\Excel::XLSX);
                return redirect()->route('import_product.index')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                return redirect()->route('import.index')->with('_alert_failures', $failures);
            }
        }
        return view('import.product');
    }
}
