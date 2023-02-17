<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use App\Models\Categories;

HeadingRowFormatter::default('none');

class ImportCategories implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        $data = [];
        $data['category_code'] = $row['カテゴリー識別コード'];
        $data['name'] = $row['カテゴリー名'];
        $data['path'] = $row['親カテゴリーパス'];
        $singleCategory = Categories::select('id')->whereCategoryCode($data['category_code'])->first();
        if (empty($singleCategory)) {
            $singleCategory =  Categories::create([
                'category_code'     => $data['category_code'],
                'name'    => $data['name'],
                'path'    => $data['path'],
            ]);
        } else {
            $singleCategory->category_code = $data['category_code'];
            $singleCategory->name = $data['name'];
            $singleCategory->path = $data['path'];
            $singleCategory->save();
        }
        return $singleCategory;
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
