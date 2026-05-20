@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="space-y-2">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
            Fertilizer Calculator
        </span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-white">NPK Dosage Calculator</h3>
        <p class="text-sm text-slate-400">Determine the required chemical nutrients (Nitrogen, Phosphorus, Potassium) for your land area.</p>
    </div>

    <div class="glass-card rounded-2xl p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label for="calc-crop" class="text-xs font-semibold text-slate-300 block">Select Crop Target</label>
                <select id="calc-crop" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 text-sm">
                    @foreach($crops as $c)
                        <option value="{{ $c->name }}" 
                                data-n="{{ $c->optimal_n }}" 
                                data-p="{{ $c->optimal_p }}" 
                                data-k="{{ $c->optimal_k }}">
                            {{ $c->name }} (NPK Ratio: {{ $c->optimal_n }}:{{ $c->optimal_p }}:{{ $c->optimal_k }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5">
                <label for="calc-area" class="text-xs font-semibold text-slate-300 block">Farm Land Area (in Acres)</label>
                <div class="relative">
                    <input type="number" id="calc-area" min="0.1" step="0.1" value="1.0" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 text-sm">
                    <span class="absolute inset-y-0 right-3 flex items-center text-xs text-slate-500 font-bold">Acres</span>
                </div>
            </div>
        </div>

        <!-- Calculator Results Display -->
        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-slate-900">
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-900 text-center relative">
                <span class="absolute top-1 left-2 text-[9px] font-bold text-emerald-500 tracking-wider">NITROGEN (N)</span>
                <div class="text-2xl font-extrabold text-white mt-1.5 animate-pulse" id="res-n">0 <span class="text-xs font-normal text-slate-400">kg</span></div>
                <p class="text-[10px] text-slate-500 mt-1">Growth & Greenery</p>
            </div>

            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-900 text-center relative">
                <span class="absolute top-1 left-2 text-[9px] font-bold text-emerald-500 tracking-wider">PHOSPHORUS (P)</span>
                <div class="text-2xl font-extrabold text-white mt-1.5 animate-pulse" id="res-p">0 <span class="text-xs font-normal text-slate-400">kg</span></div>
                <p class="text-[10px] text-slate-500 mt-1">Roots & Blooming</p>
            </div>

            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-900 text-center relative">
                <span class="absolute top-1 left-2 text-[9px] font-bold text-emerald-500 tracking-wider">POTASSIUM (K)</span>
                <div class="text-2xl font-extrabold text-white mt-1.5 animate-pulse" id="res-k">0 <span class="text-xs font-normal text-slate-400">kg</span></div>
                <p class="text-[10px] text-slate-500 mt-1">Disease Resistance</p>
            </div>
        </div>

        <div class="p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-xl text-xs text-emerald-400/90 leading-relaxed">
            💡 <strong>Pro Tip:</strong> Apply 1/3 of Nitrogen (N) and full Phosphorus (P) & Potassium (K) as a basal dose during sowing. The remaining Nitrogen should be top-dressed in splits at the tillering and panicle initiation phases.
        </div>
    </div>
</div>

<script>
    // NPK Calculator Logic
    const calcCrop = document.getElementById('calc-crop');
    const calcArea = document.getElementById('calc-area');
    const resN = document.getElementById('res-n');
    const resP = document.getElementById('res-p');
    const resK = document.getElementById('res-k');

    function calculateNPK() {
        const selectedOpt = calcCrop.options[calcCrop.selectedIndex];
        const area = parseFloat(calcArea.value) || 0;
        
        const nPerAcre = parseFloat(selectedOpt.getAttribute('data-n')) || 0;
        const pPerAcre = parseFloat(selectedOpt.getAttribute('data-p')) || 0;
        const kPerAcre = parseFloat(selectedOpt.getAttribute('data-k')) || 0;

        // Note: Database represents kg/hectare. 1 Acre = 0.4047 Hectares.
        // Let's do (kg/hectare * 0.4047 * area) to give standard dosage in kg for the chosen acres
        const factor = 0.4047 * area;
        resN.innerHTML = Math.round(nPerAcre * factor) + ' <span class="text-xs font-normal text-slate-450">kg</span>';
        resP.innerHTML = Math.round(pPerAcre * factor) + ' <span class="text-xs font-normal text-slate-450">kg</span>';
        resK.innerHTML = Math.round(kPerAcre * factor) + ' <span class="text-xs font-normal text-slate-450">kg</span>';
    }

    calcCrop.addEventListener('change', calculateNPK);
    calcArea.addEventListener('input', calculateNPK);
    calculateNPK(); // Init
</script>
@endsection
