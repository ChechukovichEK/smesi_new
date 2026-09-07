<div class="home-offer-slider">
	<div class="slides swiper slides-home">
		<div class="swiper-wrapper">
			<?php $keySlider = 0 ?>
			<?php foreach ($slider as $slide): ?>
				<?php if ($slide['status'] === '1'): ?>
					<div class="slider-item swiper-slide <?php if (!empty($slide['text'])): ?><?= $slide['text'] ?><?php endif; ?>" <?php if (!empty($slide['background'])): ?><?= 'style = "background-image:' . $slide['background'] . '"' ?><?php endif; ?>>
						<a class="show-full"
						   href="<?= empty($slide['link_url']) ? '#modalFeedback' : h($slide['link_url'])  ?>"
							<?= empty($slide['link_url']) ? 'data-toggle="modal-new" data-feedback="Заказать звонок: подвал"' : ''  ?> >
							<picture>
								<source media="(min-width: 900px)" srcset="images/<?= h($slide['slider_img']); ?>">
								<source media="(min-width: 600px)" srcset="images/<?= h($slide['slider_img2']); ?>">
								<source media="(max-width: 600px)" srcset="images/<?= h($slide['slider_img3']); ?>">
								<img <?php if ($keySlider != 0): ?>loading="lazy"<?php endif; ?>
									 src="images/<?= h($slide['slider_img']); ?>" alt="<?= h($slide['title']); ?>">
							</picture>
						</a>
					</div>
					<?php $keySlider = $keySlider + 1 ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="swiper-button-prev swiper-button-prev-slides-home"></div>
		<div class="swiper-button-next swiper-button-next-slides-home"></div>
	</div>
</div>
