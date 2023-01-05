<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email," . $this->route("user")?->id,
            "password" => "required_without:id|min:6",
            "alias_name" => "required|string|max:255",
            "slug" => "required|string|max:255|unique:users,slug," . $this->route("user")?->id,
            "role_id" => "required|exists:roles,id",
            "permissions" => "required|array",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "slug" => $this->route("user")?->slug ?? str_slug($this->name),
            "id" => $this->route("user")?->id ?? null,
            "password" => isset($this->password)? bcrypt($this->password): null,
        ]);
    }
}
