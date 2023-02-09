<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public const MIN_PRICE = 0;
    public const MAX_PRICE = 1000000;
    public const EMPTY     = [];
    public const ALL     = "all";
    public function search(Request $request)
    {
        $dataSearch = $request->all();
        $keyword    = !empty($dataSearch['keyword']) ? htmlspecialchars($dataSearch['keyword']) : null;
        $price_min  = !empty($dataSearch['price_min']) ? (int)$dataSearch['price_min'] : self::MIN_PRICE;
        $price_max  = !empty($dataSearch['price_max']) ? (int)$dataSearch['price_max'] : self::MAX_PRICE;
        $category   = !empty($dataSearch['category']) ? $dataSearch['category'] : self::EMPTY;
        $body       = !empty($dataSearch['body']) ? $dataSearch['body'] : self::EMPTY;
        $size       = !empty($dataSearch['size']) ? $dataSearch['size'] : self::EMPTY;
        $origin     = !empty($dataSearch['origin']) ? htmlspecialchars($dataSearch['origin']) : null;
        $type       = !empty($dataSearch['type']) ? $dataSearch['type'] : self::EMPTY;
        $vintage    = !empty($dataSearch['vintage']) ? $dataSearch['vintage'] : self::EMPTY;
        $ranker     = !empty($dataSearch['ranker']) ? $dataSearch['ranker'] : self::EMPTY;
        //$inventory  = !empty($dataSearch['inventory']) ? htmlspecialchars($dataSearch['inventory']) : self::ALL; // with swich case inventory
        $db = DB::table('products AS p');
        $db->select('p.product_id as product', 'brand_code', 'ubrand_code', 'is_display', 'is_member_only', 'product_name', 'product_page_url', 'weight', 'price', 'price_tax', 'consumption_tax_rate', 'jancode', 'vendor', 'origin', 'stock', 'is_diplay_stock', 'zoom_image_url', 'p.created_at as created_at', 'p.updated_at as updated_at', 'p.deleted_at as deleted_at');
        $db->where('is_display', '=', 'Y');
        $totalCategory = [];
        if (!empty($category)) {
            $totalCategory = array_merge($totalCategory, $category);
        }
        if (!empty($size)) {
            $totalCategory = array_merge($totalCategory, $size);
        }
        if (!is_null($origin)) {
            $totalCategory = array_merge($totalCategory, [$origin]);
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
        // keyword
        if (!is_null($keyword)) {
            $db->where(function ($query) use ($keyword) {
                $query->where('product_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('brand_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('ubrand_code', 'LIKE', '%' . $keyword . '%');
            });
        }
        // totalCategory
        if (!empty($totalCategory)) {
            $db->join('product_categories', function ($join) use ($totalCategory, $body, $category) {
                $andjoin = $join->on('p.id', '=', 'product_categories.product_id');
                $andjoin->whereIn('product_categories.category_code', $body);
                if (!empty($category)) {
                    $andjoin->whereIn('product_categories.category_code', $category);
                }
            });
        }
        // price min and price max
        $db->whereBetween('price_tax', [$price_min, $price_max]);
        $db->whereNull('deleted_at');
        $db->distinct();
        // stock
        $endWhere = $db->where('stock', '>', 0);
        $sql = $endWhere->toSql();
        $products = $endWhere->paginate(52);
        return sendResponse(
            [
                'products' => $products,
                'price_min' => $price_min,
                'price_max' => $price_max,
                'totalCategory' => $totalCategory,
                'body'     => $body,
                'sql'      => $sql
            ],
            "Search successfully !!!"
        );
    }
}
