<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SearchController extends Controller
{
    /**
     * Summary of search
     *
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request){
        return view('search');
    }
}
