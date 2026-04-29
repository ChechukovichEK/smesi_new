const DELAY=500;
$("document").ready(function($){
$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".phone-bottom").length) {
    $('.all-contacts').hide();
  }
  e.stopPropagation();
});

$(".enter-button").click(function(){
  $(this).next(".enter-open").slideToggle(0);
});

$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".enter").length) {
    $('.enter-open').hide();
  }
  e.stopPropagation();
});

$(".sam").click(function(){
  $(this).next(".sam-content").slideToggle(300);
});
$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".sam-item").length) {
    $('.sam-content').hide();
  }
  e.stopPropagation();
});

$(".run").click(function(){
  $(this).next(".run-content").slideToggle(300);
});
$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".run-item").length) {
    $('.run-content').hide();
  }
  e.stopPropagation();
});

//product quantity

$(document).on('click', '.input-number__minus', function () {
        let total = $(this).next();
        if (total.val() > 1) {
            total.val(+total.val() - 1);
        }
    });
    // Увеличиваем на 1
    $(document).on('click', '.input-number__plus', function () {
        let total = $(this).prev();
        const quantityMax = $(this).attr("data-quantity-max");
        const isMessageMax = $("#messageMax").hasClass("qm");

            console.log('total', total);
        console.log('quantityMax', quantityMax);

        if(total.val() + 1>quantityMax){
            if(!isMessageMax) {
                $(this).parent().parent().before('<div id="messageMax" class="qm" style="padding: 10px; text-align:center; background-color: red; color: #fff;font-size: 13px;">вами превышен доступный остаток</div>');
            }
        }else {
            total.val(+total.val() + 1);
        }
    });
    // Запрещаем ввод текста
    document.querySelectorAll('.input-number__input').forEach(function (el) {
        el.addEventListener('input', function () {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });

$(function(){
    $('.nav-all-open').on('click', function() {
        $('.navigation-main').slideToggle(0, function(){
            if($(this).css('display') === 'none'){
            $(this).removeAttr('style');
            }
        });
    });
});

if( window.innerWidth <= 768 ){
    $(document).on('click touchend', function(e) {
      if (!$(e.target).closest(".nav-all").length) {
        $('.navigation-main').hide();
      }
      e.stopPropagation();
    });
};

$('.cat-open-flex').masonry({
	itemSelector: '.cat-item',
	singleMode: true,
	isResizable: true,
	isAnimated: false,
});

$(function(){
	$('.cat-all-open').on('click', function(){
		if($('.cat-open').css('opacity') === '0'){
			$('.cat-open').css('opacity', '1');
			$('.cat-open').css('z-index', '1000');
			$('.cat-open').css('display', 'block');
			$('.cat-open-flex').masonry();
		}else if($('.cat-open').css('opacity') === '1'){
			$('.cat-open').css('opacity', '0');
			$('.cat-open').css('z-index', '-1');
			$('.cat-open').css('display', 'none');
		}
	});
});

$(function(){
	$('.cat-open-close').on('click', function(e){
	    e.stopPropagation();
		if($('.cat-open').css('opacity') === '1'){
			$('.cat-open').css('opacity', '0');
			$('.cat-open').css('z-index', '-1');
			$('.cat-open').css('display', 'none');
		};
	});
});

$(document).on('click', function(e) {
	if (!$(e.target).closest(".cat-all-open").length && !$(e.target).closest(".cat-open").length) {
		$('.cat-open').css('opacity', '0');
		$('.cat-open').css('z-index', '-1');
		$('.cat-open').css('display', 'none');
	}
	$('.cat-open-flex').masonry();
	e.stopPropagation();
});

$(function(){
  $('.nav-gamb-ft').on('click', function(){
    $('.nav-gor-ft').slideToggle(300, function(){
    	if($(this).css('display') === 'none'){
    	   $(this).removeAttr('style');
    	}
    });
  });
});

if( window.innerWidth <= 1000 ){
$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".logo-nav").length) {
    $('.nav-gor-ft').hide();
  }
  e.stopPropagation();
});
}

$(function(){
  $('.cat-fthid').on('click', function(){
    $('.cat-ft-wrap').slideToggle(300, function(){
    	if($(this).css('display') === 'none'){
    	   $(this).removeAttr('style');
    	}
    });
  });
});

if( window.innerWidth <= 1000 ){
$(document).on('click touchend', function(e) {
  if (!$(e.target).closest(".cat-ft").length) {
    $('.cat-ft-wrap').hide();
  }
  e.stopPropagation();
});
}


$(".close-cus").on("click",function(){
$(".parent_popup, .prod_popup").hide(DELAY);
});

$(".one-click").on("click",function(){
    $(".prod_popup").show(DELAY);return false;
    });

$(".slide-but-img, .ft-btn").on("click",function(){
    $(".parent_popup").show(DELAY);return false;
});

var nav = $('.header');
$(window).scroll(function () {
  if ($(this).scrollTop() > 700) {
  	nav.addClass("f-nav");
  } else {
  	nav.removeClass("f-nav");
    }
});

var viber = document.getElementsByClassName("viber");
  for (var i = 0; i < viber.length; i++) {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      viber[i].setAttribute('href', 'viber://add?number=375445920533');}
      else {
          viber[i].setAttribute('href', 'viber://chat?number=+375445920533');
      }
    };

$(".up-but").on("click",function(event){
  event.preventDefault();
  var id=$(this).attr('href');
  var top=$(id).offset().top;
  $('body,html').animate({scrollTop:top-150},1500);
});

$(".inp-phone").inputmask("+375 (99) 999-99-99");

});

/* FAQ
------------------------------------------------------------------------ */
$(document).on('click', '[data-faq-title]', function () {

    let $faq = $(this).closest('[data-faq]'),
        $text = $faq.find('[data-faq-content]');

    if($faq.hasClass('open')) {

        $faq.removeClass('open');
        $text.slideUp(300);

        return;
    }

    $faq.addClass('open');
    $text.slideDown(300);

});

$(document).ready(function () {
    $('.wholesale-btn').on('click', function (e) {
        e.preventDefault();

        const formOffset = $('#wholesaleForm').offset().top;

        $('html, body').animate(
            {
                scrollTop: formOffset - 50,
            },
            800
        );
    });
});