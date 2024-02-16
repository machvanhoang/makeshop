<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ImportProducts implements ToModel, WithValidation, WithHeadingRow, WithChunkReading
{
    use Importable;
    public function model(array $row)
    {
        $data = [];
        $data['breadcrumb'] = $row['カテゴリー'];
        $data['brand_code'] = str_replace(['="', '"'], "", $row['商品コード']);
        $data['brand_code_format'] = (int) $data['brand_code'];
        $data['ubrand_code'] = str_replace(['="', '"'], "", $row['独自商品コード']);
        $data['name'] = $row["商品名"];
        $data['price'] = !empty($row["販売価格"]) ? $row["販売価格"] : 0;
        $data['price_buy'] = !empty($row["仕入価格"]) ? $row["仕入価格"] : 0;
        $data['weight'] = $row["重量"];
        $data['vendor'] = $row["製造元"];
        $data['origin'] = $row["原産地"];
        $data['point'] = !empty($row["ポイント"]) ? $row["ポイント"] : 0;
        $data['stock'] = $row["数量"];
        $data['image_big'] = $row["拡大画像"];
        $data['image_small'] = $row["普通画像"];
        $data['is_display'] = $row["商品陳列可否"];
        $data['price_tax'] = $data['price'] + $data['price'] * 0.1;
        $singleProduct = Products::withTrashed()->whereBrandCode($data['brand_code'])->first();
        if (empty($singleProduct)) {
            return Products::create($data);
        } else {
            return $this->updateProduct($singleProduct, $data);
        }
    }
    private function updateProduct($product, $item)
    {
        $product->breadcrumb = $item['breadcrumb'];
        $product->brand_code = $item['brand_code'];
        $product->brand_code_format = (int) $item['brand_code'];
        $product->ubrand_code = $item['ubrand_code'];
        $product->name = $item['name'];
        $product->price = $item['price'];
        $product->price_buy = $item['price_buy'];
        $product->weight = !empty($item['weight']) ? $item['weight'] : 0;
        $product->price = !empty($item['price']) ? $item['price'] : 0;
        $product->vendor = $item['vendor'];
        $product->origin = $item['origin'];
        $product->point = $item['point'];
        $product->stock = $item['stock'];
        $product->image_big = $item['image_big'];
        $product->image_small = $item['image_small'];
        $product->is_display = $item['is_display'];
        $product->price_tax = $item['price'] + $item['price'] * 0.1;
        $product->update();
        if ($product->is_display == 'N') {
            $product->delete();
        }
    }

    public function rules(): array
    {
        return [];
    }
    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
