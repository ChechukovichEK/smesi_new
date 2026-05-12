<div class="pages-content svp">
	
	<div class="svp-offer">
		<div class="container">
			<div class="svp-offer-content">
				<h1 class="title">Мы предлагаем сотрудничество<br> с официальным дилером СВП TLS-Profi</h1>
				<div class="text">Официальный дилер в Беларуси приглашает к сотрудничеству магазины и строительные
					бригады.<br> Выгодные условия и стабильные поставки
				</div>
				
				<ul class="list">
					<li class="item">
						Большой размерный ряд
					</li>
					<li class="item">
						Цветовая маркировка размеров
					</li>
					<li class="item">
						Ускоряют процесс укладки плитки
					</li>
					<li class="item">
						Выгодные партнёрские цены
					</li>
				</ul>
				
				<div class="action">
					<a href="#svpForm" class="btn-svp" data-toggle="svpForm">Получить прайс</a>
				</div>
			</div>
		</div>
		<div class="svp-offer-bg">
			<img src="<?= PATH ?>/img/svp/svp-offer-img.png">
		</div>
	</div>
	
	<div class="svp-cooperation">
		<div class="container">
			<h2 class="title svp-title">Мы предлагаем сотрудничество для следующих категорий</h2>
			
			<div class="list">
				<div class="item">
					Гипермаркеты и магазины строительных материалов
				</div>
				<div class="item">
					Оптовые компании<br> и дистрибьюторы
				</div>
				<div class="item">
					Строительные компании<br> и подрядчики
				</div>
			</div>
		</div>
	</div>
	
	<div class="svp-edge">
		<div class="container">
			<h2 class="title svp-title">Почему системы TLS-Profi — одни из лучших в своём деле</h2>
			
			<?php
			$advantages = [
				[
					'img' => 'svp-edge-1.png',
					'title' => 'Цветовая маркировка размеров',
					'text' => 'Не все системы имеют цветовую маркировку. В TLS-Profi каждый размер имеет свой цвет — легко подобрать нужный элемент и избежать ошибок при работе.'
				],
				[
					'img' => 'svp-edge-2.png',
					'title' => 'Большой размерный ряд',
					'text' => 'Широкий выбор размеров позволяет подобрать оптимальное решение под любую плитку и нужную толщину шва.'
				],
				[
					'img' => 'svp-edge-3.png',
					'title' => 'Разные формы для любых задач',
					'text' => 'В ассортименте представлены элементы различных форм — для пола, стен, крупноформатной плитки и сложных участков.'
				],
			];
			?>
			
			<div class="list">
				<?php foreach ($advantages as $advantage): ?>
					<div class="item">
						<img src="<?= PATH ?>/img/svp/<?= $advantage['img'] ?>">
						<div class="description">
							<div class="title"><?= $advantage['title'] ?></div>
							<div class="text"><?= $advantage['text'] ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		
		</div>
	</div>
	
	<div class="svp-catalog">
		<div class="container">
			<div class="text">Хотите ознакомиться со всей линейкой продукции TLS‑Profi?
				<a href="<?= PATH ?>/upload/files/catalog.pdf" download>Скачайте фирменный каталог компании</a>, где вы
				найдете весь ассортимент по системе
				выравнивания плитки: фотографии представленной
				продукции, подробное описание товаров, а также способы по применению системы при укладке на стены или
				пол.
			</div>
		</div>
		
		<?php
		$products = [
			
			1 => [
				'title' => 'Зажимы TLS-Profi',
				'img' => 'Зажимы TLS-Profi.png',
				
				'images' => [
					'02 зажим ворота 1 мм 100 шт.png',
					'Зажимы кольцо TLS-Profi.png',
					'02 зажим кольцо 1 мм 100 шт.png',
					'Зажимы флажок TLS-Profi.png',
					'02 зажим флажок 1 мм 100 шт.png',
					'03 зажим ворота 1 мм 100 шт.jpg',
					'03 зажим флажок 1 мм 500 шт.jpg',
				],
				
				'quantity' => ['100 шт.', '500 шт.'],
				
				'fields' => [
					1 => [
						'id' => 1,
						'label' => '0.5 мм',
						'color' => 'white',
					],
					2 => [
						'id' => 2,
						'label' => '1 мм',
						'color' => 'yellow',
					],
					3 => [
						'id' => 3,
						'label' => '1.4 мм',
						'color' => 'lightgrey',
					],
					4 => [
						'id' => 4,
						'label' => '1.5 мм',
						'color' => 'white',
					],
					5 => [
						'id' => 5,
						'label' => '2 мм',
						'color' => 'red',
					],
					6 => [
						'id' => 6,
						'label' => '3 мм',
						'color' => 'black',
					],
				],
			],
			
			2 => [
				'title' => 'Подковы TLS-Profi',
				'img' => 'Подковы TLS-Profi.png',
				
				'images' => [
					'02 подкова 1 мм 100 шт.png',
					'06 подкова 1 мм 100 шт.png',
					'02 подкова 1,5 мм 100 шт.png',
					'06 подкова 1,5 мм 100 шт.png',
					'02 подкова 2 мм 100 шт.png',
					'06 подкова 2 мм 100 шт.png',
					'04 подкова 1,5 мм 100 шт.jpg',
				],
				
				'quantity' => ['100 шт.'],
				
				'fields' => [
					1 => [
						'id' => 1,
						'label' => '1 мм',
						'color' => 'yellow',
					],
					2 => [
						'id' => 2,
						'label' => '1.5 мм',
						'color' => 'white',
					],
					3 => [
						'id' => 3,
						'label' => '2 мм',
						'color' => 'red',
					],
				],
			],
			
			3 => [
				'title' => 'Крестики TLS-Profi',
				'img' => 'Крестики для плитки TLS-Profi.png',
				
				'images' => [
					'Крестики для плитки 1 мм 300 2000.png',
					'Крестики для плитки 1,5 мм 200 2000.png',
					'Крестики для плитки 2 мм 200 2000.png',
					'Крестики для плитки 2,5 мм 100 1500.png',
					'Крестики для плитки 3 мм 100 1000.png',
					'Крестики для плитки 4 мм 75.png',
				],
				
				'quantity' => ['75 шт.', '100 шт.', '200 шт.', '300 шт.', '1000 шт.', '1500 шт.', '2000 шт.'],
				
				'fields' => [
					1 => [
						'id' => 1,
						'label' => '1 мм',
						'color' => 'yellow',
					],
					2 => [
						'id' => 2,
						'label' => '1.5 мм',
						'color' => 'white',
					],
					3 => [
						'id' => 3,
						'label' => '2 мм',
						'color' => 'red',
					],
					4 => [
						'id' => 4,
						'label' => '2.5 мм',
						'color' => 'green',
					],
					5 => [
						'id' => 5,
						'label' => '3 мм',
						'color' => 'black',
					],
					6 => [
						'id' => 6,
						'label' => '4 мм',
						'color' => 'white',
					],
				],
			],
			
			4 => [
				'title' => 'Строительные ведра TLS-Profi',
				'img' => 'Строительные ведра TLS-Profi.png',
				
				'images' => [
					'02 ведро 12 л.png',
					'02 ведро 16 л.png',
					'02 ведро 20 л.png',
					'06 ведро 20 л.jpg',
				],
				
				'quantity' => null,
				
				'fields' => [
					1 => [
						'id' => 1,
						'label' => '12 л',
						'color' => null,
					],
					2 => [
						'id' => 2,
						'label' => '16 л',
						'color' => null,
					],
					3 => [
						'id' => 3,
						'label' => '20 л',
						'color' => null,
					],
				],
			],
			
			5 => [
				'title' => 'Клинья TLS-Profi',
				'img' => 'Клинья TLS-Profi.png',
				
				'images' => [
					'01 клинья 5x5,5x21 мм 100 шт.png',
					'06 клинья 5x5,5x21 мм 100 шт.png',
					'01 клинья 8,5x7x31 мм 50 шт.png',
					'06 клинья 8,5x7x31 мм 50 шт.png',
				],
				
				'quantity' => ['50 шт.', '75 шт.', '100 шт.'],
				
				'fields' => [
					1 => [
						'id' => 1,
						'label' => '5x5.5x21 мм',
						'color' => 'lightgrey',
					],
					2 => [
						'id' => 2,
						'label' => '8.5x7x31 мм',
						'color' => 'black',
					],
				],
			],
			
			6 => [
				'title' => 'Щипцы TLS-Profi',
				'img' => 'Щипцы TLS-Profi.png',
				
				'images' => [
					'02 инструмент универсальный для СВП.png',
					'03 инструмент универсальный для СВП.jpg',
					'04 инструмент универсальный для СВП.jpg',
					'05 инструмент универсальный для СВП.jpg',
					'06 инструмент универсальный для СВП.jpg',
				],
				
				'quantity' => ['1 шт.'],
				
				'fields' => null,
			],
			
			7 => [
				'title' => 'Фиксаторы плитки TLS-Profi',
				'img' => 'Фиксаторы плитки TLS-Profi.png',
				
				'images' => [
					'01 фиксатор 1 мм 20 шт.png',
					'02 фиксатор 1 мм 20 шт.jpg',
					'03 фиксатор 1 мм 20 шт.jpg',
					'04 фиксатор 1 мм 20 шт.jpg',
					'05 фиксатор 1 мм 20 шт.jpg',
					'06 фиксатор 1 мм 20 шт.png',
					'07 фиксатор 1 мм 20 шт.jpg',
				],
				
				'quantity' => ['20 шт.'],
				
				'fields' => null,
			],
			
			8 => [
				'title' => 'Уголки TLS-Profi',
				'img' => 'Уголки TLS-Profi.png',
				
				'images' => [
					'01 уголки 30 шт.png',
					'02 уголки 30 шт.png',
					'03 уголки 30 шт.png',
					'04 уголки 30 шт.jpg',
					'05 уголки 30 шт.jpg',
					'06 уголки 30 шт.png',
				],
				
				'quantity' => ['20 шт.'],
				
				'fields' => null,
			],
		
		];
		?>
		
		<div class="container">
			<div class="swiper" data-toggle="svp-catalog">
				<div class="swiper-wrapper">
					
					<?php foreach ($products as $product): ?>
						<?php
						$images = array_merge([$product['img']], $product['images']);
						$images = array_slice($images, 0, 8); // максимум 8 изображений
						?>
						
						<div class="swiper-slide" data-product="<?= $product['id']; ?>">
							<div class="svp-product">
								
								<div class="svp-product-sale">% Выгодное предложение</div>
								
								<div class="svp-product-card-image">
									<div class="image-container">
										
										<?php foreach ($images as $index => $img): ?>
											<div class="image image-<?= $index ?> <?= $index === 0 ? 'current' : '' ?>">
												<img src="<?= PATH ?>/img/svp/products/<?= $img ?>">
											</div>
										<?php endforeach; ?>
									
									</div>
									
									<?php if (count($images) > 1): ?>
										<div class="image-hover">
											<?php foreach ($images as $_): ?><span></span><?php endforeach; ?>
										</div>
										
										<div class="image-dots">
											<?php foreach ($images as $index => $_): ?>
												<span class="<?= $index === 0 ? 'current' : '' ?>"></span>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
								
								<div class="svp-product-description">
									<div class="title svp-title"><?= $product['title'] ?></div>
									
									<?php if (!empty($product['fields'])): ?>
										<div class="text">Размеры в наличии:</div>
										
										<ul class="list-size">
											<?php foreach ($product['fields'] as $field): ?>
												<li class="item"
													style="<?= $field['color'] === null ? 'padding-left: 15px;' : '' ?>">
													<div class="color"
														 style="background: <?= $field['color'] ?>; <?= $field['color'] === 'white' ? 'border:1px solid #d0d0d0;' : '' ?><?= $field['color'] === null ? 'display: none;' : '' ?>">
													</div>
													<div class="label"><?= $field['label'] ?></div>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									
									<?php if (!empty($product['quantity'])): ?>
										<div class="text">Доступное количество в упаковке:</div>
										<ul class="list-quantity">
											<?php foreach ($product['quantity'] as $field): ?>
												<li class="item"><?= $field ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									
									<div class="action">
										<a href="#svpForm" class="btn-svp" data-toggle="svpForm">Оставить заявку</a>
									</div>
								</div>
							
							</div>
						</div>
					
					<?php endforeach; ?>
				
				</div>
			</div>
		</div>
		<div class="swiper-button-prev svp-prev"></div>
		<div class="swiper-button-next svp-next"></div>
	</div>
	
	<div class="svp-why">
		<div class="container">
			<h2 class="title svp-title">Почему СВП TLS-Profi — это лучшее предложение для мастеров-плиточников</h2>
			
			<?php
			
			$offers = [
				[
					'img' => 'svp-img-1.svg',
					'title' => 'Проверено мастерами',
					'text' => 'Систему выравнивания используют сотни компаний и мастеров-плиточников. Многие переходят на TLS-Profi на постоянной основе благодаря сочетанию цены и качества.',
				],
				[
					'img' => 'svp-img-2.svg',
					'title' => 'Выгодно для бизнеса и магазинов',
					'text' => 'Гибкая система цен, высокая маржинальность (от 30% при опте), стабильный спрос у мастеров.',
				],
				[
					'img' => 'svp-img-3.svg',
					'title' => 'Производитель с опытом и стабильным качеством',
					'text' => 'Бренд имеет собственное производство и использует современные технологии, что обеспечивает контроль качества и стабильность поставок.',
				],
				[
					'img' => 'svp-img-4.svg',
					'title' => 'Надежность используемых материалов и расходников',
					'text' => 'Тонкое основание зажимов снижает расход клея, клинья используются многократно (20+ циклов), что ведет к уменьшению брака и переделок.',
				],
				[
					'img' => 'svp-img-5.svg',
					'title' => 'Универсальность применения',
					'text' => 'Подходит для, стен и пола, керамики и керамогранита, жилых и коммерческих объектов.',
				],
				[
					'img' => 'svp-img-6.svg',
					'title' => 'Укладка в 2-4 раза быстрее',
					'text' => 'Продуманная конструкция элементов (зажим + клин + инструмент) значительно ускоряет монтаж и снижает количество корректировок.',
				],
			];
			
			?>
			
			<div class="list">
				<?php foreach ($offers as $offer) : ?>
					<div class="item">
						<img src="<?= PATH ?>/img/svp/<?= $offer['img'] ?>">
						<div class="title"><?= $offer['title'] ?></div>
						<div class="line"></div>
						<div class="text"><?= $offer['text'] ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	
	<div class="svp-contact-form" id="svpForm">
		<div class="container">
			<div class="title">Свяжитесь с нами для обсуждения индивидуального прайса.<br>
				Гарантируем гибкие и прозрачные условия работы для будущих партнеров
			</div>
			<div class="svp-contact-form-container">
				<form class="form" method="post"
					  onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
					<ul class="inputs">
						<li>
							<input class="form-input" type="text" name="name_cent" placeholder="Ваше имя" required="">
						</li>
						<li>
							<input class="form-input" type="tel" name="tel_cent" placeholder="Ваш телефон" required="">
						</li>
					</ul>
					<div class="action">
						<button class="btn-svp" type="submit" name="submit_tel">Запросить цены</button>
					</div>
				</form>
			</div>
		</div>
		<div class="bg">
			<img src="<?= PATH ?>/img/svp/contact-form-bg.png">
		</div>
	</div>

</div>