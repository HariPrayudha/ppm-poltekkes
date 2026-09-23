@props(['service'])

<div class="group relative flex flex-col bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-2xs hover:shadow-lg hover:-translate-y-1 hover:border-[#0BB5CB]/40 transition-all duration-300 ease-out overflow-hidden">
    <!-- Top Accent Gradient Line -->
    <div class="absolute top-0 inset-x-0 h-1 bg-linear-to-r from-[#00A99D] via-[#0BB5CB] to-[#46B58B] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <div class="space-y-3.5">
        <!-- Icon Container (Enlarged Icon, Clean, Neutral, Preserves Transparent PNG True Colors) -->
        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-slate-50/90 border border-slate-200/80 flex items-center justify-center p-2 sm:p-2.5 shadow-2xs group-hover:bg-white group-hover:border-[#0BB5CB]/40 group-hover:shadow-xs transition-all duration-300">
            @if($service->icon_path)
                <img src="{{ $service->icon_url }}"
                    alt="{{ $service->name }}"
                    class="w-10 h-10 sm:w-11 sm:h-11 object-contain transition-transform duration-300 group-hover:scale-105" />
            @else
                <i data-feather="check-circle" class="w-7 h-7 sm:w-8 sm:h-8 text-[#028DA9] transition-transform duration-300 group-hover:scale-105"></i>
            @endif
        </div>

        <!-- Title -->
        <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-[#028DA9] transition-colors duration-200 tracking-tight">
            {{ $service->name }}
        </h3>

        <!-- Description -->
        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
            {{ $service->description }}
        </p>
    </div>
</div>
