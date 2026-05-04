@extends('layouts.web.master')

@section('title', __('Forgot password') . ' — ' . config('app.name', 'Laravel'))

@section('content')
    <main class="auth-page" aria-labelledby="auth-forgot-title">
        <div class="auth-page__media" aria-hidden="true">
            <!-- <video
                class="auth-page__video"
                autoplay
                muted
                loop
                playsinline
                preload="auto">
                <source src="{{ asset('assets/video/hero-section-bg-video.mp4') }}" type="video/mp4" />
            </video> -->
            <div class="auth-page__gradient auth-page__gradient--lr"></div>
            <div class="auth-page__gradient auth-page__gradient--tb"></div>
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

                    <div class="auth-card__eyebrow">
                        <span class="auth-card__eyebrow-line" aria-hidden="true"></span>
                        <p class="auth-card__eyebrow-text">
                            <span class="auth-card__eyebrow-scene manrope-font">{{ __('SCENE') }} <span class="text-primary mx-1.5">I</span></span>
                            <span class="auth-card__eyebrow-sub cormorant-font">{{ __('— Identity / Access') }}</span>
                        </p>
                    </div>

                    <h1 id="auth-forgot-title" class="auth-card__heading syne-font">
                        {{ __('Forgot your password?') }}
                    </h1>
                    <p class="auth-card__copy cormorant-font">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </p>

                    <x-auth-session-status class="auth-flash mb-4 mt-6" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                        @csrf

                        <div class="auth-field">
                            <x-input-label for="email" :value="__('Email')" class="auth-label" />
                            <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-actions">
                            <a class="auth-link" href="{{ route('login') }}">
                                {{ __('Log in') }}
                            </a>
                            <button type="submit" class="btn btn-primary auth-btn-submit auth-btn-submit--wrap">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
