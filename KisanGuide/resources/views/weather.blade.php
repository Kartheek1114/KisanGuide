@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="space-y-2">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
            Climate & Market
        </span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Interactive Weather & Mandi Advisor</h3>
        <p class="text-sm text-slate-400">Track local market prices and test climatic threshold risk profiles for major crops.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Weather Simulator Card -->
        <div class="lg:col-span-7 glass-card rounded-2xl p-6 relative overflow-hidden shadow-xl" id="weather-sec">
            <div class="absolute -right-10 -top-10 w-24 h-24 bg-yellow-500/10 rounded-full blur-xl"></div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-white flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Interactive Climate Advisor</span>
                </h3>
                <span class="text-xs text-slate-400 bg-slate-900 px-2.5 py-1 rounded-md border border-slate-800 font-mono">Live Simulator</span>
            </div>

            <p class="text-xs text-slate-400 mb-6">
                Adjust temperature and humidity sliders to check crop pest vulnerability alerts instantly based on your local microclimate.
            </p>

            <div class="space-y-6">
                <!-- Temp Slider -->
                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-semibold">
                        <span class="text-slate-300">Temperature</span>
                        <span class="text-emerald-400" id="temp-val">25 °C</span>
                    </div>
                    <input type="range" id="temp-slider" min="5" max="45" value="25" class="w-full h-1.5 bg-slate-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                </div>

                <!-- Humidity Slider -->
                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-semibold">
                        <span class="text-slate-300">Relative Humidity</span>
                        <span class="text-emerald-400" id="humidity-val">65 %</span>
                    </div>
                    <input type="range" id="humidity-slider" min="10" max="100" value="65" class="w-full h-1.5 bg-slate-900 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                </div>

                <!-- Advisor Output Panel -->
                <div class="pt-4 border-t border-slate-900 space-y-3">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">AI Climate Diagnostics</div>
                    <div id="climate-alert-box" class="p-3.5 rounded-xl border transition-all text-sm font-medium">
                        <!-- Dynamic Output from JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Mandi Price Monitor Card -->
        <div class="lg:col-span-5 glass-card rounded-2xl p-6 space-y-5 scroll-mt-20" id="mandi-sec">
            <div class="flex items-center justify-between">
                <div class="space-y-0.5">
                    <h3 class="text-xl font-bold text-white flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Mandi Price Monitor</span>
                    </h3>
                    <p class="text-[11px] text-slate-500">Live commodity prices / quintal (100 kg)</p>
                </div>
                <button onclick="simulatePrices()" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 border border-slate-800 text-emerald-400 transition-all" title="Refresh market rates">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </button>
            </div>

            <div class="divide-y divide-slate-900" id="mandi-rows">
                <!-- Dynamic Mandi Price Rows from JS -->
            </div>

            <div class="text-[10px] text-slate-500 text-center">
                Simulated prices based on current market trends. Refreshed locally every few minutes.
            </div>
        </div>
    </div>
</div>

