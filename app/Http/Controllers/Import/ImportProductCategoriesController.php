<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ImportProductCategories;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImportProductCategoriesController extends Controller
{
    /**
     * Summary of index
     *
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function index(Request $request)
    {
        if ('POST' === $request->getMethod()) {
            try {
                ini_set('max_execution_time', 720000);
                (new ImportProductCategories)->import($request->file_excel, null, \Maatwebsite\Excel\Excel::XLSX);
                return redirect()->route('import.product-category')->with('_alert_total', __('ユーザーが正常にインポートされました'));
            } catch (\Exception $e) {
                return redirect()->route('import.product-category')->with('_alert_failures', $e->getMessage());
            }
        }
        return view('import.product-category');
    }
}
