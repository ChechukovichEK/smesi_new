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
				<div class="contacts-item">
					<ul>
						<li id="page_tel"><a href="tel:+375445305533" rel="nofollow">+375 (44) 530-55-33</a> Лопатина 6-6а, офис</li>
						<li id="page_tel"><a href="tel:+375445960533" rel="nofollow">+375 (44) 596-05-33</a> Павел,</li>
						<li id="page_tel"><a href="tel:+375445667500" rel="nofollow">+375 (44) 566-75-00</a> Маг. Основателей 31/3,</li>
						<li id="page_tel"><a href="tel:+375445720533" rel="nofollow">+375 (44) 572-05-33</a> Маг. Основателей 31/3,</li>
						<li id="page_tel"><a href="tel:+375445920533" rel="nofollow">+375 (44) 592-05-33</a> Лопатина 6-6а, офис</li>
						<li id="page_tel"><a href="tel:+375445970533" rel="nofollow">+375 (44) 597-05-33</a> Илья, специалист по продажам</li>
						<li id="page_tel"><a href="tel:+375172344018" rel="nofollow">+375 (17) 234-40-18</a> - общий</li>
					</ul>
				</div>
				
				<div class="contacts-item">
					<div class="label">Наша почта:</div>
					
					<ul>
						<?php $email = \ishop\App::$app->getProperty('email')['text']; ?>
						<li id="cont-mail"><a  rel="nofollow" href="mailto:<?= $email ?>"><?= $email ?></a></li>
					</ul>
				</div>
				
				<div class="contacts-item">
					<h2>Время работы:</h2>
					
					<p>ПН-ПТ с 9:00 до 17:30</p>
					
					<p>СБ-ВС выходной</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require APP . '/views/layouts/components/map-block.php'; ?>
