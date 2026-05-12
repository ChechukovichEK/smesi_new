<?php $email = \ishop\App::$app->getProperty('settings')['email'] ?>
<footer>
	<div class="footer" itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="name" content="<?= \ishop\App::$app->getProperty('settings')['name_organization'] ?>">
		<meta itemprop="telephone" content="<?= \ishop\App::$app->getProperty('phone')['link'] ?>">
		<meta itemprop="email" content="<?= $email ?>">
		<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<meta itemprop="streetAddress" content="<?= \ishop\App::$app->getProperty('settings')['address_street'] ?>">
			<meta itemprop="postalCode" content="<?= \ishop\App::$app->getProperty('settings')['postal_code'] ?>">
			<meta itemprop="addressLocality" content="<?= \ishop\App::$app->getProperty('settings')['address_locality'] ?>">
		</span>
		<div class="footer-content">
			
			<div class="logo-nav">
				
				<?php if (!empty(\ishop\App::$app->getProperty('settings')['logo_footer'])): ?>
					
					<div class="logo-ft">
						<a href="<?= PATH ?>" class="logo">
							<img loading="lazy"
								 src="<?= PATH ?>/img/<?= \ishop\App::$app->getProperty('settings')['logo_footer'] ?>"
								 alt="Smesi.by - Интернет-гипермаркет строительных материалов">
						</a>
					</div>
				
				<?php endif; ?>
				
				<div class="nav-gamb-ft hover">
					<p>МЕНЮ</p>
					<div class="nav-gamb">
						<img loading="lazy" src="<?= PATH ?>/images/gamburger.svg" alt="Каталог">
					</div>
				</div>
				
				<div class="nav-gor-ft">
					<div class="nav-schedule">
						<div class="title">Время работы склада</div>
						<div class="schedule">
							<?= \ishop\App::$app->getProperty('settings')['schedule'] ?>
						</div>
					</div>
					
					<nav>
						<?php $menu_footer = \ishop\App::$app->getProperty('nav_footer');
						if ($menu_footer): ?>
							<?php foreach ($menu_footer as $item): ?>
								<a class="nav-item-ft hover" href="<?= PATH ?><?= $item['link'] ?>">
									<?= $item['title'] ?>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</nav>
				</div>
			</div>
			
			<div class="cat-ft">
				<div class="cat-fthid hover">
					<div>
						<p>КАТАЛОГ</p>
						<div class="cat-gamb">
							<img loading="lazy" src="<?= PATH ?>/images/gamburger.svg" alt="Каталог">
						</div>
					</div>
				</div>
				<p class="cat-ttl">
					Каталог
				</p>
				
				<div class="cat-ft-wrap">
					<?php if (!isset($_GET['catalog'])) {
						new \app\widgets\menu\Menu([
							'tpl' => WWW . '/menu/menu_footer.php',
							'container' => 'div',
							'class' => 'cat-ft-items',
						]);
					} ?>
				</div>
			</div>
			
			<div class="ft-contacts">
				
				<div class="ft-phones">
					<a
							class="phone-conv hover"
							href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
							onclick="gtag('event', 'call_click'); return true;"
							rel="nofollow"
					>
						<?= \ishop\App::$app->getProperty('phone')['text'] ?>
					</a>
					
					<a
							class="viber cont-icon hover"
							href="viber://chat?number=%2B375445920533"
							onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
							rel="nofollow"
					>
						<img
								loading="lazy"
								src="img/icons/social/viber.svg"
								alt="Вы можете связаться с нами по Viber"
						>
					</a>
					<a
							class="tg cont-icon hover"
							href="https://t.me/+375445920533"
							onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
							rel="nofollow"
					>
						<img
								loading="lazy"
								src="img/icons/social/telegram.svg"
								alt="Вы можете связаться с нами в Telegram"
						>
					</a>
				</div>
				<div class="ft-email">
					<a href="mailto:<?= $email ?>"><?= $email ?></a>
				</div>
				<div class="ft-btn">
					<p>Перезвони мне</p>
				</div>
				
				<div class="ft-info">
					<?= \ishop\App::$app->getProperty('settings')['legal_entity'] ?>
				</div>
				<div class="nav-schedule-mobile">
					<div class="title">Время работы склада</div>
					<div class="schedule">
						<?= \ishop\App::$app->getProperty('settings')['schedule'] ?>
					</div>
				</div>
				<div class="nav-gor-ft nav-groups">
					<nav>
						<a class="nav-item-ft hover" href="https://vk.com/smesiby" target="_blank" rel="nofollow">
							<img
									loading="lazy"
									src="img/icons/social/vk.svg"
									alt="Сообщество ВКонтакте"
							>
						</a>
						<a class="nav-item-ft hover" href="https://www.facebook.com/profile.php?id=61573075610960"
						   target="_blank" rel="nofollow">
							<img
									loading="lazy"
									src="img/icons/social/facebook.svg"
									alt="Cообщество Facebook"
							>
						</a>
					</nav>
				</div>
				<div class="footer-pay">
					<div class="footer-pay-block">
						<div class="text">Мы принимаем</div>
						<div class="footer-pay-list">
							<img src="<?= PATH ?>/img/icons/pay/visa.svg" class="item item-visa" alt="visa">
							<img src="<?= PATH ?>/img/icons/pay/master.svg" class="item" alt="MasterCard">
							<img src="<?= PATH ?>/img/icons/pay/erip.svg" class="item" alt="ЕРИП">
							<img src="<?= PATH ?>/img/icons/pay/epos.svg" class="item" alt="E-POS">
						</div>
					</div>
				</div>
			</div>
			<?= \ishop\App::$app->getProperty('settings')['legal_entity'] ?>
		</div>
		
	</div>
	
	<div class="cr">
		<div class="cr-content">
			<?= !empty(\ishop\App::$app->getProperty('settings')['copyright']) ? \ishop\App::$app->getProperty('settings')['copyright'] : '' ?>
		</div>
	</div>
</footer>