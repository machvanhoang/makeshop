<?php

namespace App\Imports;

use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;


class ImportProductCategories implements ToCollection, WithValidation
{
    use Importable;

    public function collection(Collection $collection)
    {
        $data = [];
        $dataImport = [];
        foreach ($collection->forget(0) as $row) {
            $data['category_code'] = $row[2];
            $data['brand_code_format'] = $row[4];
            $singleProduct = Products::select('id')->whereBrandCodeFormat($data['brand_code_format'])->first();
            $singleCategory = Categories::select('id')->whereCategoryCode($data['category_code'])->first();

            if (! empty($singleProduct) && ! empty($singleCategory)) {
                $productCategory = ProductCategories::where([
                    'category_id' => $singleCategory->id,
                    'product_id' => $singleProduct->id,
                ])->first();
                if (empty($productCategory)) {
                    $dataImport[] = [
                        'category_code' => $data['category_code'],
                        'category_id' => $singleCategory->id,
                        'product_id' => $singleProduct->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('product_categories')->insert($dataImport);

        return null;
    }

    public function rules(): array
    {
        return [];
    }
}
