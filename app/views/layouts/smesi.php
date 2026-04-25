<?

// включение буферизации вывода
ob_start();

?>
<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
	<meta property="og:type" content="website">
    <meta property="og:url" content="https://smesi.by<?= $_SERVER['REQUEST_URI'] ?>">
	<meta property="og:site_name" content="Smesi.by">
	<meta property="og:logo" content="https://smesi.by/favicon.svg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= $_SERVER['REQUEST_URI'] ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="AwuIjIZIy3uFn8Y_74PlH8WNOdrIdwxTWg0yYPQEc-s">
    <!-- Google NV -->
    <meta name="google-site-verification" content="5UyBcWXNs5br8Vc1fcC_JhtcNXjiT76xjlrXasNOF0U">
    <!-- Yandex NV -->
    <meta name="yandex-verification" content="89000ee2d5fc1151">

    <base href="<?= PATH ?>/">
    <link rel="shortcut icon" href="https://smesi.by/favicon.svg" type="image/x-icon">

    <?php
    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base_url = 'https://smesi.by';
    $canonical_url = $base_url . $request_uri;

    $show_canonical = false;

    if ($request_uri == '/' || $request_uri == '/index.php') {
        $canonical_url = $base_url . '/';
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'category') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'article') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'sale') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'vendors') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'contacts') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'catalog') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'page') !== false) {
        $show_canonical = true;
    }
    elseif (strpos($request_uri, 'product') !== false) {
        $show_canonical = true;
    }
    elseif (isset($_GET['page'])) {
        $show_canonical = true;
    }
    ?>

    <?php if ($show_canonical): ?>
        <link rel="canonical" href="<?= $canonical_url ?>"/>
    <?php endif; ?>

    <?= $this->getMeta(); ?>

    <?php if (isset($_GET['page'])): ?>
        <meta name="robots" content="noindex"/>
    <?php endif; ?>
	
	<?php $versionNumber = '17.06-12:30'?>
	
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?= $versionNumber ?>">
    <link rel="stylesheet" type="text/css" href="css/flexslider.min.css">
    <link rel="stylesheet" type="text/css" href="css/icon.min.css">

    <!-- Google tag (gtag.js) NV -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-11MSXY85SZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-11MSXY85SZ');
    </script>
    <!-- Google tag (gtag.js) -->
	
	<!-- Yandex.Metrika counter NV -->
	<script>
		(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
			m[i].l=1*new Date();
			for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
			k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
			// (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			(window, document, "script", "/metrika/tag.php", "ym");

		ym(98576053, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true,
			webvisor:true
		});
	</script>
	<!-- /Yandex.Metrika counter -->

	<?= \ishop\App::$app->getProperty('settings')['header_scripts'] ?>

</head>
<body>

<noscript><div><img loading="lazy" src="https://mc.yandex.ru/watch/98576053" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<?= \ishop\App::$app->getProperty('settings')['body_scripts'] ?>

