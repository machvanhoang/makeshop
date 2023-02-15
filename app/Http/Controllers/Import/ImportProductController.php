<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Imports\ImportProducts;
use App\Http\Controllers\Controller;

class ImportProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            try {
                ini_set('max_execution_time', 36000);
                (new ImportProducts)->import($request->file_excel, null, \Maatwebsite\Excel\Excel::CSV);
                return redirect()->route('import.product')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                return redirect()->route('import.index')->with('_alert_failures', $failures);
            }
        }
        return view('import.product');
    }
}
