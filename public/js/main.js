/*Cart*/
$('body').on('change', '.cart-qty input', function(){
  var id = $(this).data('id'),
  cart_qty = $(this).val() ? $(this).val() : 1;
  $.ajax({
      url: 'cart/addqty',
      data: {id: id, cart_qty: cart_qty},
      type: 'GET',
      beforeSend: function(){
          $('.preloader').fadeIn(300, function(){
          });
        },
      success: function(res){
              $('.preloader').delay(500).fadeOut('slow');
              showQty(res);
          },
      error: function(){
              alert('Ошибка!');
          },
    });
});

/*qty modal*/
$('#cart .modal-body').on('change', '.quantity input', function(){
  var id = $(this).data('id'),
  cart_qty = $(this).val() ? $(this).val() : 1;
  $.ajax({
      url: 'cart/addqtymod',
      data: {id: id, cart_qty: cart_qty},
      type: 'GET',
      beforeSend: function(){
          $('.preloader').fadeIn(300, function(){
          });
        },
      success: function(res){
              $('.preloader').delay(500).fadeOut('slow');
              showmodQty(res);
          },
      error: function(){
              alert('Ошибка!');
          },
    });
});


/*qty modal*/

$('body').on('click', '.red', function(e){
  window.location = location.pathname;
});

$('body').on('click', '.add-to-cart-link', function(e){
     e.preventDefault();
     var id = $(this).data('id'),
        qty = $(this).prev('.quantity').find('.input-number__input').val() ? $(this).prev('.quantity').find('.input-number__input').val() : 1;
         var url = window.location.href;
         if(url.indexOf('/product/') != -1){
         qty = $('.quantity input').val() ?  $('.quantity input').val() : 1;
         }
         $.ajax({
             url: 'cart/add',
             data: {id: id, qty: qty},
             type: 'GET',
             success: function(res){
               showCart(res);
               ym(98576053,'reachGoal','add_to_cart');
		gtag('event', 'add_to_cart');
             },
             error: function(){
                 alert('Ошибка! Попробуйте позже');
             }
         });

});

$('#cart .modal-body').on('click', '.del-item', function(){
    var id = $(this).data('id');
    $.ajax({
        url: 'cart/delete',
        data: {id: id},
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

function showQty(cart){
  $('.cart-wrap').html(cart);
  if($('.all-sum').text()){
      $('.cart span').html($('.all-sum').text());
  }
  if(!($('.all-sum').text())){
      $('.cart span').html('0');
  }

}

function showmodQty(cart){
$('#cart .modal-body').html(cart);
  if($('.all-sum').text()){
      $('.cart span').html($('.all-sum').text());
  }
  if(!($('.all-sum').text())){
      $('.cart span').html('0');
  }
  if($('.cart-qty').text()){
      $('.cart span').html($('#cart .cart-qty span').text());
  }
  if(!($('.cart-qty').text())){
      $('.cart span').html('0');
  }

}

function showCart(cart){
    if($.trim(cart) == '<h3>Корзина пуста</h3>'){
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    }else{
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if($('.cart-qty').text()){
        $('.cart span').html($('#cart .cart-qty span').text());
    }
    if(!($('.cart-qty').text())){
        $('.cart span').html('0');
    }
}

function getCart() {
    $.ajax({
        url: 'cart/show',
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Ошибка! Попробуйте позже');
        }
    });
}

function clearCart() {
  var res = confirm('Очистить корзину?');
  if(!res) return false;
    if(res){
    $.ajax({
        url: 'cart/clear',
        type: 'GET',
        success: function(res){
            showCart(res);
        },
        error: function(){
            alert('Ошибка! Попробуйте позже');
        }
    });
  }
}
/*Cart*/

/* Search */
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 20,
    source: products
});

$("#typeModal").typeahead({

},{
	name: 'products',
	display: 'title',
	limit: 5,
	source: products
});



$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/product/' + encodeURIComponent(suggestion.alias);
});

$('#typeModal').bind('typeahead:select', function(ev, suggestion) {
	// console.log(suggestion);
	window.location = path + '/product/' + encodeURIComponent(suggestion.alias);
});
/*Search*/

$(document).ready(function() {

    $(".all-open").click(function () {
        $(this).next(".all-contacts").slideToggle(300);
    });

    $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            minItems: 2,
            itemMargin: 5,
            asNavFor: '#slider'
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
});

