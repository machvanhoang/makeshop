<?php

namespace App\Http\Repositories;

use App\Models\Products;

class ProductRepository
{
    public const PAGINATE = 52;
    public function search($keyword = '', $orderBy = 'DESC')
    {
        $products = Products::with(['ProductCategories' => function ($query) {
            $query = $query->with('Category');
            return $query;
        }]);
        $products->where('is_display', '!=', 'N');
        if ($keyword != '') {
            $products->where(function ($q) use($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('price', $keyword);
            });
        }
        if ($orderBy != 'NONE') {
            $products->orderBy('id', $orderBy);
        }
        $products = $products->paginate(self::PAGINATE);
        return $products;
    }
}
