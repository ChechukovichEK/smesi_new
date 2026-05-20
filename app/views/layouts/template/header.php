<header class="header" id="header">
	
	<?php require APP . '/views/layouts/components/search-form.php'; ?>
	
	<div class="header-bottom">
		<div class="container">
			<a href="<?= PATH ?>" class="logo">
				<img src="<?= PATH ?>/img/logo-dark.svg" alt="Smesi.by - Интернет-гипермаркет строительных материалов">
			</a>
			
			<div class="phones">
				<div class="phone-top">
					<div class="phone-bottom">
						<div class="all-open hover">
							<div class="phone-conv hover" title="Все контакты">
								<?= \ishop\App::$app->getProperty('settings')['phone']; ?>
							</div>
						</div>
						<div class="all-contacts">
							<?php $phones = \ishop\App::$app->getProperty('phones'); ?>
							
							<?php if(!empty($phones)): ?>
								
								<?php foreach ( $phones as $phone): ?>
								
										<a class="link" href="tel:<?= $phone['link'] ?>" onclick="gtag('event', 'call_click'); return true;"
										   rel="nofollow" >
										<?php if ($phone['link'] != '+375172344018'):?>
												<img src="<?= PATH ?>/img/icons/social/phone.svg">
										<?php else: ?>
												<img src="<?= PATH ?>/images/old-tel.svg">
										<?php endif; ?>
											<?= $phone['title'] ?>
										</a>
									
								<?php endforeach; ?>
							
							<?php endif; ?>
						</div>
					</div>
					
					
					<?php $socials = \ishop\App::$app->getProperty('socials') ?>
					
					<?php if (!empty($socials)): ?>
						
						<div class="socials">
							<?php foreach ($socials as $social): ?>
								<?php if (in_array($social['key'], ['viber', 'telegram'])): ?>
									<a href="<?= $social['link'] ?>" target="_blank"
									   onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
									   rel="nofollow" class="social-icon social-icon-<?= $social['key'] ?>"></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					
					<?php endif; ?>
					
				</div>
			</div>
			
			<div class="email">
				<?php $email = \ishop\App::$app->getProperty('settings')['email']; ?>
				<a href="mailto:<?= $email ?>"><?= $email ?></a>
			</div>
			
			<a class="delivery" href="<?= PATH ?>/page/dostavka-i-oplata">Доставка и самовывоз!</a>
			
			<div class="header-bottom-actions">
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
						<span><?= ($_SESSION['cart.qty'] > 99) ? '+99' : $_SESSION['cart.qty']; ?></span>
					<?php endif; ?>
					<?php if (!empty($_SESSION['user'])): ?>
						<?php $cart_qtytop = \ishop\App::$app->getProperty('cart_qtytop'); ?>
						<span><?= ($cart_qtytop > 99) ? '+99' : $cart_qtytop; ?></span>
					<?php endif; ?>
					Корзина
				</a>
				
				
				<a href="#modalPhone" class="phones" data-toggle="modal-new"></a>
				
				<a href="#modalSearch" class="search" data-toggle="modal-new"></a>
			
			</div>
		</div>
	</div>
</header>