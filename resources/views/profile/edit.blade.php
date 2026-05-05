@extends('layouts.web.master')

@section('title', __('Profile') . ' — ' . config('app.name', 'Laravel'))

@section('content')
    <main class="auth-page" aria-labelledby="profile-title">
        <div
            class="auth-page__media bg-cover bg-center bg-no-repeat"
            aria-hidden="true"
            style="background-image: url('{{ asset('assets/images/scene-v-bg-image.png') }}');"
        >
        </div>

        <div class="auth-page__wrap">
            <div class="container auth-page__container auth-page__container--profile">
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

                    <h1 id="profile-title" class="auth-card__heading syne-font">
                        {{ __('Profile') }}
                    </h1>
                    <p class="auth-card__lede cormorant-font">{{ __('Manage your account details and password in one place.') }}</p>

                    @include('profile.partials.update-profile-information-form')

                    @include('profile.partials.update-password-form')

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </main>
@endsection
