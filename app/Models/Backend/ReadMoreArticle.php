<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadMoreArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'read_more_article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
