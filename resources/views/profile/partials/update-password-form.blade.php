<section class="auth-profile-section">
    <header class="auth-profile-section__header">
        <h2 class="auth-profile-section__title">
            {{ __('Update Password') }}
        </h2>

        <p class="auth-profile-section__lede">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        @method('put')

        <div class="auth-field">
            <label for="update_password_current_password" class="auth-label">{{ __('Current Password') }}</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="auth-input"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="auth-error mt-2 list-none" />
        </div>

        <div class="auth-field">
            <label for="update_password_password" class="auth-label">{{ __('New Password') }}</label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="auth-input"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="auth-error mt-2 list-none" />
        </div>

        <div class="auth-field">
            <label for="update_password_password_confirmation" class="auth-label">{{ __('Confirm Password') }}</label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="auth-input"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="auth-error mt-2 list-none" />
        </div>

        <div class="auth-profile-actions">
            <button type="submit" class="btn btn-primary auth-btn-submit">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-white/60"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
