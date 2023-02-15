<?php

namespace App\Imports;

use App\Models\ProductCategories;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class ImportCategories implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        $data = [];
        $data['category_code'] = $row['カテゴリー識別コード'];
        $data['brand_code_format'] = (int)$row['システム商品コード'];
        $singleProduct = Products::select('id')->whereBrandCodeFormat($data['brand_code_format'])->first();
        if (!empty($singleProduct)) {
            $productCategory = ProductCategories::where([
                'category_code'     => $data['category_code'],
                'product_id'    => $singleProduct->id,
            ])->first();
            if (empty($productCategory)) {
                $productCategory =  ProductCategories::create([
                    'category_code'     => $data['category_code'],
                    'product_id'    => $singleProduct->id,
                ]);
            }
            return $productCategory;
        }
        return null;
    }

    public function rules(): array
    {
        return [];
    }
    public function headingRow(): int
    {
        return 1;
    }
}
