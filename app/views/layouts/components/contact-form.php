<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
?>

<?php if ($url != '/page/stat-dilerom-svp-ot-tls-profi'): ?>
<div class="contact-form">
	<div class="container">
		<div class="contact-form-title">Свяжитесь с&nbsp;нами! Мы&nbsp;гарантируем Специальные&nbsp;цены и&nbsp;Бонусы!</div>
		<form class="form" method="post" onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
			<input class="form-input" type="text" name="name_cent" placeholder="Ваше имя" required/>
			<input class="form-input" type="tel" name="tel_cent" placeholder="Ваш телефон" required/>
			<button class="btn-gradient" type="submit" name="submit_tel">Перезвоните мне</button>
		</form>
	</div>
</div>
<?php endif; ?>