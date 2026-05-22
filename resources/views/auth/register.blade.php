@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12">
    <div class="glass-card rounded-2xl w-full max-w-md border border-slate-900 overflow-hidden shadow-2xl relative">
        <!-- Glow accents -->
        <div class="absolute -right-16 -top-16 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl"></div>

        <div class="p-8 space-y-6 relative">
            <div class="text-center space-y-1">
                <h3 class="text-2xl font-extrabold text-white tracking-tight">Create Account</h3>
                <p class="text-xs text-slate-400">Join KisanGuide to unlock tools and advisor advice</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-semibold text-slate-300 block">Full Name</label>
                    <input type="text" name="name" id="name" required placeholder="Enter your full name" value="{{ old('name') }}" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                    @error('name')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-300 block">Email Address</label>
                    <input type="email" name="email" id="email" required placeholder="farmer@example.com" value="{{ old('email') }}" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                    @error('email')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-1.5">
                    <label for="password" class="text-xs font-semibold text-slate-300 block">Password</label>
                    <input type="password" name="password" id="password" required placeholder="••••••••" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                    @error('password')
                        <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-xs font-semibold text-slate-300 block">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••" class="input-premium w-full px-3 py-2.5 rounded-lg text-slate-200 placeholder-slate-600 text-sm">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full btn-premium-gradient py-3 rounded-lg text-xs font-bold uppercase tracking-wider mt-2">
                    Create Account
                </button>
            </form>

            <div class="pt-4 border-t border-slate-900 text-center text-xs text-slate-450">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-emerald-400 hover:text-emerald-350 hover:underline font-semibold ml-1">Sign In</a>
            </div>
        </div>
    </div>
</div>
@endsection
