<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href='<?= PATH; ?>'>
						<span itemprop="name">Главная</span>
					</a>
					<meta itemprop="position" content="1">
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href='<?= PATH; ?>/article'>
						<span itemprop="name">Школа ремонта</span>
					</a>
					<meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class='current-crumb'>
			<span itemprop="item">
				<span itemprop="name"><?= $new['title']; ?></span>
			</span>
					<meta itemprop="position" content="3">
				</li>
			</ol>
		</div>
	</div>
</div>
<div class="pages-content" itemscope itemtype="http://schema.org/Article">
	<div class="container container-article">
		<h1><?= $new['title'] ?></h1>
		<div class="data-block">
			<?php $has_update_date = !empty($new['published_at']) && $new['published_at'] !== '0000-00-00 00:00:00'; ?>
			<p class="date">
				<?php if ($has_update_date): ?>
					Обновлено: <?= date('Y-m-d', strtotime($new['published_at'])) ?>
				<?php else: ?>
					Опубликовано: <?= $new['date'] ?>
				<?php endif; ?>
			</p>
			<meta itemprop="datePublished" content="<?= date('c', strtotime($new['date'])); ?>">
			<?php if ($has_update_date): ?>
				<meta itemprop="dateModified" content="<?= date('c', strtotime($new['published_at'])); ?>">
			<?php endif; ?>
		</div>
		
		<div class="text-editor" itemprop="articleBody">
			<?= $new['content'] ?>
		</div>
		
		<?php if (!empty($faq)): ?>
			
			<div class="wholesale-faq" itemscope itemtype="https://schema.org/FAQPage">
				<div class="container">
					<h2 class="title wholesale-title"><?= $faq_title ?></h2>
					<ul class="faq-list" data-toggle="accordion">
						<?php foreach ($faq as $item): ?>
							<li itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
								<div class="faq-item" data-faq>
									<a href="javascript:void(0)" class="top" data-faq-title>
										<div class="title" itemprop="name"><?= $item->title ?></div>
										<i class="toggle">
											<svg width="25" height="14" viewBox="0 0 25 14" fill="none"
												 xmlns="http://www.w3.org/2000/svg">
												<path d="M0.353516 0.353516L12.3535 12.3535L24.3535 0.353516"
													  stroke="black"/>
											</svg>
										</i>
									</a>
									<div class="text text-editor" data-faq-content itemprop="acceptedAnswer" itemscope
										 itemtype="https://schema.org/Answer">
										<div itemprop="text"><?= nl2br($item->text) ?></div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>
	
	</div>
	
	<div class="article-contact-form-container">
		<div class="article-contact-form">
			<div class="content">
				<div class="description">
					<div class="title">
						Получите бесплатную консультацию по выбору или использованию строительных материалов!
					</div>
					<div class="text">Наши эксперты готовы помочь</div>
				</div>
				
				<form action="/feedback/send" class="form" method="post" data-ajax-form onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
					
					<!-- CSRF -->
					<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
					
					<!-- Honeypot -->
					<input type="text" name="surname_cent" value="" style="display:none !important;">
					
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
						<button class="btn-gradient" type="submit">Перезвоните мне</button>
						<input type="hidden" name="prod_title" id="modalFeedbackTask" value="">
					</div>
					
					<label class="checker-item form-terms">
						<div class="checker">
							<input type="checkbox" data-form-agree value="1" checked>
							<i class="checker-view"></i>
						</div>
						<div class="checker-label">
							Я даю согласие на обработку персональных данных в соответствии с
							<a href="<?= PATH ?>/page/politika-obrabotki-personal-nyh-dannyh" target="_blank">политикой конфиденциальности</a>
						</div>
					</label>
				</form>
			</div>
			<div class="bg">
				<img src="../img/home/article-contact-form-bg.jpg">
			</div>
		</div>
	</div>
	
	<div class="container container-article">
		<?php if (!empty($other_articles)): ?>
			<div class="related-articles" style="margin-top: 60px;">
				<div style="margin-bottom: 20px; font-size: 28px; color: #2b2b2b; font-family: 'MyriadProSemibold', sans-serif;">
					Читайте также
				</div>
				<div class="blog-list">
					<?php foreach ($other_articles as $item): ?>
						<?php
						$date = new DateTime($item['date']);
						$has_update_date = !empty($item['published_at']) && $item['published_at'] !== '0000-00-00 00:00:00';
						$updated_date = $has_update_date ? new DateTime($item['published_at']) : null;
						$formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
						$formatter->setPattern('d MMMM yyyy');
						?>
						<a
								class="blog-item"
								href="/article/<?= $item['alias']; ?>"
								itemprop="blogPosts"
								itemscope
								itemtype="http://schema.org/BlogPosting"
						>
							<div class="image-container">
								<div class="image">
									<img src="/images/<?= $item['img']; ?>" alt="<?= $item['title']; ?>"/>
								</div>
							</div>
							<div class="description">
								<h3 class="title"><?= $item['title']; ?></h3>
								<div class="date">
									<?= $has_update_date ? 'Обновлено: ' . $formatter->format($updated_date) : 'Опубликовано: ' . $formatter->format($date); ?>
								</div>
								<div class="text"><?= $item['pre_content']; ?></div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
