<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "description",
        "status",
    ];

    public function articles(){
       return $this->belongsToMany(Article::class,ArticleTag::class);

    }

    public function getOriginalTitleAttribute()
    {
        return $this->getRawOriginal('title');
    }

    public function getTitleAttribute(){
        return $this->original['title'] .  "(".$this->articles->count().")";
    }
}