<?php
if (isset($_POST["submit_tel"])) {
	if (isset($_POST["prod_title"])) {
		$spam = $_POST['surname_cent'];
		$name = htmlspecialchars($_POST['name_cent']);
		$phone = htmlspecialchars($_POST['tel_cent']);
		$prod_title = htmlspecialchars($_POST['prod_title']);
		if (empty($spam)) {
			mail("vershina_stroi@mail.ru", "Smesi.by - продукт - заявка", "\n
      Имя : " . $name . "
      Телефон : " . $phone . "
      Товар : " . $prod_title . "
      ");
			$chat_id = '-661035035';
			$text = '<b>Заявка с сайта - Заказ в один клик</b>%0A<i>Имя</i> - <b>' . $name . '</b>%0A<i>Телефон</i> - <b>' . strip_tags(trim(urlencode($phone))) . '</b>%0A<i>Товар</i> - <b>' . $prod_title . '</b>';
			$send_url = BASE_URL . 'sendMessage';
			$send_url .= "?chat_id={$chat_id}&parse_mode=html&text={$text}";
			$send = fopen($send_url, "r");

            add_feedback('Заказ в один клик', $name, $phone, $prod_title);

			echo '<p class="get-it" id="one_click_success">ВАША ЗАЯВКА ПРИНЯТА! СПАСИБО!</p>';
			header("Refresh: 5; url = https://smesi.by/");
		} else {
			header("Refresh: 5; url = https://smesi.by/");
			exit();
		}

	} else {
		$spam = $_POST['surname_cent'];
		$name = htmlspecialchars($_POST['name_cent']);
		$phone = htmlspecialchars($_POST['tel_cent']);
		if (empty($spam)) {
			mail("vershina_stroi@mail.ru", "Smesi.by - заявка", "\n
    Имя : " . $name . "
    Телефон : " . $phone . "
    ");
			$chat_id = '-661035035';
			$text = '<b>Заявка с сайта - Обратный звонок</b>%0A<i>Имя</i> - <b>' . $name . '</b>%0A<i>Телефон</i> - <b>' . strip_tags(trim(urlencode($phone))) . '</b>';
			$send_url = BASE_URL . 'sendMessage';
			$send_url .= "?chat_id={$chat_id}&parse_mode=html&text={$text}";
			$send = fopen($send_url, "r");

			add_feedback('Обратный звонок', $name, $phone);

			echo '<p class="get-it">ВАША ЗАЯВКА ПРИНЯТА! СПАСИБО!</p>';
			header("Refresh: 5; url = https://smesi.by/");
		} else {
			header("Refresh: 5; url = https://smesi.by/");
			exit();
		}
	}
}

function add_feedback($type, $name = null, $phone = null, $text = null)
{
	$feedback = \R::dispense('feedback');
	$feedback->type = $type;
	$feedback->name = $name;
	$feedback->phone = $phone;
	$feedback->text = $text;
	\R::store($feedback);
}

?>

<header class="header" id="header">
    <div class="header-top">
		<div class="container">
			<?php if (!empty($_GET)): ?>
				<p class="text">Интернет-магазин строительных материалов</p>
			<?php else: ?>
				<h1 class="text">Интернет-магазин строительных материалов</h1>
			<?php endif; ?>
			
			<div class="search">
				<form action="search" class="search-form" method="get" autocomplete="off">
					<p>
						<input type="text" class="typeahead" id="typeahead" name="s" placeholder="Поиск товаров.."
							   autocomplete="off">
						<input type="submit" class="search-bg" value="" title="Поиск товаров">
					</p>
				</form>
			</div>
		</div>
    </div>
    <div class="header-bottom">
        <div class="container">
			<a href="/" class="logo">
				<img src="/img/logo-dark.svg" alt="Smesi.by - Интернет-гипермаркет строительных материалов">
			</a>

            <div class="phones">
                <div class="phone-top">
					<div class="phone-bottom">
						<div class="all-open hover">
							<div
								class="phone-conv hover"
								title="Все контакты"
							>
								<?= \ishop\App::$app->getProperty('phone')['text'] ?>
							</div>
						</div>
						<div class="all-contacts">
							<div class="phone-top-all">
								<a
									class="phone-conv cont-icon hover"
									href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
									rel="nofollow"
								>
									<img
										loading="lazy"
										src="img/icons/social/phone.svg"
										alt="Вы можете связаться с нами по телефону - <?= \ishop\App::$app->getProperty('phone')['text'] ?>"
									>
								</a>
								<a
									class="phone-conv hover"
									href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
									rel="nofollow"
								>
									<?= \ishop\App::$app->getProperty('phone')['text'] ?>
								</a>
							</div>
							
							<? foreach (\ishop\App::$app->getProperty('additional_phones') as $additional_phone): ?>
								<div class="phone-top-all">
									<a
										class="phone-conv cont-icon hover"
										href="tel:<?= $additional_phone['link'] ?>"
										rel="nofollow"
									>
										<img
											loading="lazy"
											src="img/icons/social/phone.svg"
											alt="Вы можете связаться с нами по телефону - <?= $additional_phone['text'] ?>"
										>
									</a>
									<a
										class="phone-conv hover"
										href="tel:<?= $additional_phone['link'] ?>"
										rel="nofollow"
									>
										<?= $additional_phone['text'] ?>
									</a>
								</div>
							<? endforeach; ?>
							
							<div class="phone-top-all">
								<a
									class="phone-conv cont-icon hover"
									href="tel:+375172344018"
									rel="nofollow"
								>
									<img loading="lazy" src="images/old-tel.svg" alt="Вы можете связаться с нами по телефону - +375172344018">
								</a>
								<a
									class="phone-conv hover"
									href="tel:+375172344018"
									rel="nofollow"
								>
									+375 (17) 234-40-18
								</a>
							</div>
						</div>
					</div>
					<a
						class="viber cont-icon hover"
						href="viber://chat?number=%2B375445920533"
						onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
						rel="nofollow"
					>
						<img
							src="img/icons/social/viber.svg"
							alt="Вы можете связаться с нами по Viber">
					</a>
					<a
						class="tg cont-icon hover"
						href="https://t.me/+375445920533"
						onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
						rel="nofollow"
					>
						<img
							src="img/icons/social/telegram.svg"
							alt="Вы можете связаться с нами в Telegram"
						>
					</a>
                </div>
                <div class="email">
                    <a href="mailto:vershina_stroi@mail.ru">vershina_stroi@mail.ru</a>
                </div>
            </div>

            <a class="delivery" href="page/dostavka-i-oplata">Доставка и самовывоз!</a>

            <div class="enter">
                <div class="enter-button">
					<?php if (!empty($_SESSION['user'])): ?>
                        <?= $_SESSION['user']['name']; ?>
					<?php else: ?>
                        Аккаунт
					<?php endif; ?>
                </div>

				<?php if (!empty($_SESSION['user'])): ?>
                    <div class="enter-open">
                        <a class="open-enter" href="user/logout">Выход</a>
                        <a class="open-reg" href="user/cabinet">Личный кабинет</a>
                    </div>
				<?php else: ?>
                    <div class="enter-open">
                        <a class="open-enter" href="user/login">Вход</a>
                        <a class="open-reg" href="user/signup">Регистрация</a>
                    </div>
				<?php endif; ?>
            </div>

            <a href="cart/view" class="cart">
				<?php if (isset($_SESSION['cart.qty']) && !empty($_SESSION['cart.qty']) && !isset($_SESSION['user'])): ?>
                    <span><?= $_SESSION['cart.qty']; ?></span>
				<?php endif; ?>
				<?php if (!empty($_SESSION['user'])): ?>
					<?php $cart_qtytop = \ishop\App::$app->getProperty('cart_qtytop'); ?>
                    <span><?= $cart_qtytop; ?></span>
				<?php endif; ?>
                Корзина
            </a>
        </div>
    </div>
</header>

<div class="navigation">
    <div class="container">
        <div class="cat-all">
            <button class="cat-all-open">Каталог</button>
            <div class="cat-open">
				<div class="cat-open-close" title="Закрыть меню"></div>
				<?php new \app\widgets\menu\Menu([
					'tpl' => WWW . '/menu/menu-open.php',
					'container' => 'div',
					'class' => 'cat-open-flex',
				]) ?>

                <div class="go-cat">
                    <a href="/catalog" class="hover">перейти в каталог</a>
                </div>

            </div>
        </div>

        <div class="nav-all">
            <button class="nav-all-open">Меню</button>
            <nav class="navigation-main" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<a itemprop="url" class="navigation-main-link" href="/sale">
					Скидки и акции
				</a>
				<a itemprop="url" class="navigation-main-link" href="/vendors">
					Бренды
				</a>
				<a itemprop="url" class="navigation-main-link" href="/article">
					Школа ремонта
				</a>
				<?php new \app\widgets\pages\Pages(); ?>
				<a itemprop="url" class="navigation-main-link" href="/contacts">
					Контакты
				</a>
            </nav>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['error']) || isset($_SESSION['success'])): ?>
    <div class="sessions">
        <div class="sessions-content">
            <div class="ses-item">
				<?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" id="error">
						<?php echo $_SESSION['error'];
						unset($_SESSION['error']); ?>
                    </div>
				<?php endif; ?>
				<?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" id="success">
						<?php echo $_SESSION['success'];
						unset($_SESSION['success']); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $content; ?>

