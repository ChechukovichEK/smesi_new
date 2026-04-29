/*акции - сортировка*/
  $('#sale_sortable').sortable({
    axis: 'y',
    opacity: 0.5,
    stop: function(){
   var arr = $('#sale_sortable').sortable("toArray");
     $.ajax({
     url: adminpath + '/product/salesortable',
     type: 'POST',
     data: {masiv:arr},
     error: function(){
     alert("Ошибка!");
     },
     success: function(){
       alert("Сохранено!");
     }
     });
   }
  });
/*акции - сортировка*/

/*хиты - сортировка*/
  $('#hit_sortable').sortable({
    axis: 'y',
    opacity: 0.5,
    stop: function(){
   var arr = $('#hit_sortable').sortable("toArray");
     $.ajax({
     url: adminpath + '/product/hitsortable',
     type: 'POST',
     data: {masiv:arr},
     error: function(){
     alert("Ошибка!");
     },
     success: function(){
       alert("Сохранено!");
     }
     });
   }
  });
/*акции - сортировка*/

$('#sortable_cats').sortable({
  axis: 'y',
  opacity: 0.5,
  stop: function(){
 var arr = $('#sortable_cats').sortable("toArray");
   $.ajax({
   url: adminpath + '/category/sortablecats',
   type: 'POST',
   data: {masiv:arr},
   error: function(){
   alert("Ошибка!");
   },
   success: function(){
     alert("Сохранено!");
   }
   });
 }
});

$('#all_sortable').sortable({
  axis: 'y',
  opacity: 0.5,
  stop: function(){
 var arr = $('#all_sortable').sortable("toArray");
   $.ajax({
   url: adminpath + '/product/sortableparent',
   type: 'POST',
   data: {masiv:arr},
   error: function(){
   alert("Ошибка!");
   },
   success: function(){
     alert("Сохранено!");
   }

   });
 }
});

$('#sortable').sortable({
  axis: 'y',
  opacity: 0.5,
  stop: function(){
 var arr = $('#sortable').sortable("toArray");
   $.ajax({
   url: adminpath + '/product/sortable',
   type: 'POST',
   data: {masiv:arr},
   error: function(){
   alert("Ошибка!");
   },
   success: function(){
     alert("Сохранено!");
   }

   });
 }
});

$('#sortable-attrs').sortable({
  axis: 'y',
  opacity: 0.5,
  stop: function(){
 var arr = $('#sortable-attrs').sortable("toArray");
   $.ajax({
   url: adminpath + '/category/sortable',
   type: 'POST',
   data: {masiv:arr},
   error: function(){
   alert("Ошибка!");
   },
   success: function(){
     alert("Сохранено!");
   }

   });
 }
});

/*удаление картинки Slider*/
$('.del-item-slider').on('click', function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/slider/delete-img',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function(){
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function(res){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if(res == 1){
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function(){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 1000);
        }
    });
});
/*удаление картинки Slider*/

/*загрузка изображения слайдер*/
if($('div').is('#slider-img1')){
  var buttonSlide1 = $("#slider-img1"),
      buttonSlide2 = $("#slider-img2"),
      buttonSlide3 = $("#slider-img3"),
      file;
}

if(buttonSlide1){
  new AjaxUpload(buttonSlide1, {
      action: adminpath + buttonSlide1.data('url') + "?upload=1",
      data: {name: buttonSlide1.data('name')},
      name: buttonSlide1.data('name'),
      onSubmit: function(file, ext){
          if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
              alert('Ошибка! Разрешены только картинки');
              return false;
          }
          buttonSlide1.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
          setTimeout(function(){
              buttonSlide1.closest('.file-upload').find('.overlay').css({'display':'none'});
              response = JSON.parse(response);
              $('.' + buttonSlide1.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
          }, 1000);
      }
  });
}

if(buttonSlide2){
  new AjaxUpload(buttonSlide2, {
      action: adminpath + buttonSlide2.data('url') + "?upload=1",
      data: {name: buttonSlide2.data('name')},
      name: buttonSlide2.data('name'),
      onSubmit: function(file, ext){
          if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
              alert('Ошибка! Разрешены только картинки');
              return false;
          }
          buttonSlide2.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
          setTimeout(function(){
              buttonSlide2.closest('.file-upload').find('.overlay').css({'display':'none'});
              response = JSON.parse(response);
              $('.' + buttonSlide2.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
          }, 1000);
      }
  });
}

