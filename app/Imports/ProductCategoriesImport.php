<?php

namespace App\Imports;

use App\Models\ProductCategories;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;

class ProductCategoriesImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProductCategories([
            "category_code" => $row['category_code'],
            'updated_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            "product_id" => $row['product_id']
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }
}