$(document).ready(function() {
    if ($('.map').length) {
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                    center: [53.95, 27.685],
                    zoom: 13,
                    controls: ['zoomControl', 'fullscreenControl']
                }),

                myPlacemark1 = new ymaps.Placemark([53.945469, 27.695583], {
                    hintContent: 'Склад',
                    balloonContent: 'г. Минск, ул. Основателей 31/3'
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: 'img/icons/location.svg',
                    iconImageSize: [40, 40],
                    iconImageOffset: [-20, -20]
                }),

                myPlacemark2 = new ymaps.Placemark([53.954531, 27.676546], {
                    hintContent: 'Офис',
                    balloonContent: 'Минский район, д.Копище, ул.Лопатина, д.6-6А',
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: 'img/icons/location.svg',
                    iconImageSize: [40, 40],
                    iconImageOffset: [-20, -20],
                });

            myMap.geoObjects
                .add(myPlacemark1)
                .add(myPlacemark2);

            myMap.behaviors.disable('scrollZoom');
        });
    }
});

// VALIDATION PHONE
$(function () {
	$('[type="tel"]').inputmask('+375 (99) 999-99-99', {
		placeholder: '_'
	});
});

/* PRODUCTS PAGE SVP
------------------------------------------------------------------------ */

let productImageTimer;

$(document)
	.on('mouseover', '.svp-product-card-image .image-hover>span', function () {
		
		let el = $(this);
		
		productImageTimer = setTimeout(function (){
			
			let index = el.index(),
				images = el.closest('.svp-product-card-image');
			
			images.find('.image').removeClass('current').eq(index).addClass('current');
			images.find('.image-dots span').removeClass('current').eq(index).addClass('current');
			
		}, 300);
		
	})
	.on('mouseout', '.svp-product-card-image .image-hover>span', function () {
		
		clearTimeout(productImageTimer);
		
	});

/* PRODUCT FILTER
------------------------------------------------------------------------ */
$('body').on('change', '.flt-sections input[type=checkbox], [data-dropdown-input]', function () {
	
	let params = new URLSearchParams(window.location.search);
	
	// фильтры
	let checked = $('.flt-sections input:checked')
		.map(function () { return this.value })
		.get()
		.join(',');
	
	params.delete('filter');
	if (checked.length > 0) params.set('filter', checked);
	
	// сортировка
	let sort = $('input[name="sort"]:checked').val() || 'hit';
	params.set('sort', sort);
	
	params.delete('page');
	
	// показываем прелоадер ТОЛЬКО на card-list
	$('.card-list-preloader').fadeIn(100);
	
	$.ajax({
		url: location.pathname,
		data: params.toString(),
		type: 'GET',
		
		success: function (res) {
			
			// обновляем только товары
			$('.card-list').html(res);
			
			// обновляем текст сортировки
			let activeSort = $('input[name="sort"]:checked').val();
			let activeSortText = $('input[name="sort"]:checked')
				.closest('.dropdown-checker')
				.find('.dropdown-item')
				.text();
			
			
			// скрываем прелоадер
			$('.card-list-preloader').fadeOut(150);
			
			// обновляем URL
			history.pushState({}, '', location.pathname + '?' + params.toString());
		}
	});
});


/* PRODUCT SORT
------------------------------------------------------------------------ */
$('body').on('change', '[data-dropdown-input]', function () {
	
	let sort = $(this).val();
	
	let params = new URLSearchParams(window.location.search);
	
	// ставим сортировку
	params.set('sort', sort);
	
	// сохраняем фильтры
	let checked = $('.flt-sections input:checked')
		.map(function () { return this.value })
		.get()
		.join(',');
	
	params.delete('filter');
	if (checked.length > 0) {
		params.set('filter', checked);
	}
	
	params.delete('page');
	
	$.ajax({
		url: location.pathname,
		data: params.toString(),
		type: 'GET',
		
		beforeSend: function () {
			$('.preloader').fadeIn(100);
		},
		
		success: function (res) {
			$('.preloader').delay(200).fadeOut('slow');
			
			// обновляем только товары
			$('.card-list').html(res);
			
			// обновляем текст сортировки
			let activeSort = $('input[name="sort"]:checked').val();
			let activeSortText = $('input[name="sort"]:checked')
				.closest('.dropdown-checker')
				.find('.dropdown-item')
				.text();
			
			
			// обновляем URL
			history.pushState({}, '', location.pathname + '?' + params.toString());
		}
	});
});

/* DROPDOWN
------------------------------------------------------------------------ */