<div class="contact-form">
	<div class="container">
		<div class="contact-form-title">Свяжитесь с&nbsp;нами! Мы&nbsp;гарантируем Специальные&nbsp;цены и&nbsp;Бонусы!</div>
		<form class="form" method="post" onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
			<input class="form-input" type="text" name="name_cent" placeholder="Ваше имя" required/>
			<input class="form-input" type="text" name="tel_cent" placeholder="Ваш телефон" required/>
			<div class="btn-wow-wrapper">
				<input class="btn btn-orange" type="submit" value="Перезвоните мне" name="submit_tel">
			</div>
		</form>
	</div>
</div>

<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
?>

<?php if ($url == '/' || $url == '/contacts'): ?>
	<div class="map-block">
		<div class="container">
			<div class="map-block-info">
				<div class="map-block-title">Склад</div>
				<div class="map-block-text">г.&nbsp;Минск, ул.&nbsp;Основателей 31/3</div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/-/CHC3zRn5">Показать на карте</a>
				<div class="map-block-line"></div>
				<div class="map-block-title">Офис</div>
				<div class="map-block-text">Минская область, д.&nbsp;Копище, ул.&nbsp;Лопатина д.6-6А</div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/-/CHC37U5S">Показать на карте</a>
			</div>
			<div class="map" id="map"></div>
		</div>
	</div>
