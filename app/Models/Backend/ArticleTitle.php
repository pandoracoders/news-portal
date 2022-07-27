<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "article_id",
        "status",
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
