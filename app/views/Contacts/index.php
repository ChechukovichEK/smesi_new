<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
				<li><a href='<?=PATH?>'>Главная</a></li>
				<li class='current-crumb'>Контакты</li>
			</ol>
		</div>
	</div>
</div>
<div class="pages-content">
	<div class="container">
		<div class="contacts">
			<div class="contacts-title">Smesi.by - наши контакты</div>
			<div class="contacts-text">Название: <span>ООО «Вершина-строй»</span></div>
			<div class="contacts-list">
				<div class="contacts-item contacts-item-phones">
					<div class="list">
						<div class="item">
							<div class="label">Офис д.Копище, ул.Лопатина 6-6а</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Общий</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_general']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_general'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Офис д.Копище, ул.Лопатина 6-6а</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_office']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_office'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Павел</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_manager_1']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_manager_1'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Магазин г.Минск, ул. Основателей 31/3</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_store_1']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_store_1'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Илья, специалист по продажам</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_manager_2']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_manager_2'] ?>
							</a>
						</div>
						<div class="item">
							<div class="label">Магазин г.Минск, ул. Основателей 31/3</div>
							
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_store_2']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_store_2'] ?>
							</a>
						</div>
					</div>
				</div>
				
				<div class="contacts-item">
					<div class="description">
						<div class="label">Электронная почта</div>
						
						<?php $email = \ishop\App::$app->getProperty('email')['text']; ?>
						<a  rel="nofollow" href="mailto:<?= $email ?>"><?= $email ?></a>
					</div>
				</div>
				
				<div class="contacts-item">
					<div class="description">
						<div class="label">Время работы</div>
						
						<div class="text"><?= \ishop\App::$app->getProperty('settings')['schedule'] ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require APP . '/views/layouts/components/map-block.php'; ?>
