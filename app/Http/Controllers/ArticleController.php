<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Bước 3: Hiển thị danh sách tất cả bài viết
     */
    public function index()
    {
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel Framework', 'author' => 'Nguyễn Văn A', 'date' => '2024-01-15'],
            ['id' => 2, 'title' => 'Routing trong Laravel – Toàn tập', 'author' => 'Trần Thị B', 'date' => '2024-01-18'],
            ['id' => 3, 'title' => 'Blade Templates – Hướng dẫn chi tiết', 'author' => 'Lê Văn C', 'date' => '2024-01-22'],
            ['id' => 4, 'title' => 'Eloquent ORM – Làm việc với Database', 'author' => 'Phạm Thị D', 'date' => '2024-01-25'],
        ];

        return view('articles.index', compact('articles'));
    }

    /**
     * Bước 5: Hiển thị form tạo bài viết mới
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Bước 4: Hiển thị chi tiết 1 bài viết theo ID
     */
    public function show(string $id)
    {
        $allArticles = [
            1 => [
                'id' => 1, 
                'title' => 'Giới thiệu Laravel Framework', 
                'author' => 'Nguyễn Văn A', 
                'date' => '2024-01-15', 
                'content' => 'abc'
            ],
            2 => [
                'id' => 2, 
                'title' => 'Routing trong Laravel – Toàn tập', 
                'author' => 'Trần Thị B', 
                'date' => '2024-01-18', 
                'content' => 'abc'
            ],
        ];

        // Kiểm tra nếu ID không tồn tại trong mảng dữ liệu giả lập
        if (!isset($allArticles[$id])) {
            abort(404, 'Bài viết không tồn tại');
        }

        $article = $allArticles[$id];
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'Chức năng edit bài viết ' . $id . ' sẽ cập nhật ở Lab sau.';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}