@props([
    'message' => '',
    'subMessage' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-neutral-200 bg-neutral-50 px-6 py-12 text-center']) }}>
    <p class="font-playfair text-2xl font-semibold text-neutral-900 md:text-3xl">
        {{ $message }}
    </p>
    @if (! empty($subMessage))
        <p class="mt-3 text-sm text-neutral-600 md:text-base">
            {{ $subMessage }}
        </p>
    @endif
</div>
