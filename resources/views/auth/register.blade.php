@extends('layouts.web.master')

@section('title', __('Register') . ' — ' . config('app.name', 'Laravel'))

@section('content')
    <main class="auth-page" aria-labelledby="auth-register-title">
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


                    <h1 id="auth-register-title" class="auth-card__heading syne-font">
                        Create account
                    </h1>
                    <p class="auth-card__lede cormorant-font">A few details to join the perspective.</p>

                    <form method="POST" action="{{ route('register') }}" class="auth-form">
                        @csrf

                        <div class="auth-field">
                            <x-input-label for="name" :value="__('Name')" class="auth-label" />
                            <x-text-input id="name" class="auth-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-field">
                            <x-input-label for="email" :value="__('Email')" class="auth-label" />
                            <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-field">
                            <x-input-label for="password" :value="__('Password')" class="auth-label" />
                            <x-text-input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-field">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="auth-label" />
                            <x-text-input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="auth-error mt-2" />
                        </div>

                        <div class="auth-actions">
                            <a class="auth-link" href="{{ route('login') }}">
                                Already registered?
                            </a>
                            <button type="submit" class="btn btn-primary auth-btn-submit">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
