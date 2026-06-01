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
	
	const svpSlider = new Swiper('[data-toggle="svp-catalog"]', {
		slidesPerView: 3,
		spaceBetween: 20,
		navigation: {
			nextEl: '.svp-next',
			prevEl: '.svp-prev',
		},
		observer: true,
		observeParents: true,
		observeSlideChildren: true,
		breakpoints: {
			320: { slidesPerView: 1, spaceBetween: 10 },
			768: { slidesPerView: 2, spaceBetween: 15 },
			993: { slidesPerView: 3, spaceBetween: 15 },
			1399: { slidesPerView: 3, spaceBetween: 30 },
		}
	});
	
	const popularSlider = new Swiper('[data-toggle="popular"]', {
		slidesPerView: 3,
		spaceBetween: 20,
		navigation: {
			nextEl: '.svp-next',
			prevEl: '.svp-prev',
		},
		observer: true,
		observeParents: true,
		observeSlideChildren: true,
		breakpoints: {
			320: { slidesPerView: 1, spaceBetween: 10 },
			768: { slidesPerView: 2, spaceBetween: 15 },
			993: { slidesPerView: 3, spaceBetween: 15 },
			1399: { slidesPerView: 4, spaceBetween: 30 },
		}
	});
	
	$(function () {
		
		$('.svp-product-card-image').each(function () {
			
			const $card = $(this);
			const $images = $card.find('.image');
			const $dots = $card.find('.image-dots span');
			const $hovers = $card.find('.image-hover span');
			
			if ($images.length === 0) return;
			
			const setActive = (index) => {
				$images.removeClass('current').eq(index).addClass('current');
				$dots.removeClass('current').eq(index).addClass('current');
			};
			
			// Клик по нижним точкам
			$dots.each(function (i) {
				$(this).on('click', () => setActive(i));
			});
			
			// Наведение на верхние hover‑точки
			$hovers.each(function (i) {
				$(this).on('mouseenter', () => setActive(i));
			});
			
			// --- свайп ---
			let startX = 0;
			let endX = 0;
			
			$card.on('touchstart', function (e) {
				startX = e.originalEvent.touches[0].clientX;
			});
			
			$card.on('touchmove', function (e) {
				endX = e.originalEvent.touches[0].clientX;
			});
			
			$card.on('touchend', function () {
				const diff = endX - startX;
				
				if (Math.abs(diff) < 40) return; // минимальная длина свайпа
				
				let current = $images.index($images.filter('.current'));
				
				if (diff < 0) {
					// свайп влево → следующее изображение
					current = (current + 1) % $images.length;
				} else {
					// свайп вправо → предыдущее изображение
					current = (current - 1 + $images.length) % $images.length;
				}
				
				setActive(current);
			});
			
		});
		
	});
});