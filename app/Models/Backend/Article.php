<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'image',
        'category_id',
        'writer_id',
        'editor_id',
        'published_at',
        'status',
        'task_status',
        'tables',
    ];

    protected $casts = [
        'tables' => 'json',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class);
    }
}
