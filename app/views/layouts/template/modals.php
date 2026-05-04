<div class="parent_popup">
	<div class="popup" id="pop-cat">
		<div class="close-cus hover">
			<p>X</p>
		</div>
		<div class="form-main">
			<!--            <h3>Заполните форму</h3>-->
			<div class="title">Заполните форму</div>
			<form method="post" class="call-back" onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
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