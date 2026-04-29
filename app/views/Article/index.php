<div class="breadcrumbs">
    <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href='<?=PATH;?>'>Главная</a></li>
        <li class='current-crumb'>Статьи</li>
      </ol>
    </div>
  </div>
</div>

<div class="pages-content">
	<div class="container">
    <h1>Полезный блог</h1>
	<?php if (isset($news) && !empty($news)): ?>
		<div class="blog-list">
			<?php foreach ($news as $item): ?>
                <?php
                $date = new DateTime($item['date']);
				
				if ($item['published_at'] !== '0000-00-00 00:00:00') {
					$published_at = new DateTime($item['published_at']);
				}else{
					$published_at = '';
				}

                $formatter = new IntlDateFormatter(
                'ru_RU',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE,
                );

                $formatter->setPattern('d MMMM yyyy');
                ?>

				<a
					class="blog-item"
					href="article/<?=$item['alias'];?>"
					itemprop="blogPosts"
					itemscope
					itemtype="http://schema.org/BlogPosting"
				>
                    <div class="image-container">
                        <div class="image">
                            <img itemprop="image" src="images/<?=$item['img'];?>" alt="<?=$item['title'];?>"/>
                        </div>
                    </div>

					<div class="description">
						<h2 class="title" itemprop="headline"><?=$item['title'];?></h2>
						<div class="data-block">
							<div class="date" itemprop="datePublished">Опубликовано: <?= $formatter->format($date); ?></div>
							
							<?php if (!empty($published_at) && $published_at !== ''): ?>
								<div class="date" itemprop="dateModified">Обновлено: <?= $formatter->format($published_at); ?></div>
							<?php endif; ?>
							
						</div>
						<div class="text" itemprop="description">
							<?=$item['pre_content'];?>
						</div>
						<div class="more">Узнать подробнее</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<?php else: ?>
			<div class = "if-not">
				<p>Скоро здесь появятся самые полезные и интересные статьи о ремонте</p>
			</div>
		<?php endif; ?>
	</div>
</div>
