<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo bài viết mới</title>
    <style> 
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; } 
        input, textarea { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; } 
        label { font-weight: bold; display: block; margin-top: 16px; } 
        button { margin-top: 20px; padding: 10px 24px; background: #2E75B6; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; } 
        button:hover { background: #1B548C; }
    </style> 
</head>
<body>
    <h1>✍ Tạo bài viết mới</h1>
    
    <form action="#" method="POST"> 
        @csrf 
        <label>Tiêu đề</label>
        <input type="text" name="title" placeholder="Nhập tiêu đề bài viết">
 
        <label>Tác giả</label>
        <input type="text" name="author" placeholder="Tên tác giả">
 
        <label>Nội dung</label>
        <textarea name="content" rows="8" placeholder="Viết nội dung..."></textarea> 
 
        <button type="submit">Đăng bài</button> 
    </form>
    <br>
    <a href="{{ route('articles.index') }}">← Quay lại danh sách</a>
</body>
</html>