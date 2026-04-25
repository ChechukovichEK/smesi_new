<div class="breadcrumbs">
    <div class="breadcrumbs-content">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href='<?= PATH; ?>'>
                        <span itemprop="name">Главная</span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href='<?= PATH; ?>/article'>
                        <span itemprop="name">Школа ремонта</span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class='current-crumb'>
			<span itemprop="item">
				<span itemprop="name"><?= $new['title']; ?></span>
			</span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="pages-content" itemscope itemtype="http://schema.org/Article">
    <div class="container container-article">
        <h1><?= $new['title'] ?></h1>
        <p class="date" itemprop="datePublished"><?= $new['date'] ?></p>
        <div class="text-editor" itemprop="articleBody">
            <?= $new['content'] ?>
        </div>

    </div>

    <div class="article-contact-form-container">
        <div class="article-contact-form">
            <div class="content">
                <div class="description">
                    <div class="title">
                        Получите бесплатную консультацию по выбору или использованию строительных материалов!
                    </div>
                    <div class="text">Наши эксперты готовы помочь</div>
                </div>
                <form class="form" method="post" onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
                    <ul class="inputs">
                        <li>
                            <input class="form-input" type="text" name="name_cent" placeholder="Ваше имя" required/>
                        </li>
                        <li>
                            <input class="form-input" type="text" name="tel_cent" placeholder="Ваш телефон" required/>
                        </li>
                    </ul>
                    <div class="actions">
                        <button class="btn" type="submit" name="submit_tel">Перезвоните мне</button>
                    </div>
                </form>
            </div>
            <div class="bg">
                <img src="../img/home/article-contact-form-bg.jpg">
            </div>
        </div>
    </div>

    <div class="container container-article">
    <?php if (!empty($other_articles)): ?>
            <div class="related-articles" style="margin-top: 60px;">
                <div style="margin-bottom: 20px; font-size: 28px; color: #2b2b2b; font-family: 'MyriadProSemibold', sans-serif;">Читайте также</div>
                <div class="blog-list">
                    <?php foreach ($other_articles as $item): ?>
                        <?php
                        $date = new DateTime($item['date']);
                        $formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        $formatter->setPattern('d MMMM yyyy');
                        ?>
                        <a
                                class="blog-item"
                                href="/article/<?= $item['alias']; ?>"
                                itemprop="blogPosts"
                                itemscope
                                itemtype="http://schema.org/BlogPosting"
                        >
                            <div class="image-container">
                                <div class="image">
                                    <img src="/images/<?= $item['img']; ?>" alt="<?= $item['title']; ?>"/>
                                </div>
                            </div>
                            <div class="description">
                                <h3 class="title"><?= $item['title']; ?></h3>
                                <div class="date"><?= $formatter->format($date); ?></div>
                                <div class="text"><?= $item['pre_content']; ?></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
