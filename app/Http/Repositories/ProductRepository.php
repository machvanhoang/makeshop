<?php

namespace App\Http\Repositories;

use App\Models\Products;

class ProductRepository
{
    public const PAGINATE = 52;
    public function search($keyword = '', $orderBy = 'DESC')
    {
        $products = Products::with('categories');
        $products->where('is_display', '!=', 'N');
        if ($keyword != '') {
            $products->where('name', 'LIKE', '%' . $keyword . '%');
        }
        if ($orderBy != 'NONE') {
            $products->orderBy('id', $orderBy);
        }
        $products = $products->paginate(self::PAGINATE);
        return $products;
    }
}
