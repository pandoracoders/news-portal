<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        if ($this->route("type") == "branding") {
            $rules = [
                // image validation
                "logo" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "favicon" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
                "website_title" => "nullable|string|max:255",
                "slogan" => "nullable|string|max:255",
                "contact_email" => "nullable|email|max:255",
            ];
        } else if ($this->route("type") == "social-media") {
            foreach (config("constants.social_media") as $value) {
                $rules[$value] = "nullable|url";
            }
        }


        return $rules;
    }
}