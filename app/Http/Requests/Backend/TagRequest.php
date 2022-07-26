<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class TagRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|string|max:255",
            "slug" => "required|string|max:255|unique:categories,slug," . $this->route('category')?->id ?? '',

        ];
    }


    protected function prepareForValidation()
    {
        $tag = $this->route("tag");

        $this->merge([
            "id" => $tag->id ?? null,
            "slug" => ($tag && $tag->id) ? $tag->slug : Str::slug($this->title),
        ]);
    }
}
