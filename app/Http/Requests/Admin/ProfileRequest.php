<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'org_chart' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'duties_content' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'org_chart.image' => 'File bagan harus berupa gambar.',
            'org_chart.mimes' => 'Format gambar bagan harus JPG, JPEG, PNG, atau WEBP.',
            'org_chart.max' => 'Ukuran bagan organisasi maksimal 4MB.',
        ];
    }
}
