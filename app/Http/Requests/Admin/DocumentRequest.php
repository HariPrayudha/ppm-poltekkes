<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isStore = $this->isMethod('post');

        return [
            'document_category_id' => ['required', 'exists:document_categories,id'],
            'code' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1990', 'max:'.(date('Y') + 1)],
            'file' => [$isStore ? 'required' : 'nullable', 'file', 'mimes:pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_category_id.required' => 'Kategori dokumen wajib dipilih.',
            'document_category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'code.required' => 'Kode dokumen SPMI wajib diisi.',
            'name.required' => 'Nama dokumen wajib diisi.',
            'year.required' => 'Tahun terbit wajib diisi.',
            'file.required' => 'File dokumen PDF wajib diunggah.',
            'file.mimes' => 'Format file dokumen harus berupa PDF.',
            'file.max' => 'Ukuran file PDF maksimal 5MB.',
        ];
    }
}
