<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class ProductCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_code',
        'category_id',
        'product_id'
    ];
    public function Category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
}
