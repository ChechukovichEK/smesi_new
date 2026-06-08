<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
?>

<?php if ($url != '/page/stat-dilerom-svp-ot-tls-profi'): ?>
<div class="contact-form">
	<div class="container">
		<div class="contact-form-title">Свяжитесь с&nbsp;нами! Мы&nbsp;гарантируем Специальные&nbsp;цены и&nbsp;Бонусы!</div>
		
		<form action="/feedback/send" method="post" class="form" data-ajax-form
			  onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
			
			<!-- CSRF -->
			<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
			
			<!-- Honeypot -->
			<input type="text" name="surname_cent" value="" style="display:none !important;">
			
			<ul class="inputs">
				<li>
					<input type="text" name="name_cent" class="form-input form-input-gray" placeholder="Ваше Имя"
						   data-input="text" required>
				</li>
				<li>
					<input type="tel" name="tel_cent" class="form-input form-input-gray" placeholder="Телефон"
						   data-input="num" required>
				</li>
			</ul>
			
			<div class="action">
				<button class="btn-gradient" type="submit">Отправить</button>
				<input type="hidden" name="prod_title" id="modalFeedbackTask" value="">
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
<?php endif; ?>


