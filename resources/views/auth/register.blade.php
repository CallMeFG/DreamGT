@extends('layouts.app')

@section('content')
    <div class="min-h-full flex items-center justify-center bg-gray-50 p-6 py-12">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden relative">
            <div class="h-2 bg-ewc-gold w-full top-0 left-0 absolute"></div>

            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">
                        Join The <span class="text-ewc-gold">Arena</span>
                    </h2>
                    <p class="text-gray-500 text-sm mt-2">Buat akun member untuk mulai bermain.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Full Name</label>
                            <input name="name" type="text" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"
                                placeholder="John Doe" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Username</label>
                            <input name="username" type="text" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"
                                placeholder="player1" value="{{ old('username') }}">
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Email Address</label>
                        <input name="email" type="email" required
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"
                            placeholder="name@example.com" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Phone Number</label>
                        <input name="phone" type="text"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"
                            placeholder="0812..." value="{{ old('phone') }}">
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>

                    <div x-data="{ show: false }">
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Password</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all pr-10"
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

                    <div x-data="{ show: false }">
                        <label class="block text-xs font-bold text-ewc-black uppercase mb-1">Confirm Password</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-sm text-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all pr-10"
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
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <button type="submit"
                        class="w-full py-3.5 px-4 bg-ewc-gold text-ewc-black font-bold uppercase tracking-wider rounded-sm hover:bg-yellow-400 transition-all shadow-md mt-6 transform hover:-translate-y-0.5">Create
                        Account</button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Already registered? <a href="{{ route('login') }}"
                        class="font-bold text-ewc-black hover:text-ewc-gold transition underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
@endsection