<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // 🌟 THÊM DÒNG NÀY ĐỂ ÉP MODEL ĐỌC ĐÚNG TÊN BẢNG TRONG DATABASE
    protected $table = 'product_categories';

    protected $fillable = ['name', 'slug', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}