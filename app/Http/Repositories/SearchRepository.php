<?php

namespace App\Http\Repositories;

use DB;

class SearchRepository
{
    public const MIN_PRICE = 0;
    public const MAX_PRICE = 1000000;
    public const EMPTY     = [];
    public const ALL     = "all";
    public const INVENTORY_SOLD_OUT = 'sold-out';
    public const INVENTORY_STOCKING = 'stocking';
    public const DEFAULT_RANKER = [
        "ct702",
        "ct703",
        "ct704",
        "ct705",
        "ct706",
        "ct934"
    ];
    public const DEFAULT_VINTAGE = [
        "ct686",
        "ct687",
        "ct688"
    ];
    public const DEFAULT_SIZE = [
        "ct690",
        "ct691",
        "ct692"
    ];
    public function search($dataSearch)
    {
        $inventory  = !empty($dataSearch['inventory']) ? htmlspecialchars($dataSearch['inventory']) : self::ALL;
        $keyword    = !empty($dataSearch['keyword']) ? htmlspecialchars($dataSearch['keyword']) : null;
        $price_min  = !empty($dataSearch['price_min']) ? (int)$dataSearch['price_min'] : self::MIN_PRICE;
        $price_max  = !empty($dataSearch['price_max']) ? (int)$dataSearch['price_max'] : self::MAX_PRICE;
        $category   = !empty($dataSearch['category']) ? $dataSearch['category'] : self::EMPTY;
        $body       = !empty($dataSearch['body']) ? $dataSearch['body'] : self::EMPTY;
        $size       = !empty($dataSearch['size']) ? $dataSearch['size'] : self::EMPTY;
        $origin     = !empty($dataSearch['origin']) ? $dataSearch['origin'] : self::EMPTY;
        $type       = !empty($dataSearch['type']) ? $dataSearch['type'] : self::EMPTY;
        $vintage    = !empty($dataSearch['vintage']) ? $dataSearch['vintage'] : self::EMPTY;
        $ranker     = !empty($dataSearch['ranker']) ? $dataSearch['ranker'] : self::EMPTY;
        $totalCategory = [];
        if (!empty($category)) {
            $totalCategory = array_merge($totalCategory, $category);
        }
        if (!empty($size)) {
            $totalCategory = array_merge($totalCategory, $size);
        }
        if (!is_null($origin)) {
            $totalCategory = array_merge($totalCategory, $origin);
        }
        if (!empty($type)) {
            $totalCategory = array_merge($totalCategory, $type);
        }
        if (!empty($vintage)) {
            $totalCategory = array_merge($totalCategory, $vintage);
        }
        if (!empty($ranker)) {
            $totalCategory = array_merge($totalCategory, $ranker);
        }
        if (!empty($body)) {
            $totalCategory = array_merge($totalCategory, $body);
        }
        $db = DB::table('products AS p');
        $db->select('p.id as product', 'brand_code', 'ubrand_code', 'name', 'price', 'price_buy', 'price_tax', 'weight', 'vendor', 'origin', 'point', 'stock', 'image_big', 'image_small', 'is_display', 'p.created_at as created_at', 'p.updated_at as updated_at', 'p.deleted_at as deleted_at');
        $db->where('is_display', '!=', 'N');
        //inventory
        switch ($inventory) {
            case self::INVENTORY_SOLD_OUT:
                $db->where('stock', '<', 1);
                break;
            case self::INVENTORY_STOCKING:
                $db->where('stock', '>', 0);
                break;
            default:
                break;
        }
        // keyword
        if (!is_null($keyword)) {
            $db->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('brand_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('ubrand_code', 'LIKE', '%' . $keyword . '%');
            });
        }
        // join mutiple with category code
        if (!empty($body)) {
            $db->join('product_categories as pc_body', function ($join) use ($body) {
                $andjoin = $join->on('p.id', '=', 'pc_body.product_id');
                $andjoin->whereIn('pc_body.category_code', $body);
            });
        }
        if (!empty($category)) {
            $db->join('product_categories as pc_category', function ($join) use ($category) {
                $andjoin = $join->on('p.id', '=', 'pc_category.product_id');
                $andjoin->WhereIn('pc_category.category_code', $category);
            });
        }
        if (!empty($origin)) {
            $db->join('product_categories as pc_origin', function ($join) use ($origin) {
                $andjoin = $join->on('p.id', '=', 'pc_origin.product_id');
                $andjoin->WhereIn('pc_origin.category_code', $origin);
            });
        }
        if (!empty($type)) {
            $db->join('product_categories as pc_type', function ($join) use ($type) {
                $andjoin = $join->on('p.id', '=', 'pc_type.product_id');
                $andjoin->WhereIn('pc_type.category_code', $type);
            });
        }
        if (!empty($vintage)) {
            $db->join('product_categories as pc_vintage', function ($join) use ($vintage) {
                $andjoin = $join->on('p.id', '=', 'pc_vintage.product_id');
                if ($vintage[0] == self::ALL) {
                    $andjoin->WhereIn('pc_vintage.category_code', self::DEFAULT_VINTAGE);
                } else {
                    $andjoin->WhereIn('pc_vintage.category_code', $vintage);
                }
            });
        }
        if (!empty($ranker)) {
            $db->join('product_categories as pc_ranker', function ($join) use ($ranker) {
                $andjoin = $join->on('p.id', '=', 'pc_ranker.product_id');
                if ($ranker[0] == self::ALL) {
                    $andjoin->WhereIn('pc_ranker.category_code', self::DEFAULT_RANKER);
                } else {
                    $andjoin->WhereIn('pc_ranker.category_code', $ranker);
                }
            });
        }
        if (!empty($size)) {
            $db->join('product_categories as pc_size', function ($join) use ($size) {
                $andjoin = $join->on('p.id', '=', 'pc_size.product_id');
                if ($size[0] == self::ALL) {
                    $andjoin->WhereIn('pc_size.category_code', self::DEFAULT_SIZE);
                } else {
                    $andjoin->WhereIn('pc_size.category_code', $size);
                }
            });
        }
        // price min and price max
        $db->whereBetween('price_tax', [$price_min, $price_max]);
        $db->whereNull('deleted_at');
        $db->distinct();
        $sql = $db->toSql();
        $products = $db->paginate(52);
        return [
            'products' => $products,
            'totalCategory' => $totalCategory,
            'sql' => $sql,
            'body' => $body
        ];
    }
}
