<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SearchRepository;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * ProductController function
     *
     * @param SearchRepository $searchRepository
     */
    protected $searchRepository;
    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }
    public function search(Request $request)
    {
        $dataSearch = $request->all();
        $products = $this->searchRepository->search($dataSearch);
        return sendResponse(
            [
                'products' => $products,
            ],
            "Search successfully !!!"
        );
    }
}
