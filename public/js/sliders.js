$(document).ready(function() {
    const swiperHome = new Swiper('.slides-home', {
        loop: true,
        autoplay: {
            enabled: false,
        },
        breakpoints: {
            900: {
                autoplay: {
                    enabled: true,
                    delay: 5000,
                    pauseOnMouseEnter: true,
                }
            }
        },
        navigation: {
            nextEl: '.swiper-button-next-slides-home',
            prevEl: '.swiper-button-prev-slides-home',
        },
    });

    const catTopContHome = new Swiper('.cat-top-cont', {
        loop: true,
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next-cat-top-cont',
            prevEl: '.swiper-button-prev-cat-top-cont',
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 10,
            },
            750: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 10,
            },
            950: {
                slidesPerView: 4,
                slidesPerGroup: 3,
                spaceBetween: 20,
            },
            1199: {
                slidesPerView: 5,
                slidesPerGroup: 3,
                spaceBetween: 30,
            },
            1399: {
                slidesPerView: 6,
                slidesPerGroup: 4,
                spaceBetween: 30,
            },
        },
    });
});