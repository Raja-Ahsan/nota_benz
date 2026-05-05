@extends('layouts.web.master')

@section('title', __('Log in') . ' — ' . config('app.name', 'Laravel'))

@section('content')
    <main class="auth-page" aria-labelledby="auth-login-title">
    <div
            class="auth-page__media bg-cover bg-center bg-no-repeat"
            aria-hidden="true"
            style="background-image: url('{{ asset('assets/images/scene-v-bg-image.png') }}');"
        >
            <!-- <div class="auth-page__gradient auth-page__gradient--lr"></div>
            <div class="auth-page__gradient auth-page__gradient--tb"></div> -->
        </div>

        <div class="auth-page__wrap">
            <div class="container auth-page__container">
                <div class="auth-card">
                    <a href="{{ url('/') }}" class="auth-card__brand">
                        <img
                            src="{{ asset('assets/images/logo.png') }}"
                            alt="{{ config('app.name', 'NOTaBENZ') }}"
                            class="auth-card__brand-img"
                            width="200"
                            height="48"
                            decoding="async"
                        />
                    </a>

               

                    <h1 id="auth-login-title" class="auth-card__heading syne-font">
                        Log in
                    </h1>
                    <p class="auth-card__lede cormorant-font">Welcome back. Continue your perspective.</p>

                    <x-auth-session-status class="auth-flash mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf

                        <div class="auth-field">
                            <x-input-label for="email" :value="__('Email')" class="auth-label" />
                            <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-field">
                            <x-input-label for="password" :value="__('Password')" class="auth-label" />
                            <x-text-input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-remember">
                            <label for="remember_me" class="auth-remember__label">
                                <input id="remember_me" type="checkbox" class="auth-remember__input" name="remember">
                                <span class="auth-remember__text">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="auth-actions @unless (Route::has('password.request')) auth-actions--end @endunless">
                            @if (Route::has('password.request'))
                                <a class="auth-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary auth-btn-submit">
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                        <p class="auth-alt-link">
                            <a class="auth-link auth-link--inline" href="{{ route('register') }}">{{ __('Need an account? Register') }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
