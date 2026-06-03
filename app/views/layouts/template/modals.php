<div class="parent_popup">
	<div class="popup" id="pop-cat">
		<div class="close-cus hover">
			<p>X</p>
		</div>
		<div class="form-main">
			<!--            <h3>Заполните форму</h3>-->
			<div class="title">Заполните форму</div>
			<form method="post" class="call-back"
				  onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
				<div class="input-pop">
					<input type="text" name="name_cent" class="inputbox-pop" placeholder="Имя" required
						   onfocus="this.placeholder = ''"
						   onblur="this.placeholder = 'Имя'"/>
				</div>
				<div class="input-pop">
					<input type="text" name="tel_cent" class="inputbox-pop" placeholder="Телефон" required
						   onfocus="this.placeholder = ''"
						   onblur="this.placeholder = 'Телефон'"/>
				</div>
				<div class="input-pop-s">
					<input type="text" name="surname_cent" class="inputbox" placeholder="Ваша фамилия"/>
				</div>
				<input type="submit" class="button-order hover c-back" value="Отправить" name="submit_tel"/>
			</form>
		</div>
	</div>
</div>


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

<div class="modal-new" id="modalFeedback">
	<a href="javascript:void(0)" class="modal-new-close" data-modal="close"></a>
	<div class="modal-new-top">
		<div class="title">Заказать звонок</div>
		<div class="text">Оставьте заявку и наши специалисты свяжутся с Вами в ближайшее время</div>
	</div>
	
	<form action="/feedback/send" method="post" class="modal-new-form" data-ajax-form>
		
		<!-- CSRF -->
		<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
		
		<!-- Honeypot -->
		<input type="text" name="surname_cent" value="" style="display:none !important;">
		
		<ul class="inputs">
			<li>
				<input type="text" name="name_cent" class="form-input" placeholder="Ваше Имя" data-input="text" required>
			</li>
			<li>
				<input type="tel" name="tel_cent" class="form-input" placeholder="Телефон" data-input="num" required>
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
			<button class="btn" type="submit">Отправить</button>
			<input type="hidden" name="prod_title" id="modalFeedbackTask" value="">
		</div>
	</form>
</div>

<div class="modal-new" id="modalThanks">
	<a href="javascript:void(0)" class="modal-new-close" data-modal="close"></a>
	<div class="modal-new-top">
		<div class="title">Спасибо за заявку</div>
		<div class="text">Мы свяжемся с Вами в ближайшее рабочее время</div>
	</div>
</div>



<?php if($cookieAgree != 'yes'): ?>
<div class="cookie" id="cookieModal" style="display: none;">
	<div class="container">
		<div class="cookie-container">
			<div class="text">
				Этот сайт использует файлы cookie. Собранная при помощи cookie информация не может идентифицировать вас,
				однако может помочь нам улучшить работу нашего сайта. Продолжая использовать сайт, вы даете согласие на
				<a href="<?= PATH ?>/page" target="_blank">обработку файлов cookie</a>.
			</div>
			<div class="action">
				<a href="javascript:void(0)" class="btn btn-xs" id="cookieAgree">Понятно!</a>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>