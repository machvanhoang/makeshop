<?php

namespace App\Imports;

use App\Models\ProductCategories;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductCategoriesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        $category_code = $row['category_code'];
        $brand_code = $row['brand_code'];
        $singleProduct = Products::select('id')->whereBrandCode($brand_code)->first();
        if (!empty($singleProduct)) {
            $productCategory = ProductCategories::where([
                'category_code'     => $category_code,
                'product_id'    => $singleProduct->id,
            ])->first();
            if (empty($productCategory)) {
                $productCategory =  ProductCategories::create([
                    'category_code'     => $category_code,
                    'product_id'    => $singleProduct->id,
                ]);
            }
            return $productCategory;
        }
        return null;
    }

    public function rules(): array
    {
        return [
            'category_code' => 'required',
            'brand_code' => 'required',
        ];
    }
    public function headingRow(): int
    {
        return 1;
    }
}