<script>
    // Pest rules passed from Laravel backend
    const pestProfiles = @json($pests);
    const cropProfiles = @json($crops);

    // Weather Simulator Logic
    const tempSlider = document.getElementById('temp-slider');
    const humiditySlider = document.getElementById('humidity-slider');
    const tempVal = document.getElementById('temp-val');
    const humidityVal = document.getElementById('humidity-val');
    const alertBox = document.getElementById('climate-alert-box');

    function evaluateClimateAlerts() {
        const temp = parseFloat(tempSlider.value);
        const hum = parseFloat(humiditySlider.value);

        tempVal.textContent = temp + ' °C';
        humidityVal.textContent = hum + ' %';

        let activeThreats = [];

        pestProfiles.forEach(pest => {
            if (hum >= pest.humidity_threshold && temp >= pest.temp_threshold) {
                activeThreats.push(pest);
            }
        });

        if (activeThreats.length > 0) {
            let html = `<div class="text-rose-450 font-bold mb-1.5 flex items-center space-x-1.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span>${activeThreats.length} High-Risk Pest Warning(s)</span>
            </div>`;
            activeThreats.forEach(pest => {
                html += `<div class="mt-2 text-xs text-rose-350 bg-rose-500/5 border border-rose-500/10 p-2.5 rounded-lg space-y-1">
                    <div class="font-semibold text-white">${pest.name} (Severity: ${pest.severity_level})</div>
                    <div><strong>Triggers:</strong> Temp ≥ ${pest.temp_threshold}°C, Humidity ≥ ${pest.humidity_threshold}%</div>
                    <div><strong>Target Crops:</strong> ${pest.target_crops.join(', ')}</div>
                    <div class="text-[11px] text-slate-400"><strong>Remedy:</strong> ${pest.remedial_measures}</div>
                </div>`;
            });
            alertBox.className = "p-3.5 rounded-xl border border-rose-500/25 bg-rose-500/5 text-sm font-medium transition-all duration-300";
            alertBox.innerHTML = html;
        } else {
            alertBox.className = "p-3.5 rounded-xl border border-emerald-500/25 bg-emerald-500/5 text-sm font-medium text-emerald-455 transition-all duration-300";
            alertBox.innerHTML = `
                <div class="font-bold flex items-center space-x-1.5 mb-0.5 text-emerald-450">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Optimal Conditions</span>
                </div>
                <p class="text-xs text-emerald-500/80 font-normal leading-relaxed">No immediate disease or pest threats detected for current microclimate parameters. Maintain regular moisture level checks.</p>
            `;
        }
    }

    tempSlider.addEventListener('input', evaluateClimateAlerts);
    humiditySlider.addEventListener('input', evaluateClimateAlerts);
    evaluateClimateAlerts(); // Init

    // Mandi Market Price Simulation Logic
    const mandiCrops = [
        { name: 'Rice (Paddy)', base: 2180, code: 'RIC' },
        { name: 'Wheat', base: 2275, code: 'WHT' },
        { name: 'Cotton', base: 6620, code: 'COT' },
        { name: 'Tomato', base: 1800, code: 'TOM' },
        { name: 'Maize', base: 2090, code: 'MAZ' },
        { name: 'Potato', base: 1450, code: 'POT' }
    ];

    const mandiContainer = document.getElementById('mandi-rows');

    function simulatePrices() {
        mandiContainer.innerHTML = '';
        mandiCrops.forEach(item => {
            // random fluctuation between -3% and +4%
            const pct = (Math.random() * 7 - 3) / 100;
            const change = Math.round(item.base * pct);
            const current = item.base + change;
            const sign = change >= 0 ? '+' : '';
            const color = change >= 0 ? 'text-emerald-450' : 'text-rose-500';
            const bg = change >= 0 ? 'bg-emerald-500/10' : 'bg-rose-500/10';
            const border = change >= 0 ? 'border-emerald-500/20' : 'border-rose-500/20';
            const arrow = change >= 0 
                ? `<svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L7 9.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/></svg>`
                : `<svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L7 10.586 2.707 6.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/></svg>`;

            const row = document.createElement('div');
            row.className = "flex items-center justify-between py-3.5 border-b border-slate-900 last:border-b-0";
            row.innerHTML = `
                <div class="space-y-0.5">
                    <span class="text-sm font-bold text-white">${item.name}</span>
                    <span class="text-[9px] text-slate-500 font-mono tracking-wider">${item.code}/INR</span>
                </div>
                <div class="text-right space-y-1">
                    <div class="text-sm font-extrabold text-white">₹${current.toLocaleString()}</div>
                    <div class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${bg} ${border} ${color}">
                        ${arrow}
                        <span>${sign}${change} (${sign}${(pct*100).toFixed(1)}%)</span>
                    </div>
                </div>
            `;
            mandiContainer.appendChild(row);
        });
    }

    simulatePrices(); // Init
</script>
@endsection
