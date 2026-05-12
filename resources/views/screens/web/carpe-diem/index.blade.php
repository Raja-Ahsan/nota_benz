@extends('layouts.web.master')

@section('title', 'Blogs')
@push('body-class')
inner-site
@endpush
@section('content')
<section class="carpe-diem-banner relative">
    <video
        autoplay
        muted
        loop
        playsinline
        poster="{{ asset('assets/images/video-01-frame.avif') }}">
        <source src="{{ asset('assets/images/video-01.mp4') }}" type="video/mp4">
    </video>
    <div class="carpe-diem-banner-content text-center absolute top-1/2 left-1/2 w-[calc(100%-2rem)] max-w-3xl -translate-x-1/2 -translate-y-1/2 px-2 sm:w-auto sm:px-0">
        <h1 class="inner-banner-hd">Carpe Diem</h1>
        <p class="font-medium leading-relaxed cormorant-font text-[17px] text-white/80 sm:text-[20px] sm:tracking-[0.03em]">
            The desire to Seize a Moment. The moment. Pictures, Portraits, Images to grasp a glance, to hold an instant, grabbing a moment to catch and make Time stand still.
        </p>
    </div>
</section>
<section class="animated-slider-sec py-[100px]">
    <div class="container-fluid">
        <div class="swiper animated-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/01.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/02.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/03.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/04.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/05.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/06.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/07.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/08.jpg')}}" />
                </div>

                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/09.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/10.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/11.jpg')}}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('assets/images/carpedeim/animated-slider/12.jpg')}}" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<section class="parallax-reveal-section relative bg-white pb-10 md:pb-[100px]" aria-label="{{ __('Featured image') }}">
    <div class="parallax-reveal-scroll relative w-full max-md:min-h-0 md:min-h-[165vh]">
        <div class="parallax-reveal-sticky flex w-full items-center justify-center overflow-hidden max-md:static max-md:min-h-0 max-md:py-4 md:sticky md:top-0 md:h-screen md:min-h-0 md:py-0">
            <div
                class="js-parallax-reveal-frame mx-auto max-w-none overflow-hidden bg-neutral-100 shadow-sm ring-1 ring-black/5 max-md:w-full max-md:rounded-xl md:rounded-3xl"
                style="width: 82%; border-radius: 1.5rem;">
                <img
                    class="parallax-reveal-img block aspect-[4/3] w-full object-cover sm:aspect-[16/10] md:aspect-[21/9]"
                    src="{{ asset('assets/images/carpedeim/banner-01.avif') }}"
                    alt=""
                    loading="lazy"
                    width="1600"
                    height="900">
            </div>
        </div>
    </div>
</section>
<section class="scenes-sec mb-[100px]">
    <div class="container">
        <h2 class="mt-3 syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-dim-black sm:text-3xl md:text-4xl text-center">SCENES AND COMPOSITIONS</h2>
    </div>
</section>
<section class="carpe-triple-slider-sec pb-[100px] relative w-full overflow-hidden bg-white">
    <div class="swiper cd-triple-swiper">
        <div class="swiper-wrapper">
            @foreach (['01', '02', '03', '04'] as $slide)
            <div class="swiper-slide">
                <img
                    class="cd-triple-swiper-img"
                    src="{{ asset('images/carpediem/slider/' . $slide . '.avif') }}"
                    alt=""
                    loading="lazy"
                    width="800"
                    height="500">
            </div>
            @endforeach
        </div>
    </div>
    <button type="button" class="cd-triple-swiper-nav cd-triple-swiper-nav--prev swiper-button-prev" aria-label="{{ __('Previous slide') }}">

    </button>
    <button type="button" class="cd-triple-swiper-nav cd-triple-swiper-nav--next swiper-button-next" aria-label="{{ __('Next slide') }}">

    </button>
</section>
<section class="scenes-sec mi-camino-sec mb-[100px]">
    <div class="container">
        <h2 class="mt-3 syne-font text-2xl font-extrabold uppercase leading-tight tracking-tight text-dim-black sm:text-3xl md:text-4xl text-center">MI CAMINO</h2>
    </div>
</section>
<section class="gallery-sec">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="gallery-img-wrapper">
                <img src="{{ asset('assets/images/carpedeim/gallery/01.avif') }}" alt="">
            </div>
            <div class="gallery-img-wrapper">
                <img src="{{ asset('assets/images/carpedeim/gallery/02.avif') }}" alt="">
            </div>
            <div class="gallery-img-wrapper">
                <img src="{{ asset('assets/images/carpedeim/gallery/03.avif') }}" alt="">
            </div>
            <div class="gallery-img-wrapper">
                <img src="{{ asset('assets/images/carpedeim/gallery/04.avif') }}" alt="">
            </div>
        </div>
    </div>
</section>
@endsection