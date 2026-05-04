<header class="header" id="header">
	
	<?php require APP . '/views/layouts/components/search-form.php'; ?>
	
	<div class="header-bottom">
		<div class="container">
			<a href="/" class="logo">
				<img src="<?= PATH ?>/img/logo-dark.svg" alt="Smesi.by - Интернет-гипермаркет строительных материалов">
			</a>
			
			<div class="phones">
				<div class="phone-top">
					<div class="phone-bottom">
						<div class="all-open hover">
							<div class="phone-conv hover" title="Все контакты">
								<?= \ishop\App::$app->getProperty('phone')['text'] ?>
							</div>
						</div>
						<div class="all-contacts">
							<div class="phone-top-all">
								<a
										class="phone-conv cont-icon hover"
										href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
										rel="nofollow"
								>
									<img
											loading="lazy"
											src="img/icons/social/phone.svg"
											alt="Вы можете связаться с нами по телефону - <?= \ishop\App::$app->getProperty('phone')['text'] ?>"
									>
								</a>
								<a
										class="phone-conv hover"
										href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
										rel="nofollow"
								>
									<?= \ishop\App::$app->getProperty('phone')['text'] ?>
								</a>
							</div>
							
							<? foreach (\ishop\App::$app->getProperty('additional_phones') as $additional_phone): ?>
								<div class="phone-top-all">
									<a
											class="phone-conv cont-icon hover"
											href="tel:<?= $additional_phone['link'] ?>"
											rel="nofollow"
									>
										<img
												loading="lazy"
												src="img/icons/social/phone.svg"
												alt="Вы можете связаться с нами по телефону - <?= $additional_phone['text'] ?>"
										>
									</a>
									<a
											class="phone-conv hover"
											href="tel:<?= $additional_phone['link'] ?>"
											rel="nofollow"
									>
										<?= $additional_phone['text'] ?>
									</a>
								</div>
							<? endforeach; ?>
							
							<div class="phone-top-all">
								<a
										class="phone-conv cont-icon hover"
										href="tel:+375172344018"
										rel="nofollow"
								>
									<img loading="lazy" src="images/old-tel.svg"
										 alt="Вы можете связаться с нами по телефону - +375172344018">
								</a>
								<a
										class="phone-conv hover"
										href="tel:+375172344018"
										rel="nofollow"
								>
									+375 (17) 234-40-18
								</a>
							</div>
						</div>
					</div>
					<a class="viber cont-icon hover" href="viber://chat?number=%2B375445920533"
					   onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
					   rel="nofollow">
						<img
								src="img/icons/social/viber.svg"
								alt="Вы можете связаться с нами по Viber">
					</a>
					<a
							class="tg cont-icon hover"
							href="https://t.me/+375445920533"
							onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
							rel="nofollow"
					>
						<img
								src="img/icons/social/telegram.svg"
								alt="Вы можете связаться с нами в Telegram"
						>
					</a>
				</div>
				<div class="email">
					<?php $email = \ishop\App::$app->getProperty('email')['text']; ?>
					<a href="mailto:<?= $email ?>"><?= $email ?></a>
				</div>
			</div>
			
			<a class="delivery" href="<?= PATH ?>/page/dostavka-i-oplata">Доставка и самовывоз!</a>
			
			<div class="enter">
				<div class="enter-button">
					<?php if (!empty($_SESSION['user'])): ?>
						<?= $_SESSION['user']['name']; ?>
					<?php else: ?>
						Аккаунт
					<?php endif; ?>
				</div>
				
				<?php if (!empty($_SESSION['user'])): ?>
					<div class="enter-open">
						<a class="open-enter" href="<?= PATH ?>/user/logout">Выход</a>
						<a class="open-reg" href="<?= PATH ?>/user/cabinet">Личный кабинет</a>
					</div>
				<?php else: ?>
					<div class="enter-open">
						<a class="open-enter" href="<?= PATH ?>/user/login">Вход</a>
						<a class="open-reg" href="<?= PATH ?>/user/signup">Регистрация</a>
					</div>
				<?php endif; ?>
			</div>
			
			<a href="cart/view" class="cart">
				<?php if (isset($_SESSION['cart.qty']) && !empty($_SESSION['cart.qty']) && !isset($_SESSION['user'])): ?>
					<span><?= $_SESSION['cart.qty']; ?></span>
				<?php endif; ?>
				<?php if (!empty($_SESSION['user'])): ?>
					<?php $cart_qtytop = \ishop\App::$app->getProperty('cart_qtytop'); ?>
					<span><?= $cart_qtytop; ?></span>
				<?php endif; ?>
				Корзина
			</a>
		</div>
	</div>
</header>