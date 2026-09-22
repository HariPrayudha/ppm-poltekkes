@props(['service'])

<div class="service-card-hover group relative flex flex-col justify-between bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs overflow-hidden">
    <!-- Top Accent Gradient Line -->
    <div class="absolute top-0 inset-x-0 h-1 bg-linear-to-r from-[#0BB5CB] via-[#00A99D] to-[#46B58B] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <div class="space-y-4">
        <!-- Icon Container -->
        <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-[#028DA9] transition-all duration-300 group-hover:scale-105 group-hover:bg-[#0BB5CB] group-hover:text-white group-hover:border-[#0BB5CB] shadow-2xs">
            @if($service->icon_path)
                <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert transition-all duration-300">
            @else
                <i data-feather="check-circle" class="w-7 h-7"></i>
            @endif
        </div>

        <!-- Title -->
        <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-[#028DA9] transition-colors duration-200 tracking-tight">
            {{ $service->name }}
        </h3>

        <!-- Description -->
        <p class="text-slate-600 text-sm leading-relaxed">
            {{ $service->description }}
        </p>
    </div>

    <!-- Interactive Card Footer Indicator -->
    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center text-xs font-semibold text-[#028DA9] group-hover:text-[#0BB5CB] transition-colors">
        <span>Layanan SPMI</span>
        <i data-feather="arrow-right" class="w-3.5 h-3.5 ml-1.5 transform transition-transform duration-300 group-hover:translate-x-1"></i>
    </div>
</div>
