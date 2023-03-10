<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductCategories;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'breadcrumb',
        'brand_code_format',
        'brand_code',
        'ubrand_code',
        'name',
        'price',
        'price_buy',
        'weight',
        'vendor',
        'origin',
        'point',
        'stock',
        'image_big',
        'image_small',
        'is_display',
        'price_tax'
    ];
    public function ProductCategories()
    {
        return $this->hasMany(ProductCategories::class, 'product_id', 'id');
    }
}
