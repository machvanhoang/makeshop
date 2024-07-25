<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ImportProductCategories;
use App\Imports\ImportProducts;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
        return view('import.product');
    }

    /**
     * Summary of import
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request)
    {
        try {
            ini_set('max_execution_time', 720000);
            Excel::import(new ImportProducts, $request->file('file_excel'),  null, \Maatwebsite\Excel\Excel::XLSX);

            return response()->json([
                'status' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
