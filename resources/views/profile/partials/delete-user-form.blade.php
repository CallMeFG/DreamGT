<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-red-600 uppercase tracking-wide">
            Danger Zone
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Once your account is deleted, all of your resources and data will be permanently deleted.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2 bg-red-600 text-white font-bold uppercase text-xs tracking-widest rounded-sm hover:bg-red-700 transition-colors">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-ewc-black uppercase">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of your resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 border border-gray-300 text-gray-600 font-bold uppercase text-xs rounded-sm hover:bg-gray-50">
                    {{ __('Cancel') }}
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white font-bold uppercase text-xs rounded-sm hover:bg-red-700">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>