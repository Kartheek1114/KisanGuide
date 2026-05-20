@extends('layouts.app')

@section('content')
<div class="space-y-16 py-8">
    <!-- Hero Section -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center pt-4">
        <div class="lg:col-span-7 space-y-6">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse mr-2"></span>
                Modern Agriculture Advisory Portal
            </span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-none text-white">
                Empowering Farmers with <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Smart Diagnostics</span>
            </h2>
            <p class="text-slate-400 text-base sm:text-lg max-w-xl leading-relaxed">
                Unlock precise crop profiles, calculate optimal Nitrogen-Phosphorus-Potassium (NPK) fertilizer quantities, monitor simulated local microclimate pest alerts, check mandi market prices, and connect with agricultural experts.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                @auth
                    <a href="{{ route('crops') }}" class="btn-premium-gradient px-6 py-3 rounded-xl text-sm tracking-wide shadow-lg shadow-emerald-500/10 flex items-center space-x-2">
                        <span>Go to Crop Directory</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-premium-gradient px-6 py-3 rounded-xl text-sm tracking-wide shadow-lg shadow-emerald-500/10 flex items-center space-x-2">
                        <span>Get Started - Register Now</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="btn-premium-outline px-6 py-3 rounded-xl text-sm tracking-wide flex items-center space-x-1.5">
                        <span>Sign In to Your Account</span>
                    </a>
                @endauth
            </div>
        </div>
        
        <!-- App Mockup Visual -->
        <div class="lg:col-span-5 relative">
            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-500 opacity-20 blur-xl"></div>
            <div class="glass-card rounded-2xl p-6 relative border border-slate-900 overflow-hidden space-y-4">
                <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    </div>
                    <span class="text-[10px] text-slate-500 font-mono">kisanguide-system-v12.0</span>
                </div>
                <div class="space-y-3">
                    <div class="h-4 bg-slate-900/80 rounded w-1/3"></div>
                    <div class="h-8 bg-slate-900/60 rounded w-full"></div>
                    <div class="grid grid-cols-2 gap-2 pt-2">
                        <div class="h-16 bg-slate-900/60 rounded p-2 flex flex-col justify-between">
                            <span class="text-[9px] text-emerald-400 font-bold">NPK RATIO</span>
                            <span class="text-xs font-semibold text-white">120:60:40</span>
                        </div>
                        <div class="h-16 bg-slate-900/60 rounded p-2 flex flex-col justify-between">
                            <span class="text-[9px] text-emerald-400 font-bold">PEST RISK</span>
                            <span class="text-xs font-semibold text-rose-450">Active Warn</span>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-emerald-500/5 border border-emerald-500/10 rounded-xl text-[11px] text-emerald-400/90 text-center font-medium">
                    🔒 Sign in to access interactive simulator calculators!
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="space-y-8 scroll-mt-20">
        <div class="text-center space-y-2 max-w-2xl mx-auto">
            <h3 class="text-3xl font-extrabold text-white">Powerful Agricultural Utilities</h3>
            <p class="text-sm text-slate-400">Everything you need to optimize crop yields, safeguard fields from pests, and monitor market indicators.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Feature 1: Crop Directory -->
            <a href="{{ route('login') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 group">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">Smart Crop Directory</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Access comprehensive profiles for various crops including optimal soil, temperature range, sowing parameters, water requirement levels, and growth metrics.</p>
                </div>
                <span class="text-xs text-emerald-500 font-semibold flex items-center space-x-1 pt-2 mt-auto">
                    <span>Explore Crops</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- Feature 2: NPK Calculator -->
            <a href="{{ route('login') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 group">
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 flex items-center justify-center border border-teal-500/20 text-teal-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-bold text-white group-hover:text-teal-400 transition-colors">NPK Fertilizer Calculator</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Instantly compute required amounts of Nitrogen (N), Phosphorus (P), and Potassium (K) based on crop specific demands and your field acreage.</p>
                </div>
                <span class="text-xs text-teal-400 font-semibold flex items-center space-x-1 pt-2 mt-auto">
                    <span>Calculate Dosage</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- Feature 3: Weather Simulator -->
            <a href="{{ route('login') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 group">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">Interactive Climate Advisor</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Check crop pest vulnerability status under varying weather patterns using the temperature and relative humidity diagnostic engine.</p>
                </div>
                <span class="text-xs text-emerald-500 font-semibold flex items-center space-x-1 pt-2 mt-auto">
                    <span>Open Simulator</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- Feature 4: Mandi Prices -->
            <a href="{{ route('login') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 group">
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 flex items-center justify-center border border-teal-500/20 text-teal-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-bold text-white group-hover:text-teal-400 transition-colors">Mandi Price Monitor</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Track live prices/quintal for staple agricultural commodities like rice, wheat, tomatoes, cotton, potatoes, and maize.</p>
                </div>
                <span class="text-xs text-teal-400 font-semibold flex items-center space-x-1 pt-2 mt-auto">
                    <span>View Market Rates</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- Feature 5: Expert Help -->
            <a href="{{ route('login') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 group">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div class="space-y-1">
                    <h4 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">Expert Help & Advisory</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Ask queries about crop conditions and receive automated agronomic recommendations validated by agricultural officers.</p>
                </div>
                <span class="text-xs text-emerald-500 font-semibold flex items-center space-x-1 pt-2 mt-auto">
                    <span>Consult Experts</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>

            <!-- Feature 6: Registration CTA -->
            <a href="{{ route('register') }}" class="glass-card glass-card-hover rounded-2xl p-6 flex flex-col space-y-4 justify-between border-dashed border-emerald-500/30 hover:border-emerald-500 bg-emerald-950/10 group">
                <div class="space-y-3">
                    <h4 class="text-xl font-extrabold text-white bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Get Portal Access</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Sign up in seconds to unlock full interactive dashboard features, save agricultural inquiries, and use live calculators.</p>
                </div>
                <div class="btn-premium-gradient py-2.5 rounded-lg text-center text-xs font-bold uppercase tracking-wider mt-4">
                    Create Free Account
                </div>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="glass-card rounded-2xl p-8 space-y-6 scroll-mt-20 relative overflow-hidden">
        <div class="absolute -right-20 -bottom-20 w-44 h-44 bg-emerald-500/5 rounded-full blur-2xl"></div>
        <div class="max-w-3xl space-y-4">
            <h3 class="text-2xl font-bold text-white">About KisanGuide</h3>
            <p class="text-xs text-slate-405 leading-relaxed">
                KisanGuide is a specialized agronomic decision support platform built to optimize crop production and management practices. By combining historical agricultural datasets, localized climatic thresholds, and instant fertilizer estimation workflows, the portal helps farmers reduce guess-work and adopt scientific cultivation patterns.
            </p>
            <p class="text-xs text-slate-405 leading-relaxed">
                Our database stores optimal temperature, humidity, soil pH, and NPK requirements for cash crops and staples alike, providing a reliable point of reference for small-scale and commercial farmers.
            </p>
        </div>
    </section>
</div>
@endsection
