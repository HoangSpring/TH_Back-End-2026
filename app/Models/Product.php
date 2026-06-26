<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    // 🌟 Một sản phẩm sẽ THUỘC VỀ một danh mục sản phẩm cụ thể
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}