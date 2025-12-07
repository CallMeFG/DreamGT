<section>
    <header class="mb-6">
        <h2 class="text-lg font-black text-ewc-black uppercase tracking-wide">
            Profile Information
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold text-gray-700 uppercase mb-2">Full Name</label>
            <input id="name" name="name" type="text"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all text-sm font-bold"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-2">Email Address</label>
            <input id="email" name="email" type="email"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all text-sm font-bold"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-6 py-2 bg-ewc-black text-white font-bold uppercase text-xs tracking-widest rounded-sm hover:bg-gray-800 transition-colors">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>