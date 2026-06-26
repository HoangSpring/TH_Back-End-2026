<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory; // 🌟 Nhớ import Model danh mục sản phẩm vào
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy tất cả danh mục sản phẩm để đổ vào select box
        $productCategories = ProductCategory::all();

        // 2. Tạo query khởi tạo cho Product kèm theo danh mục của nó
        $query = Product::with('productCategory');

        // Lọc theo từ khóa tìm kiếm (Tên sản phẩm)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo Danh mục sản phẩm
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('product_category_id', $request->category_id);
        }

        // Sắp xếp (Mới nhất hoặc Cũ nhất)
        if ($request->has('sort') && $request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest(); // Mặc định là mới nhất
        }

        // 3. Phân trang kết quả (giữ lại các tham số lọc trên thanh URL khi bấm chuyển trang)
        $products = $query->paginate(9)->withQueryString();

        // 4. Truyền thêm biến $productCategories ra ngoài view
        return view('products.index', compact('products', 'productCategories'));
    }

    public function show($id)
    {
        $product = Product::with('productCategory')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}