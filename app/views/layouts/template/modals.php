<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close red"><span aria-hidden="true">&times;</span></button>
				<!--                <h4 class="modal-title" id="myModalLabel">Корзина</h4>-->
				<div class="model_title modal-title" id="myModalLabel">Корзина</div>
			</div>
			<div class="modal-body">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="do-shopping btn btn-default red hover">Продолжить покупки</button>
				<!--                <a href="cart/view" type="button" class="do-order hover">Оформить заказ</a>-->
				<a href="cart/view" class="do-order hover">Оформить заказ</a>
				<button type="button" class="clear-cart hover" onclick="clearCart()">Очистить корзину</button>
			</div>
		</div>
	</div>
</div>

<div class="modal-new" id="modalSearch">
	<a href="javascript:void(0)" class="modal-new-close" data-modal="close"></a>
	<div class="modal-new-top">
		<div class="title">Поиск по сайту</div>
		
		<form action="search" class="modal-new-search" method="get" autocomplete="off">
			<div class="modal-new-search-control">
				<input type="text" class="typeahead" id="typeModal" name="s" placeholder="Поиск товаров.."
					   autocomplete="off">
				<input type="submit" class="modal-new-search-bg" value="" title="Поиск товаров">
			</div>
		</form>
	
	</div>
</div>

<div class="modal-new" id="modalPhone">
	<a href="javascript:void(0)" class="modal-new-close" data-modal="close"></a>
	<div class="modal-new-top">
		<div class="title">Наши телефоны</div>
		
		<div class="modal-new-contacts">
			<ul class="list">
				<?php $phones = \ishop\App::$app->getProperty('phones'); ?>
				<?php foreach ($phones as $phone): ?>
					<li>
						<a href="tel:<?= $phone['link'] ?>" onclick="gtag('event', 'call_click'); return true;"
						   rel="nofollow" class="link">
							<img src="<?= PATH ?>/img/icons/social/phone.svg">
							<?= $phone['title'] ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<div class="action">
				<button class="ft-btn">Заказать звонок</button>
				
				<?php $socials = \ishop\App::$app->getProperty('socials') ?>
				
				<?php if (!empty($socials)): ?>
					
					<div class="list-social">
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
	</div>
</div>

<div class="modal-new modal-feedback" id="modalFeedback">
	<a href="javascript:void(0)" class="modal-feedback-close" data-modal="close"></a>
	<div class="modal-feedback-top">
		<div class="title">Заполните форму</div>
	</div>
	
	<form action="/feedback/send" method="post" class="modal-feedback-form" data-ajax-form
		  onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
		
		<!-- CSRF -->
		<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
		
		<!-- Honeypot -->
		<input type="text" name="surname_cent" value="" style="display:none !important;">
		
		<ul class="inputs">
			<li>
				<input type="text" name="name_cent" class="form-input form-input-gray" placeholder="Ваше Имя"
					   data-input="text">
			</li>
			<li>
				<input type="tel" name="tel_cent" class="form-input form-input-gray" placeholder="Телефон"
					   data-input="num">
			</li>
		</ul>
		
		<label class="checker-item form-terms">
			<div class="checker">
				<input type="checkbox" data-form-agree value="1" checked>
				<i class="checker-view"></i>
			</div>
			<div class="checker-label">
				Я даю согласие на обработку персональных данных в соответствии с
				<a href="<?= PATH ?>/page" target="_blank">политикой конфиденциальности</a>
			</div>
		</label>
		
		<div class="action">
			<button class="btn-gradient" type="submit">Отправить</button>
		</div>
	</form>
</div>

<div class="modal-new modal-feedback" id="modalThanks">
	<a href="javascript:void(0)" class="modal-feedback-close" data-modal="close"></a>
	<div class="modal-feedback-top">
		<div class="title">Спасибо за заявку!</div>
		<div class="text">Мы свяжемся с Вами в ближайшее рабочее время</div>
		<div class="action">
			<a href="javascripts:void(0);" class="btn-gradient" data-modal="close">Закрыть форму</a>
		</div>
	</div>
</div>


<?php $cookieAgree = \ishop\App::$app->getProperty('cookieAgree'); ?>

<?php if ($cookieAgree != 'yes'): ?>
	<div class="cookie" id="cookieModal">
		<div class="container">
			<div class="cookie-container">
				<div class="text">
					Этот сайт использует файлы cookie. Продолжая использовать этот сайт, вы соглашаетесь на их
					использование. Для получения дополнительной информации, пожалуйста, ознакомьтесь
					<a href="<?= PATH ?>/page" target="_blank">с нашей Политикой конфиденциальности</a>.
				</div>
				<div class="action">
					<a href="javascript:void(0)" class="btn-gradient btn-xs" id="cookieAgree">Принять</a>
					<a href="javascript:void(0)" class="btn-gray btn-xs" data-close-cookie>Отказаться</a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>