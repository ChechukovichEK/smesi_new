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
		<h1>Smesi.by - наши контакты</h1>
		<div class="pages-contacts">
			<div class="pages-contacts-left">
				
				<h2>Название: <span>ООО «Вершина-строй»</span></h2>
				
				<h2>Наши телефоны:</h2>
				
				<ul>
					<li id="page_tel"><a href="tel:+375445305533" rel="nofollow">+375 (44) 530-55-33</a> Лопатина 6-6а, офис</li>
					<li id="page_tel"><a href="tel:+375445960533" rel="nofollow">+375 (44) 596-05-33</a> Павел,</li>
					<li id="page_tel"><a href="tel:+375445667500" rel="nofollow">+375 (44) 566-75-00</a> Маг. Основателей 31/3,</li>
					<li id="page_tel"><a href="tel:+375445720533" rel="nofollow">+375 (44) 572-05-33</a> Маг. Основателей 31/3,</li>
					<li id="page_tel"><a href="tel:+375445920533" rel="nofollow">+375 (44) 592-05-33</a> Лопатина 6-6а, офис</li>
					<li id="page_tel"><a href="tel:+375445970533" rel="nofollow">+375 (44) 597-05-33</a> Илья, специалист по продажам</li>
					<li id="page_tel"><a href="tel:+375172344018" rel="nofollow">+375 (17) 234-40-18</a> - общий</li>
				</ul>
				
				<h2>Наша почта:</h2>
				
				<ul>
					<?php $email = \ishop\App::$app->getProperty('email')['text']; ?>
					<li id="cont-mail"><a  rel="nofollow" href="mailto:<?= $email ?>"><?= $email ?></a></li>
				</ul>
				
				<h2>Время работы:</h2>
				
				<p>ПН-ПТ с 9:00 до 17:30</p>
				
				<p>СБ-ВС выходной</p>
				
				<h2>Наши адреса:</h2>
				
				<p>Магазин-склад - Беларусь г. Минск, ул.Основателей 31/3<br />
					Офис - Беларусь г. Минск, ул. Лопатина 6, 6а</p>
			</div>
			
			<div class="pages-contacts-right">
				<h2>Связаться с директором</h2>
				
				<p>Здравствуйте! Я директор компании ООО «Вершина-строй». У Вас есть предложения или вопросы? Пожалуйста, свяжитесь со мной!</p>
				
				<form method="post" onsubmit="ym(98576053,'reachGoal','call_back'); return true;">
					<input name="name_cent" placeholder="Ваше имя" required="" type="text" />
					<input name="surname_cent" placeholder="Ваша фамилия" type="text" style="display:none;" />
					<input name="tel_cent" placeholder="Ваш телефон" required="" type="tel" />
					<input name="submit_tel" type="submit" value="перезвоните мне" />
				</form>
				
				<div class="ft-phones">
					<a
							class="phone-conv cont-icon hover"
							href="tel:+375445920533"
							onclick="gtag('event', 'call_click'); return true;"
							rel="nofollow"
					>
						<img
								alt="Вы можете связаться с нами по телефону - +375445920533"
								loading="lazy"
								src="img/icons/social/phone.svg"
						>
					</a>
					<a
							class="viber cont-icon hover"
							href="viber://chat?number=+375445920533"
							onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
							rel="nofollow"
					>
						<img
								alt="Вы можете связаться с нами по Viber"
								loading="lazy"
								src="img/icons/social/viber.svg"
						>
					</a>
					<a
							class="tg cont-icon hover"
							href="https://t.me/+375445920533"
							onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
							rel="nofollow"
					>
						<img
								alt="Вы можете связаться с нами в Telegram"
								loading="lazy"
								src="img/icons/social/telegram.svg"
						>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
