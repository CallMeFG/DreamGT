@extends('layouts.app')

@section('content')
    <div class="min-h-full flex items-center justify-center bg-gray-50 p-6">
        <div class="w-full max-w-md bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden relative">
            <div class="h-2 bg-ewc-black w-full top-0 left-0 absolute"></div>

            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">
                        Welcome <span class="text-ewc-gold">Back</span>
                    </h2>
                    <p class="text-gray-500 text-sm mt-2">Sign in to continue your progress.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if(session('error'))
                    <div class="mb-4 text-red-600 text-sm font-bold">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Username / Email</label>
                        <input name="login" type="text" required autofocus
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm text-sm text-ewc-black focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all placeholder-gray-400"
                            placeholder="Enter username or email" value="{{ old('login') }}">
                        <x-input-error :messages="$errors->get('login')" class="mt-1" />
                    </div>

                    <div x-data="{ show: false }">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-bold text-ewc-black uppercase">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-bold text-ewc-gold hover:underline">Forgot Password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm text-sm text-ewc-black focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all pr-10"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-ewc-black transition-colors focus:outline-none">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 011.591-2.986M9.855 9.855a3 3 0 014.238 4.238M6.343 6.343l11.314 11.314" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <label class="flex items-center cursor-pointer">
                        <input name="remember" type="checkbox"
                            class="rounded border-gray-300 text-ewc-gold shadow-sm focus:ring-ewc-gold">
                        <span class="ml-2 text-sm text-gray-500 font-medium">Keep me signed in</span>
                    </label>

                    <button type="submit"
                        class="w-full py-3.5 px-4 bg-ewc-black text-white font-bold uppercase tracking-wider rounded-sm hover:bg-gray-800 transition-all shadow-lg transform hover:-translate-y-0.5">Sign
                        In</button>
                </form>

                <div class="relative py-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-gray-400">Or
                            continue with</span></div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <a href="{{ route('social.redirect', 'google') }}"
                        class="flex justify-center items-center gap-2 py-2.5 border border-gray-200 rounded-sm hover:bg-gray-50 transition">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        <span class="text-sm font-bold text-gray-600">Google</span>
                    </a>
                    <a href="{{ route('social.redirect', 'github') }}"
                        class="flex justify-center items-center gap-2 py-2.5 border border-gray-200 rounded-sm hover:bg-gray-50 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <span class="text-sm font-bold text-gray-600">GitHub</span>
                    </a>
                </div>

                <p class="text-center text-sm text-gray-500">
                    New to Game Central? <a href="{{ route('register') }}"
                        class="font-bold text-ewc-black hover:text-ewc-gold transition underline">Create Account</a>
                </p>
            </div>
        </div>
    </div>
@endsection