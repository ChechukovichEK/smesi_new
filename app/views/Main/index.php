<?php require APP . '/views/Main/components/slider-offer.php'; ?>

<?php require APP . '/views/Main/components/slider-catalog.php'; ?>

<?php if (isset($hits) && !empty($hits)): ?>
	<?php require APP . '/views/Main/components/hits.php'; ?>
<?php endif; ?>

<?php if (isset($sales) && !empty($sales)): ?>
	<?php require APP . '/views/Main/components/sale.php'; ?>
<?php endif; ?>

<?php if (isset($brands) && !empty($brands)): ?>
	<?php require APP . '/views/Main/components/brands.php'; ?>
<?php endif; ?>

<div class="home-info">
	<div class="container">
		<a href="article" class="home-info-link">
			<img src="img/home/school.jpg" alt="Школа ремонта" title="Школа ремонта">
		</a>
		<a href="sale" class="home-info-link">
			<img src="img/home/discounts.jpg" alt="Cкидки/акции" title="Cкидки/акции">
		</a>
	</div>
</div>

<div class="home-text">
	<div class="container">
		<div class="text-editor">
			<h2>Купить стройматериалы от надежного поставщика с многолетним опытом</h2>
			<p>В интернет-магазине Smesi.by вы можете купить стройматериалы с доставкой по Минску и всей Беларуси
				максимально просто и выгодно.</p>
			<p>
				Для продажи в нашем каталоге представлен широкий ассортимент товаров для строительства и отделки: сухие
				смеси, утеплители, гипсокартон, краски, материалы для выравнивания и многое другое.
			</p>
			<p>
				Мы гарантируем актуальность цен и высокое качество продукции, так как сотрудничаем только с надежными
				проверенными поставщиками и производителями и стремимся к долгосрочным отношениям с клиентами.
			</p>
			
			<p>
				Покупка строительных материалов оптом и в розницу в нашем интернет-магазине является оптимальным
				вариантом для владельцев домов и квартир, а также специалистов, которые занимаются строительными
				работами на профессиональном уровне.
			</p>
			
			<div class="h3">Как сделать заказ</div>
			<p>
				Заказывайте товары для строительства и ремонта через корзину либо позвоните нам для консультации и
				подбора товаров, соответствующих вашим требованиям и бюджету.
			</p>
			<p>
				Все заказы обрабатываются быстро, а доставка осуществляется точно в срок.
			</p>
		</div>
	</div>
</div>

<?php require APP . '/views/Main/components/about.php'; ?>