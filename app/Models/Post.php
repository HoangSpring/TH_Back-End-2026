<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tên bảng trong database (mặc định Laravel sẽ hiểu là số nhiều 'posts')
    protected $table = 'posts';


    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];
}