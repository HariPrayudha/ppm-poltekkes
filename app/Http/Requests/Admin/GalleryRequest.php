<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isStore = $this->isMethod('post');

        return [
            'image' => [$isStore ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Foto kegiatan wajib diunggah.',
            'image.image' => 'File harus berupa gambar valid.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'title.required' => 'Judul kegiatan wajib diisi.',
            'event_date.required' => 'Tanggal pelaksanaan kegiatan wajib diisi.',
        ];
    }
}
