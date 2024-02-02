<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SearchRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * ProductController function
     *
     * @param SearchRepository $searchRepository
     */
    protected $searchRepository;

    /**
     * Summary of __construct
     *
     * @param SearchRepository $searchRepository
     */
    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    /**
     * Summary of search
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $dataSearch = $request->all();
        $products = $this->searchRepository->search($dataSearch);
        return sendResponse(
            $products,
            'Search successfully !!!'
        );
    }
}
