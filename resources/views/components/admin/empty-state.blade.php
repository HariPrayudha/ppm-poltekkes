@props([
    'colspan' => null,
    'message' => 'Belum ada data.',
    'description' => 'Data yang ditambahkan akan muncul di sini.',
    'icon' => 'inbox',
])

@if($colspan)
    <tr>
        <td colspan="{{ $colspan }}" class="px-6 py-12 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="rounded-full bg-slate-100 p-3 text-slate-400 mb-3">
                    <i data-feather="{{ $icon }}" class="h-6 w-6"></i>
                </div>
                <p class="text-sm font-semibold text-slate-700">{{ $message }}</p>
                <p class="mt-1 text-xs text-slate-400">{{ $description }}</p>
            </div>
        </td>
    </tr>
@else
    <div class="flex flex-col items-center justify-center py-12 px-6 text-center">
        <div class="rounded-full bg-slate-100 p-3 text-slate-400 mb-3">
            <i data-feather="{{ $icon }}" class="h-6 w-6"></i>
        </div>
        <p class="text-sm font-semibold text-slate-700">{{ $message }}</p>
        <p class="mt-1 text-xs text-slate-400">{{ $description }}</p>
    </div>
@endif