if(buttonSlide3){
  new AjaxUpload(buttonSlide3, {
      action: adminpath + buttonSlide3.data('url') + "?upload=1",
      data: {name: buttonSlide3.data('name')},
      name: buttonSlide3.data('name'),
      onSubmit: function(file, ext){
          if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
              alert('Ошибка! Разрешены только картинки');
              return false;
          }
          buttonSlide3.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
          setTimeout(function(){
              buttonSlide3.closest('.file-upload').find('.overlay').css({'display':'none'});
              response = JSON.parse(response);
              $('.' + buttonSlide3.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
          }, 1000);
      }
  });
}
/*загрузка изображения слайдер*/


/* Filters */
$('body').on('change', '#dopcats', function(){
  var cat_id = $(this).val();
  var prod = $(this).data('prod')
  $.ajax({
      url: adminpath + '/product/getfiltercat',
      data: {cat_id: cat_id, prod:prod},
      type: 'GET',
      beforeSend: function(){
          $('.preloader').fadeIn(300, function(){
          });
        },
      success: function(res){
              $('.preloader').delay(500).fadeOut('slow');
              showFil(res);
          },
      error: function(){
              alert('Ошибка!');
          },
    });
});

$('body').on('change', '#dopcatsadd', function(){
  var cat_id = $(this).val();
  $.ajax({
      url: adminpath + '/product/getfiltercatadd',
      data: {cat_id: cat_id},
      type: 'GET',
      beforeSend: function(){
          $('.preloader').fadeIn(300, function(){
          });
        },
      success: function(res){
              $('.preloader').delay(500).fadeOut('slow');
              showFiladd(res);
          },
      error: function(){
              alert('Ошибка!');
          },
    });
});

function showFil(fil){
  $('.aj-enter').html(fil);
}

function showFiladd(fil){
  $('.aj-enter').html(fil);
}

$('.delete').click(function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
});

$('.del-item').on('click', function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/product/delete-img',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function(){
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function(res){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if(res == 1){
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function(){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 1000);
        }
    });
});

$('.del-item-brands').on('click', function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/brand/delete-img',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function(){
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function(res){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if(res == 1){
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function(){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 1000);
        }
    });
});

$('.sidebar-menu a').each(function(){
    var location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    var link = this.href;
    if(link == location){
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});

// CKEDITOR.replace('editor1');
$( '#editor1' ).ckeditor();

$( '#legal_entity' ).ckeditor({
    autoParagraph: false,
    startupMode: "source"
});
$( '#header_scripts' ).ckeditor({
    autoParagraph: false,
    startupMode: "source"
});
$( '#body_scripts' ).ckeditor({
    autoParagraph: false,
    startupMode: "source"
});
$( '#footer_scripts' ).ckeditor({
    autoParagraph: false,
    startupMode: "source"
});

$('#reset-filter').click(function(){
    $('#filter input[type=checkbox]').prop('checked', false);
    return false;
});

$(".select2").select2({
    placeholder: "Начните вводить наименование товара",
    cache: true,
    ajax: {
        url: adminpath + "/product/related-product",
        delay: 250,
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {
            return {
                results: data.items
            };
        }
    }
});

$(".select2cats").select2({
  placeholder: "Начните вводить наименование категории",
  cache: true,
  ajax: {
      url: adminpath + "/product/related-cats",
      delay: 250,
      dataType: 'json',
      data: function (params) {
          cat_ids = $('.select2cats').data('id');
          return {
              q: params.term,
              page: params.page,
              cat_ids: cat_ids,
          };
      },
      processResults: function (data, params) {
          return {
              results: data.items
          };
      }
  }
});

$(".select2dopcats").select2({
  placeholder: "Начните вводить наименование группы",
  cache: true,
  ajax: {
      url: adminpath + "/product/related-dopcats",
      delay: 250,
      dataType: 'json',
      data: function (params) {
          return {
              q: params.term,
              page: params.page,
          };
      },
      processResults: function (data, params) {
          return {
              results: data.items
          };
      }
  }
});

/*добавление атрибутов в группы фильтров*/
  $(".selectattrs").select2({
    placeholder: "Начните вводить наименование параметра",
    cache: true,
    ajax: {
        url: adminpath + "/filter/filter",
        delay: 250,
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page,
            };
        },
        processResults: function (data, params) {
            return {
                results: data.items
            };
        }
    }
  });
