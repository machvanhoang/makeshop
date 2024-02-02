<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController function
     *
     * @param ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * Summary of __construct
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Summary of index
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $orderBy = $request->orderBy ?? 'NONE';
        $products = $this->productRepository->search($keyword, $orderBy);
        return view(
            'product.index',
            compact('products', 'keyword', 'orderBy')
        );
    }
}
