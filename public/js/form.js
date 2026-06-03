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
			thanks = $(form).is('[data-thanks]')
				? $(form).attr('data-thanks')
				: '#modalThanks';
		
		form.find('.form-error, .form-error-note').remove();
		
		$.ajax({
			type  : "POST",
			url   : action,
			data  : data,
			cache : false,
			async : false,
			error : function () {
				alert('Ошибка запроса');
				return false;
			},
			success : function(response) {
				
				if (typeof response !== 'object') {
					alert('Ошибка сервера');
					return false;
				}
				
				if (response.error) {
					form.prepend('<div class="form-error-note">' + response.message + '</div>');
					form.find('.form-error-note').fadeIn(300);
					
					if(response.validation) {
						for(let key in response.validation) {
							form.find('[name="' + key + '"]')
								.addClass('input-error')
								.after('<div class="form-error">' + response.validation[key] + '</div>');
						}
					}
					
					return false;
				}
				
				$('[data-modal="close"]').trigger('click');
				modal_show(thanks);
				
				form.find('.form-input').val('');
			},
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
			checked = $checkbox.prop('checked'),
			$button = $checkbox.closest('form').find('button');
		
		$button.prop('disabled', !checked);
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
