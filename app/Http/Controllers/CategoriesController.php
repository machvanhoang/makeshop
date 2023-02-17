<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoriesRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * CategoriesController function
     *
     * @param CategoriesRepository $categoriesRepository
     */
    protected $categoriesRepository;
    public function __construct(
        CategoriesRepository $categoriesRepository
    ) {
        $this->categoriesRepository = $categoriesRepository;
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword ?? "";
        $orderBy = $request->orderBy ?? "NONE";
        $categories = $this->categoriesRepository->search($keyword, $orderBy);
        return view(
            'categories.index',
            compact('categories', 'keyword', 'orderBy')
        );
    }
}
