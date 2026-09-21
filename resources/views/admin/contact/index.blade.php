@extends('layouts.admin', ['title' => 'Kelola Kontak & Footer'])

@section('content')
    <x-admin.page-header
        title="Kontak & Informasi Footer"
        description="Kelola informasi alamat institusi, jam layanan operasional, kontak resmi, dan tautan media sosial."
    />

    <form method="POST" action="{{ route('admin.contact.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Kontak Utama & Peta (2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <x-admin.card
                    title="Informasi Kontak Resmi"
                    description="Alamat dan kontak yang akan ditampilkan pada footer dan halaman kontak."
                >
                    <div class="space-y-4">
                        <x-admin.form-textarea
                            name="address"
                            label="Alamat Lengkap Institusi"
                            rows="3"
                            :value="$contact->address"
                            placeholder="Jl. Jamin Ginting KM. 13.5..."
                            required
                        />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.form-input
                                name="email"
                                label="Email Resmi"
                                type="email"
                                :value="$contact->email"
                                placeholder="ppm@poltekkes-medan.ac.id"
                                required
                            />

                            <x-admin.form-input
                                name="phone"
                                label="Nomor Telepon / Hotline"
                                :value="$contact->phone"
                                placeholder="(061) 8368633"
                                required
                            />
                        </div>

                        <x-admin.form-input
                            name="operating_hours"
                            label="Jam Layanan Operasional"
                            :value="$contact->operating_hours"
                            placeholder="Contoh: Senin - Jumat: 08.00 - 16.00 WIB"
                            required
                        />
                    </div>
                </x-admin.card>

                <!-- Google Maps Embed -->
                <x-admin.card
                    title="Peta Lokasi Kampus (Google Maps Embed)"
                    description="Masukkan kode iframe semat dari Google Maps."
                >
                    <div class="space-y-4">
                        <x-admin.form-textarea
                            name="maps_embed"
                            label="Kode HTML Iframe Sematan Peta"
                            rows="4"
                            :value="$contact->maps_embed"
                            placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
                        />

                        @if($contact->maps_embed)
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-2">Pratinjau Peta Saat Ini:</p>
                                <div class="overflow-hidden rounded-2xl border border-slate-200 aspect-video max-h-64 w-full">
                                    {!! $contact->maps_embed !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </x-admin.card>
            </div>

            <!-- Right: Media Sosial (1 col) -->
            <div class="space-y-6">
                <x-admin.card
                    title="Tautan Media Sosial"
                    description="Akun resmi Poltekkes Medan."
                >
                    <div class="space-y-4">
                        <x-admin.form-input
                            name="instagram_url"
                            label="Instagram URL"
                            :value="$contact->instagram_url"
                            placeholder="https://instagram.com/..."
                        />

                        <x-admin.form-input
                            name="youtube_url"
                            label="YouTube URL"
                            :value="$contact->youtube_url"
                            placeholder="https://youtube.com/@..."
                        />

                        <x-admin.form-input
                            name="facebook_url"
                            label="Facebook URL"
                            :value="$contact->facebook_url"
                            placeholder="https://facebook.com/..."
                        />
                    </div>

                    <div class="mt-8 pt-5 border-t border-slate-100">
                        <x-admin.btn-primary type="submit" class="w-full">
                            <i data-feather="check" class="h-4 w-4"></i>
                            Simpan Perubahan Kontak
                        </x-admin.btn-primary>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </form>
@endsection
