<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TableSetRequest extends FormRequest
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
            "description" => "nullable|string|max:255",

        ];
    }

    protected function prepareForValidation()
    {
        $fields = [];
        foreach ($this->fields as $key => $field) {
            if ($field) {
                array_push($fields, [
                    "id" => $this->field_id[$key] ?? null,
                    "title" => $field,
                    "type" => $this->field_type[$key],
                    "searchable" => $this->searchable[$field] ?? false,
                ]);
            }
        }

        $this->merge([
            "table_fields" => $fields,
        ]);
    }
}
