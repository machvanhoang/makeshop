<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\ImportProductCategories;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductCategoriesController extends Controller
{
    /**
     * Summary of index
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('import.product-category');
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
            Excel::import(new ImportProductCategories, $request->file('file_excel'));

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
