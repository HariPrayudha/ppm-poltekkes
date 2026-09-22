@extends('layouts.admin', ['title' => 'Data Kontak'])

@section('content')
    <x-admin.page-header
        title="Data Kontak"
        description="Kelola alamat institusi, jam layanan operasional, kontak resmi, media sosial, dan peta lokasi kampus."
    />

    <form method="POST" action="{{ route('admin.contact.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Top Section: 2 Equal-Width Cards on Desktop (1:1 Ratio) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            <!-- Left: Informasi Kontak Resmi -->
            <x-admin.card
                title="Informasi Kontak Resmi"
                description="Alamat dan kontak resmi institusi pada halaman kontak dan footer."
                class="h-full flex flex-col"
            >
                <div class="space-y-4 flex-1 flex flex-col justify-between">
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

            <!-- Right: Tautan Media Sosial -->
            <x-admin.card
                title="Tautan Media Sosial"
                description="Kanal akun resmi institusi Poltekkes Kemenkes Medan."
                class="h-full flex flex-col"
            >
                <div class="space-y-4 flex-1 flex flex-col justify-between">
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
            </x-admin.card>
        </div>

        <!-- Bottom Section: Full-Width Peta Lokasi Kampus (Google Maps Embed) -->
        <x-admin.card
            title="Peta Lokasi Kampus (Google Maps Embed)"
            description="Masukkan kode iframe semat dari Google Maps untuk menampilkan peta lokasi institusi."
            class="w-full"
        >
            <div class="space-y-5">
                <x-admin.form-textarea
                    name="maps_embed"
                    label="Link / Kode Iframe Sematan Peta Google Maps"
                    rows="3"
                    :value="$contact->maps_embed"
                    placeholder='https://www.google.com/maps/embed?... atau <iframe src="https://www.google.com/maps/embed?..."></iframe>'
                    hint="Bisa berupa link URL embed langsung (https://...) atau seluruh kode tag iframe dari Google Maps (Bagikan > Sematkan peta)."
                />

                @if($contact->map_url)
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-2">Pratinjau Peta Saat Ini:</p>
                        <div class="overflow-hidden rounded-2xl border border-slate-200 aspect-21/9 sm:aspect-video max-h-72 w-full bg-slate-50 shadow-2xs">
                            <iframe src="{{ $contact->map_url }}" class="w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                @endif

                <!-- Submit Button Bar directly under Embed -->
                <div class="pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-end">
                    <x-admin.btn-primary type="submit" class="w-full sm:w-auto">
                        <i data-feather="check" class="h-4 w-4"></i>
                        Simpan Perubahan Kontak
                    </x-admin.btn-primary>
                </div>
            </div>
        </x-admin.card>
    </form>
@endsection
