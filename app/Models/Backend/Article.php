<?php

namespace App\Models\Backend;

use App\Jobs\Backend\ArticleLogJob;
use App\Jobs\HomePageCache;
use App\Jobs\OrgSchema;
use App\Models\Backend\User;
use App\Models\StaticPost;
use App\Models\Traits\SeoTrait;
use DOMDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory, SeoTrait;

    protected $fillable = ['title', 'slug', 'summary', 'body', 'image', 'category_id', 'writer_id', 'editor_id', 'published_at', 'status', 'task_status', 'tables', "is_featured","editor_choice"];

    protected $casts = [
        'tables' => 'array',
        'published_at' => 'datetime',
    ];

    protected $hidden = ['body', 'created_at', 'updated_at', 'deleted_at', 'published_at', 'status', 'task_status', 'tables', 'editor_id'];

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

    public function staticPost(){
        return $this->hasOne(StaticPost::class);
    }

    public function articleLog()
    {
        return $this->hasMany(ArticleLog::class);
    }

    public function getDiscussionsAttribute()
    {
        return array_filter(
            $this->articleLog()
                ->whereNotNull('discussion')
                ->select('article_id', 'id', 'discussion')
                ->get()
                ->pluck('discussion')
                ->toArray() ?? [],
        );
    }

    public function readMore()
    {
        return null;
    }

    public function linkableArticles($search = null)
    {
        $keyword = str_word_count($this->title) < 2 ? $this->title : $this->seo->meta_keywords;
        $url = url('/') . '/';
        $articles = Article::where('task_status', 'published')
            ->where('status', 1)
            ->where('id', '!=', $this->id)
            ->select(DB::raw("title , CONCAT('$url',slug) as value , image"));
        if ($search) {
            $articles->where('title', 'like', "%$search%")->get();
        } else {
            $articles->where('title', 'like', '%' . $keyword . '%');
        }
        return $articles->get();
    }

    public function getIncomingLinkAttribute()
    {
        return Article::where('body', 'like', '%' . route('singleArticle', $this->slug) . '%')
            ->where('id', '!=', $this->id)
            ->count() ?? 0;
    }

    public function getOutgoingLinkAttribute()
    {
        $match = [];
        preg_match_all('/<a [^>]*href="(.+)"/', $this->body, $match);
        if ($match && isset($match[1])) {
            return count(
                array_filter($match[1], function ($item) {
                    return strpos($item, 'news-portal.test') ? $item : null;
                }),
            );
        }
        return 0;
    }

    public function more()
    {
        return Article::whereNot('id', $this->id)
            ->limit(8)
            ->get();
    }

    public function youMayAlsoLike()
    {
        return Article::whereNot('id', $this->id)
            ->limit(8)
            ->get();
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            HomePageCache::dispatchAfterResponse();
            OrgSchema::dispatchAfterResponse($model);
            if($model->task_status == "published"){
                $model->staticPost()->updateOrCreate([
                    "slug" => $model->slug,
                    "body" => view("frontend.pages.article.components.content", ["article"=> $model])->render()
                ]);
            }
        });
        static::updated(function ($model) {
            HomePageCache::dispatchAfterResponse();
            OrgSchema::dispatchAfterResponse($model);
        });
    }

    public function scopeActiveAndPublish(Builder $q){
        return $q->where('task_status','published')->where('status',1)->orderBy('published_at','desc');
    }
}
