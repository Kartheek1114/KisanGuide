@extends('layouts.app')

@section('content')
<div class="space-y-6">
    {{-- Success Alert --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold leading-normal">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header and Filters --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div class="space-y-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Crop Advisor</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Smart Crop Directory</h3>
            <p class="text-sm text-slate-400">Search and filter crop varieties suitable for your climate and soil type.</p>
        </div>
        <div class="flex flex-wrap gap-2.5">
            <div class="relative w-full sm:w-60">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" id="crop-search" placeholder="Search crops..." class="w-full pl-9 pr-4 py-2 text-sm bg-slate-900 border border-slate-800 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-colors"/>
            </div>
            <select id="crop-type-filter" class="px-3 py-2 text-sm bg-slate-900 border border-slate-800 rounded-lg text-slate-300 focus:outline-none focus:border-emerald-500/50">
                <option value="">All Types</option>
                @foreach($cropTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <select id="crop-soil-filter" class="px-3 py-2 text-sm bg-slate-900 border border-slate-800 rounded-lg text-slate-300 focus:outline-none focus:border-emerald-500/50">
                <option value="">All Soil Types</option>
                @foreach($soilTypes as $soil)
                    <option value="{{ $soil }}">{{ $soil }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Crop Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="crop-cards-container">
        @foreach($crops as $crop)
            <div class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col h-full crop-card" data-name="{{ strtolower($crop->name) }}" data-type="{{ $crop->type }}" data-soils="{{ json_encode(array_map('strtolower', $crop->soil_types)) }}" data-description="{{ strtolower($crop->description) }}">
                <img src="{{ $crop->image_url }}" alt="{{ $crop->name }}" class="w-full h-48 object-cover rounded-t-2xl mb-4">
                <div class="p-6 flex flex-col flex-grow space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="bg-emerald-500/90 text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">{{ $crop->type }}</span>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-xl font-bold text-white">{{ $crop->name }}</h4>
                        <p class="text-xs text-slate-400 line-clamp-2">{{ $crop->description }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs py-3 border-y border-slate-800">
                        <div class="space-y-0.5">
                            <span class="text-slate-500 block">Optimal Temp</span>
                            <span class="text-slate-200 font-medium">{{ $crop->optimal_temp_min }}°C - {{ $crop->optimal_temp_max }}°C</span>
                        </div>
                        <div class="space-y-0.5">
                            <span class="text-slate-500 block">Soil pH</span>
                            <span class="text-slate-200 font-medium">{{ $crop->optimal_ph_min }} - {{ $crop->optimal_ph_max }}</span>
                        </div>
                        <div class="space-y-0.5 mt-2">
                            <span class="text-slate-500 block">Harvest Period</span>
                            <span class="text-slate-200 font-medium">{{ $crop->harvest_days }} Days</span>
                        </div>
                        <div class="space-y-0.5 mt-2">
                            <span class="text-slate-500 block">Water Need</span>
                            <span class="text-slate-200 font-medium truncate inline-block max-w-full" title="{{ $crop->water_requirement }}">{{ $crop->water_requirement }}</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <span class="text-xs font-semibold text-slate-400 block">Ideal Soils:</span>
                        <div class="flex flex-wrap gap-1">
                            @foreach($crop->soil_types as $s)
                                <span class="bg-slate-900 text-slate-300 text-[10px] px-2 py-0.5 rounded border border-slate-800">{{ $s }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-2 flex justify-between items-center mt-auto">
                        <span class="text-xs font-semibold text-emerald-400">NPK: {{ $crop->optimal_n }}:{{ $crop->optimal_p }}:{{ $crop->optimal_k }}</span>
                        <button onclick="openCropDetails('{{ $crop->name }}','{{ $crop->type }}','{{ addslashes($crop->description) }}','{{ $crop->optimal_temp_min }}°C to {{ $crop->optimal_temp_max }}°C','{{ $crop->optimal_ph_min }} to {{ $crop->optimal_ph_max }}','{{ $crop->harvest_days }} Days','{{ $crop->water_requirement }}','{{ $crop->optimal_n }}:{{ $crop->optimal_p }}:{{ $crop->optimal_k }}','{{ implode(', ', $crop->soil_types) }}')" class="btn-premium-outline px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center space-x-1">
                            <span>Details</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- No Results Message --}}
    <div id="no-crops-found" class="hidden text-center py-12 glass-card rounded-2xl border border-slate-900">
        <svg class="w-12 h-12 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-slate-400 font-medium">No crops match your search criteria.</p>
    </div>

    {{-- Crop Details Modal --}}
    <div id="crop-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="glass-card rounded-2xl w-full max-w-lg overflow-hidden shadow-2xl relative">
            <button onclick="closeCropDetails()" class="absolute top-4 right-4 p-1.5 rounded-lg bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="p-6 space-y-5">
                <div class="space-y-1">
                    <span id="modal-crop-type" class="text-[10px] font-bold uppercase tracking-wider text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">Cereal</span>
                    <h3 id="modal-crop-name" class="text-2xl font-bold text-white mt-1.5">Crop Name</h3>
                </div>
                <p id="modal-crop-desc" class="text-xs text-slate-300 leading-relaxed">Description goes here...</p>
                <div class="grid grid-cols-2 gap-3 text-xs bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                    <div>
                        <span class="text-slate-500 block">Temperature Range</span>
                        <span id="modal-crop-temp" class="text-slate-200 font-semibold">-</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Soil pH Range</span>
                        <span id="modal-crop-ph" class="text-slate-200 font-semibold">-</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-slate-500 block">Watering Profile</span>
                        <span id="modal-crop-water" class="text-slate-200 font-semibold">-</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-slate-500 block">Growth Period</span>
                        <span id="modal-crop-harvest" class="text-slate-200 font-semibold">-</span>
                    </div>
                    <div class="col-span-2 mt-2 pt-2 border-t border-slate-800">
                        <span class="text-slate-500 block">Optimal N-P-K Ratio (kg/ha)</span>
                        <span id="modal-crop-npk" class="text-emerald-400 font-extrabold">-</span>
                    </div>
                    <div class="col-span-2 mt-2">
                        <span class="text-slate-500 block">Suitable Soils</span>
                        <span id="modal-crop-soils" class="text-slate-300 font-semibold">-</span>
                    </div>
                </div>
                <div class="flex justify-end pt-2">
                    <button onclick="closeCropDetails()" class="btn-premium-outline px-4 py-2 text-xs font-semibold rounded-lg">Close Details</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script – filtering and modal logic --}}
    <script>
        const cropSearch = document.getElementById('crop-search');
        const typeFilter = document.getElementById('crop-type-filter');
        const soilFilter = document.getElementById('crop-soil-filter');
        const cropCards = document.querySelectorAll('.crop-card');
        const noCrops = document.getElementById('no-crops-found');
        const modal = document.getElementById('crop-modal');
        const modalName = document.getElementById('modal-crop-name');
        const modalType = document.getElementById('modal-crop-type');
        const modalDesc = document.getElementById('modal-crop-desc');
        const modalTemp = document.getElementById('modal-crop-temp');
        const modalPh = document.getElementById('modal-crop-ph');
        const modalWater = document.getElementById('modal-crop-water');
        const modalHarvest = document.getElementById('modal-crop-harvest');
        const modalNpk = document.getElementById('modal-crop-npk');
        const modalSoils = document.getElementById('modal-crop-soils');

        function filterCrops() {
            const query = cropSearch.value.toLowerCase().trim();
            const selectedType = typeFilter.value;
            const selectedSoil = soilFilter.value.toLowerCase();
            let visibleCount = 0;
            cropCards.forEach(card => {
                const name = card.getAttribute('data-name');
                const type = card.getAttribute('data-type');
                const desc = card.getAttribute('data-description');
                const soils = JSON.parse(card.getAttribute('data-soils'));
                const matchQuery = name.includes(query) || desc.includes(query);
                const matchType = !selectedType || type === selectedType;
                const matchSoil = !selectedSoil || soils.includes(selectedSoil);
                if (matchQuery && matchType && matchSoil) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            noCrops.classList.toggle('hidden', visibleCount !== 0);
        }
        cropSearch.addEventListener('input', filterCrops);
        typeFilter.addEventListener('change', filterCrops);
        soilFilter.addEventListener('change', filterCrops);

        function openCropDetails(name, type, desc, temp, ph, harvest, water, npk, soils) {
            modalName.textContent = name;
            modalType.textContent = type;
            modalDesc.textContent = desc;
            modalTemp.textContent = temp;
            modalPh.textContent = ph;
            modalWater.textContent = water;
            modalHarvest.textContent = harvest;
            modalNpk.textContent = npk + ' (Nitrogen : Phosphorus : Potassium)';
            modalSoils.textContent = soils;
            modal.classList.remove('hidden');
        }
        function closeCropDetails() {
            modal.classList.add('hidden');
        }
    </script>
@endsection