<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
?>


<?php if ($url != '/page/stat-dilerom-svp-ot-tls-profi'): ?>
<div class="cta">
	<div class="container">
		<div class="cta-content">
			<div class="cta-description">
				<div class="title">Свяжитесь с&nbsp;нами! Мы&nbsp;гарантируем Специальные&nbsp;цены и&nbsp;Бонусы!</div>
			</div>
			<form action="/feedback/send" method="post" class="cta-form" data-ajax-form
				  onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
				
				<!-- CSRF -->
				<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
				
				<!-- Honeypot -->
				<input type="text" name="surname_cent" value="" style="display:none !important;">
				
				<div class="group">
					<ul class="inputs">
						<li>
							<input type="text" name="name_cent" class="form-input" placeholder="Ваше Имя"
								   data-input="text">
						</li>
						<li>
							<input type="tel" name="tel_cent" class="form-input" placeholder="Телефон"
								   data-input="num">
						</li>
					</ul>
					
					<div class="action">
						<button class="btn-gradient" type="submit">Отправить</button>
						<input type="hidden" name="prod_title" id="modalFeedbackTask" value="">
					</div>
				</div>
				
				<label class="checker-item form-terms">
					<div class="checker">
						<input type="checkbox" data-form-agree value="1" checked>
						<i class="checker-view"></i>
					</div>
					<div class="checker-label">
						Я даю согласие на обработку персональных данных в соответствии с
						<a href="<?= PATH ?>/page" target="_blank">политикой конфиденциальности</a>
					</div>
				</label>
			</form>
		</div>
	</div>
	<picture class="cta-bg">
		<img class="image" src="<?= PATH ?>/img/home/contact-form-bg.jpg" data-no-webp>
	</picture>

</div>
<?php endif; ?>





