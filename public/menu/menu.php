<?php if(!$category['parent_id']):?>
  <a href="category/<?=$category['alias'];?>" class="swiper-slide">
    <img src="images/<?=$category['icon'];?>" alt="<?=$category['title'];?>">
    <p><?=$category['title'];?></p>
  </a>
<?php endif; ?>
