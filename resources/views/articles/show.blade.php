<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $article['title'] }}</title> 
    <style> 
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; } 
        .meta { color: #888; font-size: 14px; border-bottom: 1px solid #eee; padding-bottom: 12px; } 
    </style> 
</head>
<body> 
    <a href="{{ route('articles.index') }}">← Quay lại danh sách</a>
    <br><br>

    <h1>{{ $article['title'] }}</h1> 
    <p class="meta"> 
        ✍ Tác giả: {{ $article['author'] }}  •  📅 {{ $article['date'] }}     
    </p> 

    <div style="margin-top: 24px; line-height: 1.8;"> 
        <p>{{ $article['content'] ?? 'Nội dung đang được cập nhật...' }}</p> 
    </div> 

    <div style="margin-top: 32px;"> 
        <a href="{{ route('articles.edit', $article['id']) }}">✏ Chỉnh sửa</a> 
        &nbsp;&nbsp;|&nbsp;&nbsp; 
        <a href="{{ route('articles.index') }}">📋 Danh sách</a>    
    </div> 
</body> 
</html>