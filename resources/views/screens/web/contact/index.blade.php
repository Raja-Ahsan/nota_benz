@extends('layouts.web.master')

@section('title', 'Hello')

@push('body-class')
inner-site
@endpush

@section('content')
@php
    $inputClass =
        'manrope-font w-full border border-[color-mix(in_srgb,var(--text-color)_18%,transparent)] bg-white px-4 py-3 text-sm text-[var(--text-color)] outline-none transition placeholder:text-neutral-400 focus:border-[var(--primary-color)] focus:ring-2 focus:ring-[var(--primary-color)]/20 sm:text-[15px]';
    $labelClass = 'manrope-font mb-2 block text-[11px] font-bold uppercase tracking-[0.22em] text-[var(--text-color)]';
@endphp

<main id="contact-main">
    <section class="relative isolate min-h-[42svh] overflow-hidden sm:min-h-[48svh]" aria-label="{{ __('Contact hero') }}">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div
                class="absolute inset-0 h-full w-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('assets/images/slider-img-02.png') }}');"
                role="presentation"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/55 to-black/35" aria-hidden="true"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/35"></div>
        </div>

        <div class="container relative z-10 flex min-h-[42svh] flex-col justify-center py-20 sm:min-h-[48svh] sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-3xl space-y-6 pt-16 sm:pt-20 lg:pt-8">
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 shrink-0 bg-primary-color" aria-hidden="true"></span>
                    <p class="text-[15px] italic text-white sm:text-[16px]">
                        <span class="text-secondary manrope-font tracking-[3.6px]">NOTaBENZ</span>
                        <span class="text-primary mx-2 manrope-font" aria-hidden="true">·</span>
                        <span class="text-white/65 cormorant-font tracking-[1.02px]">Say hello</span>
                    </p>
                </div>

                <h1 class="syne-font text-[36px] font-extrabold uppercase leading-[1.05] tracking-tight text-white sm:text-[48px] md:text-[60px]">
                    Hello
                </h1>

                <p class="max-w-xl cormorant-font text-[17px] leading-relaxed text-white/80 sm:text-[20px]">
                    {{ __('Questions, collaborations, or a quiet note — write from the form below. Charlottesville is home base.') }}
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 sm:py-16 md:py-20" aria-labelledby="contact-heading">
        <div class="container">
            <div class="mb-10 max-w-2xl">
                <h2 id="contact-heading" class="syne-font text-xs font-extrabold uppercase tracking-[0.35em] text-secondary">
                    {{ __('Get in touch') }}
                </h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-2 lg:gap-10 lg:items-stretch">
                {{-- Map --}}
                <div class="flex min-h-[360px] flex-col overflow-hidden border border-[color-mix(in_srgb,var(--text-color)_12%,transparent)] bg-[color-mix(in_srgb,var(--secondary-color)_6%,white)] sm:min-h-[480px]">
                    <div class="border-b border-[color-mix(in_srgb,var(--text-color)_10%,transparent)] px-5 py-4 sm:px-6">
                        <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.22em] text-secondary">{{ __('Location') }}</p>
                        <p class="mt-1 manrope-font text-sm text-[var(--text-color)]">Charlottesville, VA 22902 USA</p>
                        <a
                            href="mailto:info@notabenz.com"
                            class="mt-1 inline-block manrope-font text-sm text-secondary underline-offset-2 hover:underline"
                        >info@notabenz.com</a>
                    </div>
                    <div class="relative min-h-0 flex-1">
                        <iframe
                            title="{{ __('NOTaBENZ location — Charlottesville, VA') }}"
                            class="absolute inset-0 h-full w-full border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                            src="https://maps.google.com/maps?q=Charlottesville%2C%20VA%2022902%20USA&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        ></iframe>
                    </div>
                </div>

                {{-- Form --}}
                <div class="border border-[color-mix(in_srgb,var(--text-color)_12%,transparent)] bg-white p-6 sm:p-8 md:p-10">
                    <p class="manrope-font text-[11px] font-bold uppercase tracking-[0.22em] text-secondary">{{ __('Send a note') }}</p>
                    <h3 class="mt-2 syne-font text-2xl font-extrabold uppercase tracking-tight text-[var(--text-color)]">
                        {{ __('Write to us') }}
                    </h3>
                    <p class="mt-2 cormorant-font text-base text-dim-black/80 sm:text-lg">
                        {{ __('We read every message. Share what you’re working on or asking about.') }}
                    </p>

                    <form id="contact-form" method="POST" action="{{ route('hello.store') }}" class="mt-8 space-y-5" novalidate>
                        @csrf
                        <div>
                            <label for="name" class="{{ $labelClass }}">{{ __('Name') }} <span class="text-primary">*</span></label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="{{ $inputClass }}"
                                placeholder="{{ __('Your name') }}"
                                required
                                autocomplete="name"
                            >
                        </div>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="email" class="{{ $labelClass }}">{{ __('Email') }} <span class="text-primary">*</span></label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="{{ $inputClass }}"
                                    placeholder="{{ __('you@example.com') }}"
                                    required
                                    autocomplete="email"
                                >
                            </div>
                            <div>
                                <label for="phone" class="{{ $labelClass }}">{{ __('Phone') }}</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="{{ $inputClass }}"
                                    placeholder="{{ __('Optional') }}"
                                    autocomplete="tel"
                                >
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="{{ $labelClass }}">{{ __('Subject') }}</label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="{{ $inputClass }}"
                                placeholder="{{ __('What is this about?') }}"
                            >
                        </div>
                        <div>
                            <label for="message" class="{{ $labelClass }}">{{ __('Message') }} <span class="text-primary">*</span></label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                class="{{ $inputClass }} resize-y min-h-[140px]"
                                placeholder="{{ __('Write your message…') }}"
                                required
                            ></textarea>
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary" id="contact-submit-btn">
                                {{ __('Send message') }}
                                <span class="pl-[20px] text-[15px]" aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    (function () {
        const form = document.getElementById('contact-form');
        if (!form) return;

        const submitBtn = document.getElementById('contact-submit-btn');
        const btnOriginalHtml = submitBtn ? submitBtn.innerHTML : '';

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = @json(__('Sending…'));
            }

            form.querySelectorAll('.contact-field-error').forEach((el) => el.remove());
            form.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: new FormData(form),
                });

                const data = await response.json().catch(() => ({}));

                if (response.ok && data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message || @json(__('Thank you — your message has been sent.')),
                        showConfirmButton: false,
                        timer: 2200,
                    });
                    form.reset();
                    return;
                }

                if (response.status === 422 && data.errors) {
                    Object.keys(data.errors).forEach((key) => {
                        const field = form.querySelector(`[name="${key}"]`);
                        if (!field) return;
                        field.classList.add('is-invalid');
                        const err = document.createElement('span');
                        err.className = 'contact-field-error mt-1 block text-sm text-red-600';
                        err.textContent = data.errors[key][0];
                        field.insertAdjacentElement('afterend', err);
                    });
                    Swal.fire({
                        icon: 'warning',
                        title: @json(__('Please check the form')),
                        text: data.message || @json(__('Some fields need attention.')),
                    });
                    return;
                }

                Swal.fire({
                    icon: 'error',
                    title: @json(__('Something went wrong')),
                    text: data.message || @json(__('Please try again in a moment.')),
                });
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: @json(__('Network error')),
                    text: @json(__('Check your connection and try again.')),
                });
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnOriginalHtml;
                }
            }
        });
    })();
</script>
@endpush