<?php endif; ?>

<footer>
	<div class="footer" itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="name" content="ЧПТУП Вершина-строй">
		<meta itemprop="telephone" content="<?= \ishop\App::$app->getProperty('phone')['link'] ?>">
		<meta itemprop="email" content="vershina_stroi@mail.ru">
		<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<meta itemprop="streetAddress" content="ул.Лопатина, д.6-6А">
			<meta itemprop="postalCode" content="220125">
			<meta itemprop="addressLocality" content="Минский район, д.Копище">
		</span>
		<div class="footer-content">
	
			<div class="logo-nav">
	
				<div class="logo-ft">
					<a href="/" class="logo">
						<img loading="lazy" src="img/logo-light.svg" alt="Smesi.by - Интернет-гипермаркет строительных материалов">
					</a>
				</div>
	
				<div class="nav-gamb-ft hover">
					<p>МЕНЮ</p>
					<div class="nav-gamb">
						<img loading="lazy" src="images/gamburger.svg" alt="Каталог">
					</div>
				</div>
	
				<div class="nav-gor-ft">
                    <div class="nav-schedule">
                        <div class="title">Время работы склада</div>
                        <ul class="schedule">
                            <li>ПН-ПТ с 9:30 до 17:30</li>
                            <li>СБ-ВС выходной</li>
                        </ul>
                    </div>

					<nav>
						<a class="nav-item-ft hover" href="sale">
							Скидки и акции
						</a>
						<a class="nav-item-ft hover" href="article">
							Школа ремонта
						</a>
						<?php new \app\widgets\pages\Pages([
							'tpl' => WWW . '/pages/pages_bottom.php',
						]); ?>
						<!--<a class="nav-item-ft hover" href="/vendors">
							Бренды
						</a>-->
					</nav>
				</div>
			</div>
	
			<div class="cat-ft">
				<div class="cat-fthid hover">
					<div>
						<p>КАТАЛОГ</p>
						<div class="cat-gamb">
							<img loading="lazy" src="images/gamburger.svg" alt="Каталог">
						</div>
					</div>
				</div>
				<p class="cat-ttl">
					Каталог
				</p>
	
				<div class="cat-ft-wrap">
					<?php if (!isset($_GET['catalog'])) {
						new \app\widgets\menu\Menu([
							'tpl' => WWW . '/menu/menu_footer.php',
							'container' => 'div',
							'class' => 'cat-ft-items',
						]);
					} ?>
				</div>
			</div>
	
			<div class="ft-contacts">
				
				<div class="ft-phones">
                    <a
                        class="phone-conv hover"
                        href="tel:<?= \ishop\App::$app->getProperty('phone')['link'] ?>"
                        onclick="gtag('event', 'call_click'); return true;"
                        rel="nofollow"
                    >
                        <?= \ishop\App::$app->getProperty('phone')['text'] ?>
                    </a>

					<a
						class="viber cont-icon hover"
						href="viber://chat?number=%2B375445920533"
						onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
						rel="nofollow"
					>
						<img
							loading="lazy"
							src="img/icons/social/viber.svg"
							alt="Вы можете связаться с нами по Viber"
						>
					</a>
					<a
						class="tg cont-icon hover"
						href="https://t.me/+375445920533"
						onclick="ym(98576053,'reachGoal','social_click');gtag('event', 'social_click'); return true;"
						rel="nofollow"
					>
						<img
							loading="lazy"
							src="img/icons/social/telegram.svg"
							alt="Вы можете связаться с нами в Telegram"
						>
					</a>
				</div>
                <div class="ft-email">
                    <a href="mailto:vershina_stroi@mail.ru">vershina_stroi@mail.ru</a>
                </div>
				<div class="ft-btn">
					<p>Перезвони мне</p>
				</div>

				<div class="ft-info">
					<?= \ishop\App::$app->getProperty('settings')['legal_entity'] ?>
				</div>
                <div class="nav-schedule-mobile">
                    <div class="title">Время работы склада</div>
                    <ul class="schedule">
                        <li>ПН-ПТ с 9:30 до 17:30</li>
                        <li>СБ-ВС выходной</li>
                    </ul>
                </div>
				<div class="nav-gor-ft nav-groups">
					<nav>
						<a class="nav-item-ft hover" href="https://vk.com/smesiby" target="_blank" rel="nofollow">
                            <img
                                loading="lazy"
                                src="img/icons/social/vk.svg"
                                alt="Сообщество ВКонтакте"
                            >
                        </a>
						<a class="nav-item-ft hover" href="https://www.facebook.com/profile.php?id=61573075610960" target="_blank" rel="nofollow">
                            <img
                                loading="lazy"
                                src="img/icons/social/facebook.svg"
                                alt="Cообщество Facebook"
                            >
                        </a>
					</nav>
				</div>
			</div>
			<?= \ishop\App::$app->getProperty('settings')['legal_entity'] ?>
		</div>
	</div>

	<div class="cr">
		<div class="cr-content">
			© <?= date("Y")?> Smesi.by Все права защищены
		</div>
	</div>
