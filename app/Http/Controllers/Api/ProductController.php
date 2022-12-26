<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $products  = Products::paginate(52);
        return sendResponse(
            [
                'products' => $products
            ],
            "Search successfully !!!"
        );
    }
}