$(document).on('click', '[data-dropdown-label]', function (event) {
	
	event.preventDefault();
	
	let $dropdown = $(this).closest('[data-dropdown]');
	
	if ($dropdown.hasClass('open')) {
		$dropdown.removeClass('open');
		return;
	}
	
	$('[data-dropdown]').removeClass('open');
	$dropdown.addClass('open');
	
	
	return false;
})
	.on('click', '[data-dropdown-item]', function () {
		
		let $item = $(this),
			$dropdown = $item.closest('[data-dropdown]'),
			$label = $dropdown.find('[data-dropdown-label]');
		
		$dropdown.removeClass('open');
		$label.text($item.text());
		
	})
	.on('click', function (event) {
		
		if ($(event.target).closest('[data-dropdown]').length) return;
		
		$('[data-dropdown]').removeClass('open');
		
		event.stopPropagation();
		
	});

/* MODAL
------------------------------------------------------------------------ */

$(document)
	
	// Открытие модалки
	.on('click', '[data-toggle="modal-new"]', function (event) {
		event.preventDefault();
		
		let el = $(this),
			id = el.is('a')
				? el.attr('href')
				: el.attr('data-modal-target');
		
		// Если модалка уже открыта — закрываем
		if ($(id).hasClass('show')) {
			modal_hide(id);
			return false;
		}
		
		modal_show(id);
		return false;
	})
	
	// Закрытие по кнопке
	.on('click', '[data-modal="close"]', function (event) {
		event.preventDefault();
		
		let c = $(this).closest('[data-modal-container]');
		modal_hide(c.attr('data-modal-container'));
	})
	
	// Закрытие по клику на фон
	.on('click', '[data-modal-container]', function (event) {
		if ($(event.target).is('[data-modal-container]')) {
			modal_hide($(this).attr('data-modal-container'));
		}
	})
	
	// Закрытие по ESC
	.on('keydown', function (event) {
		if (event.which === 27) {
			let p = $('.modal-new.show');
			if (p.length) {
				modal_hide('#' + p.attr('id'));
			}
		}
	});


// Открытие модалки
function modal_show(id) {
	
	// Подсветить кнопку
	$('a[href="' + id + '"]').addClass('active');
	
	// Создаём контейнер, если его нет
	if ($('body > [data-modal-container="' + id + '"]').length === 0) {
		$('body').append(
			'<div class="modal-new-container" data-modal="container" data-modal-container="' + id + '"></div>'
		);
		
		$(id).appendTo('[data-modal-container="' + id + '"]');
		$('[data-modal-container="' + id + '"]').css('display', 'flex').hide();
	}
	
	// Блокируем скролл
	$('body').addClass('overflow');
	
	// Показываем
	$('[data-modal-container="' + id + '"]').fadeIn(120, function () {
		$(this).find('.modal-new').addClass('show');
	});
}


// Закрытие модалки
function modal_hide(id) {
	let $modal = $('[data-modal-container="' + id + '"]');
	
	// Убрать подсветку
	$('a[href="' + id + '"]').removeClass('active');
	
	$modal.find('.modal-new').removeClass('show');
	$modal.fadeOut(120);
	
	// Возвращаем скролл
	$('body').removeClass('overflow');
}


/* старый вывод фильтров на мобильном
------------------------------------------------------------------------ */
document.addEventListener("DOMContentLoaded", function () {
	const modal = document.querySelector(".filter-modal");
	const modalContent = modal.querySelector(".filter-modal-content");
	const modalBody = modal.querySelector(".filter-modal-body");
	const openBtn = document.querySelector(".filter-toggle");
	const closeBtn = modal.querySelector(".filter-close");
	
	openBtn.addEventListener("click", () => {
		const originalFilters = document.querySelector(".flt");
		modalBody.innerHTML = "";
		if (originalFilters) {
			const clone = originalFilters.cloneNode(true);
			clone.style.display = "block";
			modalBody.appendChild(clone);
		}
		
		modal.style.display = "block";
		document.body.style.overflow = "hidden";
	});
	
	closeBtn.addEventListener("click", closeModal);
	window.addEventListener("click", (e) => {
		if (e.target === modal) closeModal();
	});
	
	function closeModal() {
		modal.style.display = "none";
		document.body.style.overflow = "";
	}
	
	
	modal.addEventListener("click", (e) => {
		const btn = e.target.closest("button, input[type=submit]");
		if (!btn) return;
		
		if (btn.textContent.match(/Применить\s*фильтр/i)) {
			setTimeout(() => closeModal(), 300);
		}
	});
	
	
	$(document).ajaxComplete(function () {
		// При повторной загрузке фильтров, если модалка уже была добавлена — ничего не делаем
		if (!document.querySelector(".filter-toggle")) return;
	});
});