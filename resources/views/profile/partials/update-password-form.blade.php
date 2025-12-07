<section>
    <header class="mb-6">
        <h2 class="text-lg font-black text-ewc-black uppercase tracking-wide">
            Update Password
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-xs font-bold text-gray-700 uppercase mb-2">Current
                Password</label>
            <input id="current_password" name="current_password" type="password"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all text-sm"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-xs font-bold text-gray-700 uppercase mb-2">New Password</label>
            <input id="password" name="password" type="password"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all text-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase mb-2">Confirm
                Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all text-sm"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-2 bg-ewc-gold text-black font-bold uppercase text-xs tracking-widest rounded-sm hover:bg-yellow-400 transition-colors">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>