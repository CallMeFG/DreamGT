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
                    <p class="text-gray-500 text-sm mt-2">
                        Masuk untuk melanjutkan proggress Anda.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Username</label>
                        <input name="login" type="text" required autofocus
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm text-sm text-ewc-black focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all placeholder-gray-400"
                            placeholder="usernamenn" value="{{ old('login') }}">
                        <x-input-error :messages="$errors->get('login')" class="mt-1" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-bold text-ewc-black uppercase">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-bold text-ewc-gold hover:underline">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <input name="password" type="password" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-sm text-sm text-ewc-black focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <label class="flex items-center cursor-pointer">
                        <input name="remember" type="checkbox"
                            class="rounded border-gray-300 text-ewc-gold shadow-sm focus:ring-ewc-gold">
                        <span class="ml-2 text-sm text-gray-500 font-medium">Keep me signed in</span>
                    </label>

                    <button type="submit"
                        class="w-full py-3.5 px-4 bg-ewc-black text-white font-bold uppercase tracking-wider rounded-sm hover:bg-gray-800 transition-all shadow-lg transform hover:-translate-y-0.5">
                        Sign In
                    </button>
                </form>

                <div class="relative py-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-gray-400">Or
                            continue with</span></div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <button type="button"
                        class="flex justify-center items-center gap-2 py-2.5 border border-gray-200 rounded-sm hover:bg-gray-50 transition">
                        <span class="text-sm font-bold text-gray-600">Google</span>
                    </button>
                    <button type="button"
                        class="flex justify-center items-center gap-2 py-2.5 border border-gray-200 rounded-sm hover:bg-gray-50 transition">
                        <span class="text-sm font-bold text-gray-600">GitHub</span>
                    </button>
                </div>

                <p class="text-center text-sm text-gray-500">
                    New to Game Central?
                    <a href="{{ route('register') }}"
                        class="font-bold text-ewc-black hover:text-ewc-gold transition underline">Create Account</a>
                </p>
            </div>
        </div>
    </div>
@endsection