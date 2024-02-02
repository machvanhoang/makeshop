<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoriesController extends Controller
{
    /**
     * CategoriesController function
     *
     * @param CategoriesRepository $categoriesRepository
     */
    protected $categoriesRepository;

    /**
     * Summary of __construct
     * @param \App\Http\Repositories\CategoriesRepository $categoriesRepository
     */
    public function __construct(
        CategoriesRepository $categoriesRepository
    ) {
        $this->categoriesRepository = $categoriesRepository;
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
        $categories = $this->categoriesRepository->search($keyword, $orderBy);
        return view(
            'categories.index',
            compact('categories', 'keyword', 'orderBy')
        );
    }
}
