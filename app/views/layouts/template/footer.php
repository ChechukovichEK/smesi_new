<?php $email = \ishop\App::$app->getProperty('settings')['email'] ?>
<footer class="footer">
	<div itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="name" content="<?= \ishop\App::$app->getProperty('settings')['name_organization'] ?>">
		<meta itemprop="telephone" content="<?= \ishop\App::$app->getProperty('phone')['link'] ?>">
		<meta itemprop="email" content="<?= $email ?>">
		<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<meta itemprop="streetAddress" content="<?= \ishop\App::$app->getProperty('settings')['address_street'] ?>">
			<meta itemprop="postalCode" content="<?= \ishop\App::$app->getProperty('settings')['postal_code'] ?>">
			<meta itemprop="addressLocality"
				  content="<?= \ishop\App::$app->getProperty('settings')['address_locality'] ?>">
		</span>
		
		<div class="container">
			<div class="footer-top">
				<div class="footer-info">
					
					<?php if (!empty(\ishop\App::$app->getProperty('settings')['logo_footer'])): ?>
						
						<a href="<?= PATH ?>" class="logo">
							<img src="<?= PATH ?>/img/<?= \ishop\App::$app->getProperty('settings')['logo_footer'] ?>"
								 alt="Smesi.by - Интернет-гипермаркет строительных материалов">
						</a>
					
					<?php endif; ?>
					
					<div class="schedule">
						<div class="title">Время работы склада</div>
						<div class="text">
							<?= \ishop\App::$app->getProperty('settings')['schedule'] ?>
						</div>
					</div>
					
					<ul class="nav">
						<?php $menu_footer = \ishop\App::$app->getProperty('nav_footer');
						if ($menu_footer): ?>
							<?php foreach ($menu_footer as $item): ?>
								<a class="link" href="<?= PATH ?><?= $item['link'] ?>">
									<?= $item['title'] ?>
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				
				</div>
				
				<div class="footer-catalog">
					<div class="title">Каталог</div>
					
					<?php if (!isset($_GET['catalog'])) {
						new \app\widgets\menu\Menu([
							'tpl' => WWW . '/menu/menu_footer.php',
							'container' => 'div',
							'class' => 'footer-catalog-list',
						]);
					} ?>
				</div>
				
				<div class="footer-contacts">
					
					<div class="phones">
						<div class="phone-top">
							<div class="phone-bottom">
								<div class="all-open">
									<div class="phone-conv" title="Все контакты">
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
						<a href="mailto:<?= $email ?>"><?= $email ?></a>
					</div>
					
					<div class="ft-btn">
						<p>Перезвони мне</p>
					</div>
					
					<div class="law">
						<?= \ishop\App::$app->getProperty('settings')['legal_entity'] ?>
					</div>
					
					<?php if (!empty($socials)): ?>
						<div class="socials-bottom">
							<?php foreach ($socials as $social): ?>
								<?php if (in_array($social['key'], ['vk', 'facebook'])): ?>
									<a href="<?= $social['link'] ?>" target="_blank" rel="nofollow"
									   class="social-icon social-icon-<?= $social['key'] ?>"></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					
					<?php endif; ?>
					
					<div class="payment">
						<div class="text">Мы принимаем</div>
						<div class="list">
							<img src="<?= PATH ?>/img/icons/pay/visa.svg" class="item item-visa" alt="visa">
							<img src="<?= PATH ?>/img/icons/pay/master.svg" class="item" alt="MasterCard">
							<img src="<?= PATH ?>/img/icons/pay/erip.svg" class="item" alt="ЕРИП">
							<img src="<?= PATH ?>/img/icons/pay/epos.svg" class="item" alt="E-POS">
						</div>
					</div>
				</div>
			
			</div>
		</div>
	
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<?= !empty(\ishop\App::$app->getProperty('settings')['copyright']) ? \ishop\App::$app->getProperty('settings')['copyright'] : '' ?>
		</div>
	</div>
</footer>