</footer>

<div class="parent_popup">
	<div class="popup" id="pop-cat">
		<div class="close-cus hover">
			<p>X</p>
		</div>
		<div class="form-main">
			<!--            <h3>Заполните форму</h3>-->
			<div class="title">Заполните форму</div>
			<form method="post" class="call-back" onsubmit="ym(98576053,'reachGoal','call_back');gtag('event', 'call_back'); return true;">
				<div class="input-pop">
					<input type="text" name="name_cent" class="inputbox-pop" placeholder="Имя" required
						   onfocus="this.placeholder = ''"
						   onblur="this.placeholder = 'Имя'"/>
				</div>
				<div class="input-pop">
					<input type="text" name="tel_cent" class="inputbox-pop" placeholder="Телефон" required
						   onfocus="this.placeholder = ''"
						   onblur="this.placeholder = 'Телефон'"/>
				</div>
				<div class="input-pop-s">
					<input type="text" name="surname_cent" class="inputbox" placeholder="Ваша фамилия"/>
				</div>
				<input type="submit" class="button-order hover c-back" value="Отправить" name="submit_tel"/>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close red"><span aria-hidden="true">&times;</span></button>
<!--                <h4 class="modal-title" id="myModalLabel">Корзина</h4>-->
                <div class="model_title modal-title" id="myModalLabel">Корзина</div>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="do-shopping btn btn-default red hover">Продолжить покупки</button>
<!--                <a href="cart/view" type="button" class="do-order hover">Оформить заказ</a>-->
                <a href="cart/view" class="do-order hover">Оформить заказ</a>
                <button type="button" class="clear-cart hover" onclick="clearCart()">Очистить корзину</button>
            </div>
        </div>
    </div>
</div>

<div class="preloader"><img loading="lazy" src="images/ring.svg" alt="Идёт загрузка данных" title="Идёт загрузка данных"></div>
<script>
    var path = '<?=PATH;?>';
</script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/typeahead.bundle.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=7b7ace7f-20e8-4f2f-bc0b-95bf1fec251f"></script>
<!--<script src="js/slick.min.js"></script>-->
<script src="js/jquery.flexslider.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/sliders.js?v=<?= $versionNumber ?>"></script>
<script src="js/masonry.js"></script>
<script src="js/base.js?v=<?= $versionNumber ?>"></script>
<script src="js/main.js?v=<?= $versionNumber ?>"></script>

<?= \ishop\App::$app->getProperty('settings')['footer_scripts'] ?>

</body>

<?

// запись буфера в переменную и отключение буферизации вывода
$content_html = ob_get_clean();

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use WebPParseAndConvert\WebPParseAndConvert;

//var_dump($_SERVER['HTTP_USER_AGENT']);

$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/public';

$options = [
	"formats" => ['jpg', 'jpeg', 'png'],
	"patterns" => [
		[
			'pattern' => '/<img[^>]+src=("[^"]*")[^>]*>/i',
			'exclude' => ['"', './']
		],
		[
			'pattern' => '/background-image:.+url\(([^"]+)\)/i',
			'exclude' => ["'", "./"]
		],
	],
	"devices" => [],
	"converterOptions" => [],
	"debug" => false,
	"useApi" => false,
	"api" => []
];

$converter = new WebPParseAndConvert($content_html,  $rootDir, $options);
$content_html = $converter->execute();

$content_html = str_replace(".webp.webp", ".webp", $content_html);

 //выводим итоговый HTML
echo $content_html;
?>