// PHONE MASK
$(function () {
	$('[type="tel"]').inputmask('+375 (99) 999-99-99', {
		placeholder: 'X'
	});
});


// DRAG & DROP FILE
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');

if (dropzone && fileInput) {
	
	dropzone.addEventListener('click', () => fileInput.click());
	
	dropzone.addEventListener('dragover', (e) => {
		e.preventDefault();
		dropzone.style.borderColor = '#4caf50';
	});
	
	dropzone.addEventListener('dragleave', () => {
		dropzone.style.borderColor = '#ccc';
	});
	
	dropzone.addEventListener('drop', (e) => {
		e.preventDefault();
		dropzone.style.borderColor = '#ccc';
		
		// Кладём файл в input — он отправится вместе с формой
		fileInput.files = e.dataTransfer.files;
	});
}

// FILE DROPZONE VIA data-toggle="file"
$(document).on('click', '[data-toggle="file"]', function () {
	$(this).closest('.request-form-group').find('[data-file-input]').click();
});

$(document).on('dragover', '[data-toggle="file"]', function (e) {
	e.preventDefault();
	this.style.borderColor = '#4caf50';
});

$(document).on('dragleave', '[data-toggle="file"]', function () {
	this.style.borderColor = '#ccc';
});

$(document).on('drop', '[data-toggle="file"]', function (e) {
	e.preventDefault();
	this.style.borderColor = '#ccc';
	
	const input = $(this).closest('.request-form-group').find('[data-file-input]')[0];
	input.files = e.originalEvent.dataTransfer.files;
	
	updateFileNameUI(this, input.files[0]);
});

function updateFileNameUI(dropzone, file) {
	const info = dropzone.querySelector('.info');
	const title = info.querySelector('.title');
	const text = info.querySelector('.text');
	
	if (file) {
		title.textContent = file.name;
		text.textContent = 'Файл выбран';
	} else {
		title.textContent = 'Перетащите файл сюда или нажмите для выбора';
		text.textContent = 'Допустимые форматы: PDF, JPG, PNG. Размер до 10 МБ';
	}
}

$(document).on('change', '[data-file-input]', function () {
	const dropzone = $(this).closest('.request-form-group').find('[data-toggle="file"]')[0];
	updateFileNameUI(dropzone, this.files[0]);
});
admin


// FILE VALIDATION
function validateFile(file) {
	if (!file) return true;
	
	const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
	const maxSize = 10 * 1024 * 1024; // 10 MB
	
	if (!allowedTypes.includes(file.type)) {
		alert('Недопустимый формат файла. Разрешены: PDF, JPG, PNG.');
		return false;
	}
	
	if (file.size > maxSize) {
		alert('Файл слишком большой. Максимальный размер — 10 МБ.');
		return false;
	}
	
	return true;
}


$(document)
	
	// FEEDBACK MODAL
	.on('click', '[data-feedback]', function () {
		$('#modalFeedbackTask').val($(this).attr('data-feedback'));
	})
	
	// REQUEST FORM
	.on('submit', '[data-ajax-form-request]', function (event) {
		
		event.preventDefault();
		
		let form = $(this);
		let action = form.attr('action');
		
		// Очистка ошибок
		form.find('.input-error, .form-error, .form-error-note').remove();
		
		let hasError = false;
		
		// Валидация
		let surname = form.find('[name="sur_name_cent"]');
		let name = form.find('[name="name_cent"]');
		let phone = form.find('[name="tel_cent"]');
		let email = form.find('[name="email_cent"]');
		
		if (surname.val().trim() === '') {
			surname.addClass('input-error').after('<div class="form-error">Поле <strong>Фамилия</strong> обязательно.</div>');
			hasError = true;
		}
		
		if (name.val().trim() === '') {
			name.addClass('input-error').after('<div class="form-error">Поле <strong>Имя</strong> обязательно.</div>');
			hasError = true;
		}
		
		if (!phone.inputmask("isComplete")) {
			phone.addClass('input-error').after('<div class="form-error">Введите корректный <strong>Телефон</strong>.</div>');
			hasError = true;
		}
		
		if (!email.val().match(/^[^@]+@[^@]+\.[^@]+$/)) {
			email.addClass('input-error').after('<div class="form-error">Введите корректный <strong>Email</strong>.</div>');
			hasError = true;
		}
		
		let agree = form.find('[data-form-agree]');
		if (!agree.is(':checked')) {
			form.find('.form-terms').addClass('error').after('<div class="form-error">Необходимо согласиться с политикой.</div>');
			hasError = true;
		}
		
		if (hasError) return false;
		
		// FORM DATA
		let formData = new FormData(form[0]);
		
		if (fileInput && fileInput.files[0]) {
			if (!validateFile(fileInput.files[0])) {
				return false;
			}
			formData.append('file', fileInput.files[0]);
		}
		
		
		$.ajax({
			type: "POST",
			url: action,
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				
				try {
					response = typeof response === 'object' ? response : JSON.parse(response);
				} catch (e) {
					alert('Ошибка сервера');
					return;
				}
				
				if (response.error) {
					form.prepend('<div class="form-error-note">' + response.message + '</div>');
					return;
				}
				
				$('[data-modal="close"]').trigger('click');
				modal_show('#modalThanks');
				
				form[0].reset();
				if (fileInput) fileInput.value = '';
			},
			error: function () {
				alert('Ошибка запроса');
			}
		});
		
		return false;
	})
	
	// SUBMIT FORM
	.on('submit', '[data-ajax-form]', function (event) {
		
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
			success: function (response) {
				
				// Попытка привести к объекту
				try {
					if (typeof response !== 'object') {
						response = JSON.parse(response);
					}
				} catch (e) {
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
			error: function () {
				alert('Ошибка запроса');
			}
		});
		
		return false;
	})
	
	// REMOVE ERROR CLASS
	.on('change', '.input-error', function () {
		$(this).removeClass('input-error');
	})
	
	// VALIDATION NUMBERS
	.on('change keyup input click', '[data-input="num"]', function () {
		this.value = this.value.replace(/[^0-9+ ()-]/g, '');
	})
	
	// VALIDATION TEXT
	.on('change keyup input click', '[data-input="text"]', function () {
		this.value = this.value.replace(/[^a-zA-Zа-яА-ЯёЁ .]/g, '');
	})
	
	// AGREE CHECKBOX
	.on('change', '[data-form-agree]', function () {
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

// CHECKBOX FORM ORDER
$(function () {
	
	$('#order').on('submit', function (e) {
		
		let form = $(this);
		let agree = form.find('input[data-form-agree]');
		let terms = agree.closest('.form-group');
		
		// Удаляем старые ошибки
		terms.removeClass('error');
		terms.find('.with-errors').remove();
		
		// Проверка чекбокса
		if (!agree.is(':checked')) {
			e.preventDefault();
			
			terms.addClass('error');
			terms.append('<div class="help-block with-errors"><ul class="list-unstyled"><li>Необходимо согласиться с политикой обработки персональных данных.</li></ul></div>');
			
			return false;
		}
	});
	
	// Убираем ошибку при клике на чекбокс
	$(document).on('change', 'input[data-form-agree]', function () {
		let terms = $(this).closest('.form-group');
		terms.removeClass('error');
		terms.find('.with-errors').remove();
	});
	
});

