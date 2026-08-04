<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
				<li><a href='<?= PATH ?>'>Главная</a></li>
				<li class='current-crumb'><?=$page->title;?></li>
			</ol>
		</div>
	</div>
</div>

<div class="pages-content">
	
	<section class="pages-content">
		<div class="container">
			<?=$page->content;?>
	</section>
</div>

<div class="request">
	<div class="container">
		<div class="request-content">
			<div class="request-left">
				<div class="title">Подать обращение</div>
				<div class="text">Заполните форму для подачи обращения о возможном нарушении ваших прав как потребителя. Укажите контактные данные и подробно опишите ситуацию. При необходимости приложите документы или иные материалы, подтверждающие изложенные обстоятельства.</div>
				
				<div class="list">
					<div class="list-item">
						<div class="image">
							<img src="<?= PATH ?>/img/icons/request/clock.svg">
						</div>
						
						<div class="list-item-info">
							<div class="title">Рассмотрение обращения</div>
							<div class="text">Мы рассматриваем ваше обращение в установленный официальный срок и информируем вас о результате</div>
						</div>
					</div>
					
					<div class="list-item">
						<div class="image">
							<img src="<?= PATH ?>/img/icons/request/shield-check.svg">
						</div>
						
						<div class="list-item-info">
							<div class="title">Защита ваших прав</div>
							<div class="text">Мы обеспечиваем соблюдение ваших прав и принимаем меры для их восстановления</div>
						</div>
					</div>
					<div class="list-item">
						<div class="image">
							<img src="<?= PATH ?>/img/icons/request/user-cog.svg">
						</div>
						
						<div class="list-item-info">
							<div class="title">Конфиденциальность</div>
							<div class="text">Ваши данные не будут переданы третьим лицам без вашего согласия</div>
						</div>
					</div>
					<div class="list-item">
						<div class="image">
							<img src="<?= PATH ?>/img/icons/request/award.svg">
						</div>
						
						<div class="list-item-info">
							<div class="title">Законность и прозрачность</div>
							<div class="text">Действуем в рамках законодательства и информируем вас о каждом шаге</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="request-right">
				<form action="/feedback/request" method="post" class="request-form" data-ajax-form-request
					  onsubmit="ym(98576053,'reachGoal','request');gtag('event', 'request'); return true;">
					
					<!-- CSRF -->
					<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
					
					<div class="request-form-group">
						<ul class="request-form-inputs">
							<li class="request-form-item">
								<label for="formSurname" class="request-form-label">Фамилия*</label>
								<input type="text" name="sur_name_cent" class="request-form-input" placeholder="Фамилия" data-input="text">
							</li>
							<li class="request-form-item">
								<label for="formName" class="request-form-label">Имя*</label>
								<input type="text" name="name_cent" class="request-form-input" placeholder="Имя" data-input="text">
							</li>
							<li class="request-form-item">
								<label for="formPhone" class="request-form-label">Телефон*</label>
								<input type="tel" name="tel_cent" class="request-form-input" placeholder="Телефон" data-input="num">
							</li>
							<li class="request-form-item">
								<label for="formEmail" class="request-form-label">Email*</label>
								<input type="email" name="email_cent" class="request-form-input" placeholder="Email" data-input="email">
							</li>
						</ul>
						
						<div class="request-form-item">
							<label for="formAddress" class="request-form-label">Адрес места жительства (необязательно)</label>
							<input type="text" name="address_cent" class="request-form-input" placeholder="Введите адрес" data-input="text">
						</div>
						
						<div class="request-form-item">
							<label for="formMessage" class="request-form-label">Описание обращения (необязательно)</label>
								<textarea class="request-form-textarea" name="message_cent" cols="30" rows="4" placeholder="Опишите обстоятельства нарушения, когда и при каких условиях оно произошло, а также ваши требования"></textarea>
						</div>
						
						<div class="request-form-item">
							<label for="formSurname" class="request-form-label">Прикрепить файл (необязательно)</label>
							<div id="dropzone" class="request-form-file"  data-toggle="file">
								<div class="image">
									<img src="<?= PATH ?>/img/icons/request/paperclip.svg">
								</div>
								<div class="info">
									<div class="title">Перетащите файл сюда или нажмите для выбора</div>
									<div class="text">Допустимые форматы: PDF, JPG, PNG. Размер до 10 МБ</div>
								</div>
							</div>
							<input type="file" id="fileInput" data-file-input style="display: none;">
						</div>
						
						<label class="checker-item form-terms">
							<div class="checker">
								<input type="checkbox" data-form-agree value="1" checked>
								<i class="checker-view"></i>
							</div>
							<div class="checker-label">
								Нажимая кнопку «Отправить», вы соглашаетесь с <a href="<?= PATH ?>/page/politika-obrabotki-personal-nyh-dannyh" target="_blank">политикой конфиденциальности</a> и обработкой персональных данных.
							</div>
						</label>
						
						<div class="action">
							<button class="btn-gradient" type="submit">Отправить обращение</button>
							<input type="hidden" name="prod_title" id="modalFeedbackTask" value="">
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	<picture class="request-bg">
		<img class="image" src="<?= PATH ?>/img/request-form-bg.jpg" data-no-webp>
	</picture>
</div>