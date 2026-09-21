<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RelatedLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama institusi/aplikasi wajib diisi.',
            'url.required' => 'URL tautan wajib diisi.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran file logo maksimal 2MB.',
        ];
    }
}
