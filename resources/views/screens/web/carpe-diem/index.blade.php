@extends('layouts.web.master')

@section('title', 'Blogs')

@section('content')
<section class="carpe-diem-banner">
    <div class="container-fluid">
        <h1>Carpe Diem</h1>
    </div>
</section>
<section class="parallax-reveal-section">
</section>
<section class="animated-slider-sec py-[100px]">
    <div class="container-fluid">
        <div class="swiper animated-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-1.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-2.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-3.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-4.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-5.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-6.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-7.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-8.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/abstract-9.jpg" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endsection