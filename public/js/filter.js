/* ============================
   ГЛОБАЛЬНОЕ: запрет автозапуска AJAX
============================ */
let firstLoad = true;

/* ============================
   Сбор параметров
============================ */
function buildParams(page = null) {
	let params = new URLSearchParams(window.location.search);
	
	// фильтры
	let checked = $('.filters-sections input:checked')
		.map(function () { return this.value })
		.get()
		.join(',');
	
	params.delete('filter');
	if (checked.length > 0) params.set('filter', checked);
	
	// сортировка
	let sort = $('input[name="sort"]:checked').val() || 'hit';
	params.set('sort', sort);
	
	// страница
	if (page) {
		params.set('page', page);
	} else {
		params.delete('page');
	}
	
	params.delete('ajax');
	
	return params;
}

/* ============================
   AJAX обновление
============================ */
function applyFiltersAndSort(page = null, scroll = false) {
	
	// блокируем автозапуск при первой загрузке
	if (firstLoad) {
		firstLoad = false;
		
		if (page === null) return;
		
	}
	
	let params = buildParams(page);
	
	$('.card-list-preloader').fadeIn(100);
	
	$.ajax({
		url: location.pathname + '?' + params.toString() + '&ajax=1',
		type: 'GET',
		headers: { 'X-Requested-With': 'XMLHttpRequest' },
		success: function (res) {
			$('#ajax-container').html(res);
			$('.card-list-preloader').fadeOut(150);
			
			history.pushState({}, '', location.pathname + '?' + params.toString());
			
			if (scroll) {
				$('html, body').animate({ scrollTop: 0 }, 300);
			}
			//$('html, body').animate({ scrollTop: $('#ajax-container').offset().top }, 300);
		},
		error: function () {
			$('.card-list-preloader').fadeOut(150);
			alert('Ошибка запроса');
		}
	});
}

/* ============================
   ФИЛЬТРЫ
============================ */
$('body').on('change', '.filters-sections input[type=checkbox]', function () {
	applyFiltersAndSort(1);
});

/* ============================
   СОРТИРОВКА (dropdown)
============================ */
$(document)
	.on('click', '[data-dropdown-label]', function (event) {
		event.preventDefault();
		
		let $dropdown = $(this).closest('[data-dropdown]');
		
		if ($dropdown.hasClass('open')) {
			$dropdown.removeClass('open');
			return false;
		}
		
		$('[data-dropdown]').removeClass('open');
		$dropdown.addClass('open');
		
		return false;
	})
	.on('click', '[data-dropdown-item]', function () {
		let $item = $(this),
			$dropdown = $item.closest('[data-dropdown]'),
			$label = $dropdown.find('[data-dropdown-label]'),
			$input = $item.closest('label').find('input[type=radio]');
		
		$dropdown.removeClass('open');
		$label.text($item.text());
		
		$input.prop('checked', true);
		
		applyFiltersAndSort(1);
	})
	.on('click', function (event) {
		if ($(event.target).closest('[data-dropdown]').length) return;
		$('[data-dropdown]').removeClass('open');
	});

/* ============================
   AJAX пагинация
============================ */
$('body').on('click', '.pagination a', function (e) {
	e.preventDefault();
	
	let url = new URL(this.href);
	let page = url.searchParams.get('page');
	
	applyFiltersAndSort(page || 1, true);
});

/* ============================
   POPSTATE — назад/вперёд
============================ */
window.addEventListener('popstate', function () {
	$.ajax({
		url: location.pathname + window.location.search,
		type: 'GET',
		headers: { 'X-Requested-With': 'XMLHttpRequest' },
		success: function (res) {
			$('#ajax-container').html(res);
		}
	});
});

/* MODAL FILTERS CATEGORY
------------------------------------------------------------------------ */

$(document).ready(function () {
	
	const $modal = $('#modalFilters');
	const $modalBody = $modal.find('.modal-new-filters');
	
	// Клонируем фильтр
	const $filtersClone = $('.filters').clone();
	$filtersClone.css('display', 'block');
	
	
	// При открытии модалки "Фильтры"
	$(document).on('click', '[href="#modalFilters"][data-toggle="modal-new"]', function () {
		
		$modalBody.empty().append($filtersClone);
	});
	
});

/* Переключение категорий в брендах без перезагрузки
------------------------------------------------------------------------ */
$(document).on('click', '.filter-category-item', function(e){
	e.preventDefault();
	let $item = $(this);
	let url = $item.attr('href');
	
	// переключаем активный таб
	$('.filter-category-item').removeClass('filter-category-item-current');
	$item.addClass('filter-category-item-current');
	
	// сначала проверяем редирект
	$.ajax({
		url: '/vendors/check',
		type: 'POST',
		dataType: 'json',
		data: { url: url },
		success: function(res){
			if (res.redirect) {
				// если редирект найден — делаем переход
				window.location.href = res.redirect;
			} else {
				// иначе обычная AJAX‑подгрузка
				$.ajax({
					url: url + (url.indexOf('?') > -1 ? '&ajax=1' : '?ajax=1'),
					type: 'GET',
					headers: { 'X-Requested-With': 'XMLHttpRequest' },
					success: function(res){
						$('#ajax-container').html(res);
					},
					error: function(){
						alert('Ошибка загрузки товаров');
					}
				});
			}
		}
	});
});