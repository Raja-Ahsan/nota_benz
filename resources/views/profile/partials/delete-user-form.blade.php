<section class="auth-profile-section space-y-6">
    <header class="auth-profile-section__header">
        <h2 class="auth-profile-section__title">
            {{ __('Delete Account') }}
        </h2>

        <p class="auth-profile-section__lede">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button
        type="button"
        class="w-full rounded-sm border border-red-400/50 bg-red-600/25 px-4 py-3 text-center text-[11px] font-semibold uppercase tracking-[0.18em] text-red-100 transition-colors hover:bg-red-600/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-400/70 sm:w-auto sm:min-w-[11rem]"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
        max-width="md"
        panel-class="auth-modal-panel mb-6 rounded-sm border border-white/15 bg-black/92 p-0 shadow-2xl backdrop-blur-xl transform transition-all"
    >
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h3 class="auth-profile-section__title">
                {{ __('Are you sure you want to delete your account?') }}
            </h3>

            <p class="auth-profile-section__lede mt-3">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="auth-field mt-6">
                <label for="password" class="auth-label">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="auth-input"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="auth-error mt-2 list-none" />
            </div>

            <div class="auth-actions mt-8">
                <x-secondary-button
                    type="button"
                    class="border-white/20 bg-transparent text-[11px] font-semibold uppercase tracking-[0.16em] text-white/85 hover:bg-white/10 hover:text-white"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="border border-red-500/40 bg-red-600/90 text-[11px] font-semibold uppercase tracking-[0.16em] hover:bg-red-600">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
