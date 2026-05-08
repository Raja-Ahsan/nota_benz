@extends('layouts.web.master')

@section('title', 'Blogs')

@section('content')
<section class="carpe-diem-banner">
    <div class="container-fluid">
        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper carpe-diem-banner-slider">
            <div class="parallax-bg" style="
          background-image: url(https://swiperjs.com/demos/images/abstract-1.jpg);
        " data-swiper-parallax="-23%"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <!-- <div class="subtitle" data-swiper-parallax="-200">Subtitle</div> -->
                        <h1 data-swiper-parallax="-200" class="text-[40px] font-extrabold uppercase leading-[1.05] tracking-tight text-white  md:text-[80px] syne-font tracking-[4.16px]">
                            <span class="block">MY LIFE.</span>
                            <span class="block">MY</span>
                            <span class="block text-[var(--primary-color)] plarfair-font mb-6">OPUS.</span>
                        </h1>
                        <div class="text" data-swiper-parallax="-100">
                            <p class="cormorant-font mt-8 max-w-xl text-[16px] italic leading-[1.7] tracking-[0%] text-white/60  sm:mt-10 sm:max-w-2xl md:text-[20px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                                laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                                Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                                Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                                ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                                tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <h1 data-swiper-parallax="-300" class="text-[40px] font-extrabold uppercase leading-[1.05] tracking-tight text-white  md:text-[80px] syne-font tracking-[4.16px]">
                            <span class="block">MY LIFE.</span>
                            <span class="block">MY</span>
                            <span class="block text-[var(--primary-color)] plarfair-font mb-6">OPUS.</span>
                        </h1>
                        <div class="text" data-swiper-parallax="-200">
                            <p class="cormorant-font mt-8 max-w-xl text-[16px] italic leading-[1.7] tracking-[0%] text-white/60  sm:mt-10 sm:max-w-2xl md:text-[20px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                                laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                                Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                                Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                                ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                                tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                    <h1 data-swiper-parallax="-300" class="text-[40px] font-extrabold uppercase leading-[1.05] tracking-tight text-white  md:text-[80px] syne-font tracking-[4.16px]">
                            <span class="block">MY LIFE.</span>
                            <span class="block">MY</span>
                            <span class="block text-[var(--primary-color)] plarfair-font mb-6">OPUS.</span>
                        </h1>
                        <div class="text" data-swiper-parallax="-200">
                            <p class="cormorant-font mt-8 max-w-xl text-[16px] italic leading-[1.7] tracking-[0%] text-white/60  sm:mt-10 sm:max-w-2xl md:text-[20px]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla
                                laoreet justo vitae porttitor porttitor. Suspendisse in sem justo.
                                Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod.
                                Aliquam hendrerit lorem at elit facilisis rutrum. Ut at
                                ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec,
                                tincidunt ut libero. Aenean feugiat non eros quis feugiat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
@endsection