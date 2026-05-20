@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12">
    <div class="glass-card rounded-2xl w-full max-w-md border border-slate-900 overflow-hidden shadow-2xl relative">
        <!-- Glow accents -->
        <div class="absolute -right-16 -top-16 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl"></div>

        <div class="p-8 space-y-6 relative">
            <div class="text-center space-y-1">
                <h3 class="text-2xl font-extrabold text-white tracking-tight">Welcome Back</h3>
                <p class="text-xs text-slate-400">Sign in to your KisanGuide portal account</p>
            </div>

            @if(session('status'))
                <div class="p-3 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-xs font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-300 block">Email Address</label>
                    <input type="email" name="email" id="email" required autocomplete="email" placeholder="farmer@example.com" value="{{ old('email') }}" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                    @error('email')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-semibold text-slate-300 block">Password</label>
                    </div>
                    <input type="password" name="password" id="password" required autocomplete="current-password" placeholder="••••••••" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                    @error('password')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-800 text-emerald-500 focus:ring-0 cursor-pointer">
                    <label for="remember" class="ml-2 text-xs text-slate-450 select-none cursor-pointer">Remember my device</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full btn-premium-gradient py-3 rounded-lg text-xs font-bold uppercase tracking-wider mt-2">
                    Sign In
                </button>
            </form>

            <div class="pt-4 border-t border-slate-900 text-center text-xs text-slate-450">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-emerald-400 hover:text-emerald-350 hover:underline font-semibold ml-1">Create Account</a>
            </div>
        </div>
    </div>
</div>
@endsection
