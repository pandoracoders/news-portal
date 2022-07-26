<?php

namespace App\Http\Requests\Backend;

use App\Models\Seo;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "description" => "nullable|string|max:255",
            "status" => "nullable|boolean",
            "order" => "nullable|integer",
            "parent_id" => "nullable|integer",
            "seo_id" => "nullable|integer",
            ...config("constants.seo_validation"),
        ];
    }

    protected function prepareForValidation()
    {
        $category = $this->route("category");

        $this->merge([
            "id" => $category->id ?? null,
            "slug" => ($category && $category->id) ? $category->slug : Str::slug($this->title),
        ]);
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            "title.required" => "The title field is required.",
            "title.string" => "The title must be a string.",
            "title.max" => "The title may not be greater than 255 characters.",
            "slug.required" => "The slug field is required.",
            "slug.string" => "The slug must be a string.",
            "slug.max" => "The slug may not be greater than 255 characters.",
            "slug.unique" => "The slug has already been taken.",
            "image.image" => "The image must be an image.",
            "image.mimes" => "The image must be a file of type: jpeg, png, jpg, gif, svg.",
            "image.max" => "The image may not be greater than 2048 kilobytes.",
            "description.string" => "The description must be a string.",
            "description.max" => "The description may not be greater than 255 characters.",
            "status.boolean" => "The status must be a boolean.",
            "order.integer" => "The order must be an integer.",
            "parent_id.integer" => "The parent id must be an integer.",
            "seo_id.integer" => "The seo id must be an integer.",
        ];
    }
}
