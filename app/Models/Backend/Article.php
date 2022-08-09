<?php

namespace App\Models\Backend;

use App\Jobs\HomePageCache;
use App\Models\Backend\User;
use App\Models\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, SeoTrait;

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
        'tables' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function author()
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


    public function more()
    {
        return Article::whereNot("id", $this->id)->limit(8)->get();
    }

    public function youMayAlsoLike()
    {
        return Article::whereNot("id", $this->id)->limit(8)->get();
    }


    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            HomePageCache::dispatchAfterResponse();
        });
        static::updated(function ($model) {
            HomePageCache::dispatchAfterResponse();
        });
    }
}
