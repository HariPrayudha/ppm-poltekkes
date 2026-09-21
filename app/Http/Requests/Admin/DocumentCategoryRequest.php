<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('document_category')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('document_categories', 'name')->ignore($categoryId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori dokumen wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah terdaftar.',
        ];
    }
}
