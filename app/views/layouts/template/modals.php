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