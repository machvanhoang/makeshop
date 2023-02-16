<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController function
     *
     * @param ProductRepository $productRepository
     */
    protected $productRepository;
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword ?? "";
        $orderBy = $request->orderBy ?? "NONE";
        $products = $this->productRepository->search($keyword, $orderBy);
        return view(
            'product.index',
            compact('products', 'keyword', 'orderBy')
        );
    }
}
