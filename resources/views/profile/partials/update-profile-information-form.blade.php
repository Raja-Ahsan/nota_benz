<section class="auth-profile-section">
    <header class="auth-profile-section__header">
        <h2 class="auth-profile-section__title">
            {{ __('Profile Information') }}
        </h2>

        <p class="auth-profile-section__lede">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="auth-form">
        @csrf
        @method('patch')

        <div class="auth-field">
            <label for="name" class="auth-label">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="auth-input"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="auth-error mt-2 list-none" />
        </div>

        <div class="auth-field">
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                class="auth-input"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="auth-error mt-2 list-none" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="auth-verify-hint">
                    <p>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" type="submit" class="text-left">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-emerald-300/95">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="auth-profile-actions">
            <button type="submit" class="btn btn-primary auth-btn-submit">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