/*добавление атрибутов в группы фильтров*/

if($('div').is('#base-img')){
    var buttonSingle = $("#base-img"),
        buttonIcon = $("#icon-img"),
        file;
}

if($('div').is('#single')){
    var buttonOne = $("#single"),
        buttonMulti = $("#multi"),
        file;
}

if(buttonSingle){
    new AjaxUpload(buttonSingle, {
        action: adminpath + buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif|svg)$/i.test(ext))){
                alert('Ошибка! Разрешены только изображения');
                return false;
            }
            buttonSingle.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonSingle.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonSingle.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

if(buttonIcon){
    new AjaxUpload(buttonIcon, {
        action: adminpath + buttonIcon.data('url') + "?upload=1",
        data: {name: buttonIcon.data('name')},
        name: buttonIcon.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif|svg)$/i.test(ext))){
                alert('Ошибка! Разрешены только изображения');
                return false;
            }
            buttonIcon.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonIcon.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonIcon.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

if(buttonOne){
    new AjaxUpload(buttonOne, {
        action: adminpath + buttonOne.data('url') + "?upload=1",
        data: {name: buttonOne.data('name')},
        name: buttonOne.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonOne.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonOne.closest('.file-upload').find('.overlay').css({'display':'none'});
                response = JSON.parse(response);
                $('.' + buttonOne.data('name')).html('<img src="' + path + '/prodimg/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

if(buttonMulti){
    new AjaxUpload(buttonMulti, {
        action: adminpath + buttonMulti.data('url') + "?upload=1",
        data: {name: buttonMulti.data('name')},
        name: buttonMulti.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonMulti.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonMulti.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonMulti.data('name')).append('<img src="' + path + '/prodimg/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

if($('div').is('#newsimg')){
  var buttonNewsimg = $("#newsimg"),
      file;
}

if(buttonNewsimg){
  new AjaxUpload(buttonNewsimg, {
      action: adminpath + buttonNewsimg.data('url') + "?upload=1",
      data: {name: buttonNewsimg.data('name')},
      name: buttonNewsimg.data('name'),
      onSubmit: function(file, ext){
          if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
              alert('Ошибка! Разрешены только картинки');
              return false;
          }
          buttonNewsimg.closest('.file-upload').find('.overlay').css({'display':'block'});

      },
      onComplete: function(file, response){
          setTimeout(function(){
              buttonNewsimg.closest('.file-upload').find('.overlay').css({'display':'none'});
              response = JSON.parse(response);
              $('.' + buttonNewsimg.data('name')).html('<img src="' + path + '/images/' + response.file + '" style="max-height: 150px;">');
          }, 1000);
      }
  });
}

if($('div').is('#brandsimg')){
    var buttonBrandsimg = $("#brandsimg"),
        file;
}

if(buttonBrandsimg){
    new AjaxUpload(buttonBrandsimg, {
        action: adminpath + buttonBrandsimg.data('url') + "?upload=1",
        data: {name: buttonBrandsimg.data('name')},
        name: buttonBrandsimg.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonBrandsimg.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonBrandsimg.closest('.file-upload').find('.overlay').css({'display':'none'});
                response = JSON.parse(response);
                $('.' + buttonBrandsimg.data('name')).html('<img src="' + path + '/brands/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}




$('#add').on('submit', function(){
     if(!isNumeric( $('#category_id').val() )){
         alert('Выберите категорию');
         return false;
     }
});

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

/* Search */
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: adminpath + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 25,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = adminpath + '/product/edit?id=' + encodeURIComponent(suggestion.id);
});

/* Search Users */
var users = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: adminpath + '/searchuser/typeahead?query=%QUERY'
    }
});

users.initialize();

$("#typeahead_user").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'user',
    display: 'phone',
    limit: 25,
    source: users
});

$('#typeahead_user').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = adminpath + '/user/edit?id=' + encodeURIComponent(suggestion.id);
});
