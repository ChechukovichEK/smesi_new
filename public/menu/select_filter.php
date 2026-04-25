<?php $parent_cat_id = \ishop\App::$app->getProperty('parent_cat_id'); ?>
<option value="<?=$id;?>"<?php if($id == $parent_cat_id) echo ' selected'; ?>>
    <?=$tab . $category['title'];?>
</option>
<?php if(isset($category['childs'])): ?>
    <?= $this->getMenuHtml($category['childs'], '&nbsp;' . $tab. '-') ?>
<?php endif; ?>
