<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
				<li><a href='<?= PATH ?>'>Главная</a></li>
				<li class='current-crumb'><?= $page->title; ?></li>
			</ol>
		</div>
	</div>
</div>

<div class="pages-content">
	
	<section class="delivery">
		<div class="container">
			<h1 class="delivery-title">Доставка и оплата</h1>
			
			<div class="delivery-block">
				<div class="title">Доставка</div>
				<div class="delivery-list">
					<div class="delivery-item">
						<div class="title">Самовывоз</div>
						<div class="text">Материалы отгружаются со склада, расположенного по адресу: <span><?= \ishop\App::$app->getProperty('settings')['address_store'] ?></span>
							Режим работы: <span><?= \ishop\App::$app->getProperty('settings')['schedule'] ?></span>
						</div>
					</div>
					<div class="delivery-item">
						<div class="title">Доставка</div>
						<div class="text">
							Есть возможность доставки стройматериалов машинами грузоподъемностью 8-10 тонн (с разгрузкой
							манипулятором). Доставка строительных материалов осуществляется до подъезда, выгрузка
							и подъем на этаж в услугу доставки не входит, оплачивается отдельно.
						</div>
					</div>
				</div>
			</div>
			
			<div class="delivery-info">
				Регионы доставки: <span>по всей Беларуси.</span> Чтобы узнать стоимость и возможность доставки в Ваш населенный пункт, свяжитесь с менеджером.
			</div>
			
			<div class="delivery-block">
				<div class="title">Способы оплаты</div>
				<div class="delivery-list">
					<div class="delivery-item">
						<div class="title">Наличными</div>
						<div class="text">При самовывозе оплата производится в пунктах продаж по адресу: <span><?= \ishop\App::$app->getProperty('settings')['address_store'] ?></span>
							При заказе материалов с доставкой оплата производится по прибытию в пункте выгрузки.
						</div>
					</div>
					<div class="delivery-item">
						<div class="title">Безналичный расчет</div>
						<div class="text">
							Предоплата производится через банк, согласно счет фактуре.<br>
							Счёт можно получить, сделав заказ через офис – <span><?= \ishop\App::$app->getProperty('settings')['address_office'] ?></span><br>
							Телефоны:
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone'] ?>
							</a>,
							<a href="tel:<?= preg_replace('/[^\d+]/', '', \ishop\App::$app->getProperty('settings')['phone_general']) ?>">
								<?= \ishop\App::$app->getProperty('settings')['phone_general'] ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="delivery-block">
				<div class="title">Сопроводительные документы</div>
				
				<div class="delivery-images">
					<a href="<?= PATH ?>/img/delivery/image-1.jpg" target="_blank" class="list-item">
						<picture class="image">
							<img src="<?= PATH ?>/img/delivery/image-1.jpg" alt="чек" data-no-webp>
						</picture>
					</a>
					<a href="<?= PATH ?>/img/delivery/image-2.jpg" target="_blank" class="list-item">
						<picture class="image">
							<img src="<?= PATH ?>/img/delivery/image-2.jpg" alt="чек" data-no-webp>
						</picture>
					</a>
					<a href="<?= PATH ?>/img/delivery/image-3.jpg" target="_blank" class="list-item">
						<picture class="image">
							<img src="<?= PATH ?>/img/delivery/image-3.jpg"  alt="чек" data-no-webp>
						</picture>
					</a>
				</div>
				
				<div class="block-text">
					При оплате товаров наличными деньгами или пластиковыми картами, покупателю выдаётся кассовый чек, с указанием суммы покупки. В случае выбора безналичного расчета через банк покупателю выдается товарно-транспортная накладная. Для ее получения необходимо предоставить доверенность или печать (для юридических лиц), либо быть заказчиком, непосредственно указанным в договоре.
				</div>
			</div>
	</section>

</div>