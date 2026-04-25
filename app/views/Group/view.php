<!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <ol class="breadcrumb">
      <li><a href="<?=PATH;?>">Главная</a></li>
      <li><a href="category/<?=$category->alias;?>"><?=$category->title;?></a></li>
      <li><?=$groupe->title;?></li>
    </ol>
  </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="flt-prod-content">
  <div class="hits-items">
    <?php if (isset($groupe_products)): ?>
      <?php foreach ($groupe_products as $product): ?>
        <div class="hits-item">
          <a href="product/<?=$product->alias;?>" class="hit-img hover">
            <img src="prodimg/<?=$product->img;?>" alt="<?=$product->title;?>">
          </a>
          <p class="articul">
            <?php if(!empty($product->articul)): ?>
              Артикул: <?=$product->articul;?>
            <?php endif; ?>
          </p>
          <div class="is-there">
            <?php if(($product->is_have !== '0') && ($product->is_have !== '-')): ?>
              <img src="images/chek.svg" alt="наличие">
              <p>в наличии</p>
            <?php else : ?>
              <img src="images/chek-wait.svg" alt="наличие">
              <p class="chek-wait">ожидается поступление</p>
            <?php endif;?>
          </div>
          <a href="product/<?=$product->alias;?>" class="hit-title hover"><?=$product->title;?></a>
          <div class="price">
            <p><!--<span>10,86</span>--><?=$product->price;?></p>
            <p>руб./<?=$product->units;?></p>
          </div>
          <?php if($product->is_have !== '0' && $product->is_have !== '-'): ?>
            <div class="q-cart">
              <div class="quantity">
                <!--<input type="number" name="quantity" value="1" size="4" min="1" step="1">-->
                <div class="input-number__minus">-</div>
                <input class="input-number__input" type="text" pattern="^[0-9]+$" value="1" name="quantity">
                <div class="input-number__plus">+</div>
              </div>
              <div class="to-cart hover">
                <img src="images/to-cart.svg" alt="в корзину">
                <p>в корзину</p>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
