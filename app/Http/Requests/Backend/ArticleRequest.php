<?php

namespace App\Http\Requests\Backend;

use App\Models\Backend\Tag;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $this->route("article")->id,
            'summary' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'category_id' => 'nullable|exists:categories,id',
            'writer_id' => 'nullable|exists:users,id',
            'editor_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'task_status' => 'nullable|string|max:255',
            'tables' => 'nullable|array',
            'tags.*' => 'nullable|exists:tags,id',
            "task_status" => "nullable|in:" . implode(",", config("constants.task_status")),

        ];
    }

    protected function prepareForValidation()
    {

        $category = ($this->route("article")->category);

        $tables = [];
        $tags = [];
        // dd(getArticleTables($this->route("article")));
        foreach (getArticleTables($this->route("article")) as $key => $table) {
            foreach ($table as $field) {
                $form_key = str_slug($key) . "_" . str_slug($field["title"]);
                if ($this->$form_key) {
                    $tables[$key][str_slug(str_slug($field['title']))] = getTableFieldArray(json_decode(json_encode($field)), $this->$form_key);
                }
            }
        }

        // delete all old tags
        $this->route("article")->tags()->detach();

        // dd("hello");
        foreach ($this->tags ?? [] as $key => $tag) {
            if (intval($tag) == 0) {
                $tag = Tag::updateOrCreate(
                    [
                        "slug" => str_slug($tag),
                    ],
                    [
                        "title" => $tag,
                        "slug" => str_slug($tag),
                    ]
                );
            } else {
                $tag = Tag::find($tag) ?? null;
            }
            if ($tag) {
                $tags[] = $tag->id;
            }
        }

        $this->merge(
            [
                "tables" => $tables,
                "tags" => $tags,
                "category_id" => $category->id,
                "slug" => $this->slug ?? str_slug($this->route("article")->title),
            ]);
    }
}
