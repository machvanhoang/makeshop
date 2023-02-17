<?php

namespace App\Http\Repositories;

use App\Models\Categories;

class CategoriesRepository
{
    public const PAGINATE = 100;
    public function search($keyword = '', $orderBy = 'DESC')
    {
        $categories = Categories::select('*');
        if ($keyword != '') {
            $categories->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('category_code', 'LIKE', '%' . $keyword . '%');
        }
        if ($orderBy != 'NONE') {
            $categories->orderBy('id', $orderBy);
        }
        $categories = $categories->paginate(self::PAGINATE);
        return $categories;
    }
}
