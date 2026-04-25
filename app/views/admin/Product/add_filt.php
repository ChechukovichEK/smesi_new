<?php if (isset($nav_groupes) && !empty($nav_groupes)): ?>
<div class="form-group">
    <label for="category_id">Группа для навигации</label>
    <select name="category_id" class="form-control" id="category_id">
      <?php foreach ($nav_groupes as $item): ?>
          <option value="<?=$item->id;?>"<?php if($prod_inf->category_id == $item->id) echo ' selected'; ?>><?=$item['title'];?></option>
      <?php endforeach; ?>
    </select>
</div>
<?php endif; ?>

<script>

  //var id = $('.select2cats').data('id');
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


  $('.select2cats option').each(function() {
    var id = $('.select2cats').data('id');
    if (id === $(this).val()) {
      $(this).prop("disabled", true);
    }
  });


</script>
