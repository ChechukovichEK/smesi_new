$(document)
	
	// FEEDBACK MODAL
	.on('click', '[data-feedback]', function(){
		$('#modalFeedbackTask').val($(this).attr('data-feedback'));
	})
	
	// SUBMIT FORM
	.on('submit', '[data-ajax-form]', function(event){
		
		event.preventDefault();
		
		let form = $(this),
			action = form.attr('action'),
			data = form.serialize(),
			thanks = form.is('[data-thanks]')
				? form.attr('data-thanks')
				: '#modalThanks';
		
		form.find('.form-error, .form-error-note').remove();

// CLIENT VALIDATION
		let hasError = false;

// Очистка старых ошибок
		form.find('.input-error').removeClass('input-error');
		form.find('.form-error').remove();

// NAME
		let nameInput = form.find('[name="name_cent"]');
		if (nameInput.val().trim() === '') {
			nameInput.addClass('input-error');
			nameInput.after('<div class="form-error">Поле <strong>Ваше Имя</strong> обязательно для заполнения.</div>');
			hasError = true;
		}

// PHONE
		let phoneInput = form.find('[name="tel_cent"]');
		let phone = phoneInput.val().trim();

		if (!phoneInput.inputmask("isComplete")) {
			phoneInput.addClass('input-error');
			phoneInput.after('<div class="form-error">Введите корректный <strong>Телефон</strong>.</div>');
			hasError = true;
		}
// AGREEMENT
		let agree = form.find('[data-form-agree]');
		let terms = form.find('.form-terms');
		
		terms.removeClass('error');
		terms.find('.terms-error').remove();
		
		if (!agree.is(':checked')) {
			terms.addClass('error');
			terms.after('<div class="form-error">Поле <strong>Согласование</strong> обязательно для заполнения.</div>');
			hasError = true;
		}

// Если есть ошибки — не отправляем AJAX
		if (hasError) return false;

		
		$.ajax({
			type: "POST",
			url: action,
			data: data,
			cache: false,
			success: function(response) {
				
				// Попытка привести к объекту
				try {
					if (typeof response !== 'object') {
						response = JSON.parse(response);
					}
				} catch(e) {
					alert('Ошибка сервера');
					return;
				}
				
				if (response.error) {
					form.prepend('<div class="form-error-note">' + '222</div>');
					$form.find('.form-error-note').fadeIn(300);
					return;
				}
				
				$('[data-modal="close"]').trigger('click');
				modal_show(thanks);
				
				form.find('.form-input').val('');
			},
			error: function() {
				alert('Ошибка запроса');
			}
		});
		
		return false;
	})
	
	// REMOVE ERROR CLASS
	.on('change', '.input-error', function(){
		$(this).removeClass('input-error');
	})
	
	// VALIDATION NUMBERS
	.on('change keyup input click', '[data-input="num"]', function(){
		this.value = this.value.replace(/[^0-9+ ()-]/g, '');
	})
	
	// VALIDATION TEXT
	.on('change keyup input click', '[data-input="text"]', function(){
		this.value = this.value.replace(/[^a-zA-Zа-яА-ЯёЁ .]/g, '');
	})
	
	// AGREE CHECKBOX
	.on('change', '[data-form-agree]', function(){
		let $checkbox = $(this),
			checked = $checkbox.prop('checked');
			//$button = $checkbox.closest('form').find('button');
		
		//$button.prop('disabled', !checked);
	});


// ADD HONEYPOT FIELD
$(function () {
	$('[data-ajax-form]').each(function () {
		$(this).append('<input type="text" name="surname_cent" value="" style="display:none !important;">');
	});
});

// PHONE MASK
$(function () {
	$('[type="tel"]').inputmask('+375 (99) 999-99-99', {
		placeholder: 'X'
	});
});
