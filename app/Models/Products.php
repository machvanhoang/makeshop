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
        'product_id',
        'brand_code',
        'ubrand_code',
        'is_display',
        'is_member_only',
        'product_name',
        'product_page_url',
        'weight',
        'price',
        'price_tax',
        'consumption_tax_rate',
        'jancode',
        'vendor',
        'origin',
        'stock',
        'is_diplay_stock',
        'zoom_image_url',
    ];
    public function categories(){
        return $this->hasMany(ProductCategories::class,'product_id','id')->select(['id','category_code']);
    }
}
