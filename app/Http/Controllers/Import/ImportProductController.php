<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ImportProducts;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    /**
     * Summary of index
     *
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function index(Request $request)
    {
        if ('POST' === $request->getMethod()) {
            try {
            ini_set('max_execution_time', 36000);
            Excel::import(new ImportProducts, $request->file('file_excel'), null, \Maatwebsite\Excel\Excel::XLSX);

            return redirect()->route('import.product')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Exception $e) {
                return redirect()->route('import.product')->with('_alert_failures', $e->getMessage());
            }
        }

        return view('import.product');
    }
}
