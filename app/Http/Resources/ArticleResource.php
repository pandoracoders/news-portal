<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "url" => route("singleArticle", $this->slug),
            "image" => asset($this->image),
            "category" => [
                "name" => $this->category->title,
                "url" => route("categoryArticles", $this->category->slug),
            ],
            "author" => [
                "name" => $this->author->name,
                "url" => route("authorArticle", $this->author->slug),
            ],
            "published_at" => dateFormat($this->published_at),
        ];
    }
}
