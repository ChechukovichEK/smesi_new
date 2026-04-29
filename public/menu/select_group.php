<?php $catgroup_id = \ishop\App::$app->getProperty('catgroup_id'); ?>
<option value="<?=$id;?>"<?php if($id == $catgroup_id) echo ' selected'; ?>>
    <?=$tab . $category['title'];?>
</option>
<?php if(isset($category['childs'])): ?>
    <?= $this->getMenuHtml($category['childs'], '&nbsp;' . $tab. '-') ?>
<?php endif; ?>
