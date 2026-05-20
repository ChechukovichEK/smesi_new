<?php

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
	<?= $this->getMeta(); ?>
	<meta property="og:image:type" content="image/jpg">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta name="twitter:card" content="summary_large_image">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="AwuIjIZIy3uFn8Y_74PlH8WNOdrIdwxTWg0yYPQEc-s">
	<!-- Google NV -->
	<meta name="google-site-verification" content="5UyBcWXNs5br8Vc1fcC_JhtcNXjiT76xjlrXasNOF0U">
	<!-- Yandex NV -->
	<meta name="yandex-verification" content="89000ee2d5fc1151">
	
	<link rel="shortcut icon" href="https://smesi.by/favicon.svg" type="image/x-icon">
	
	<base href="<?php PATH?>/">
	
	<?php
	$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$base_url = 'https://smesi.by';
	$canonical_url = $base_url . $request_uri;
	
	$show_canonical = false;
	
	if ($request_uri == '/' || $request_uri == '/index.php') {
		$canonical_url = $base_url . '/';
		$show_canonical = true;
	} elseif (strpos($request_uri, 'category') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'article') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'sale') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'vendors') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'contacts') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'catalog') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'page') !== false) {
		$show_canonical = true;
	} elseif (strpos($request_uri, 'product') !== false) {
		$show_canonical = true;
	} elseif (isset($_GET['page'])) {
		$show_canonical = true;
	}
	?>
	
	<?php if ($show_canonical): ?>
		<link rel="canonical" href="<?= $canonical_url ?>"/>
	<?php endif; ?>
	
	<?php if (isset($_GET['page'])): ?>
		<meta name="robots" content="noindex"/>
	<?php endif; ?>
	
	<?php $versionNumber = '17.06-12:30' ?>
	
	<link rel="stylesheet" href="<?= PATH ?>/css/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="<?= PATH ?>/css/style.css?v=<?= $versionNumber ?>">
	<link rel="stylesheet" type="text/css" href="<?= PATH ?>/css/flexslider.min.css">
	<link rel="stylesheet" type="text/css" href="<?= PATH ?>/css/icon.min.css">
	
	<!-- Google tag (gtag.js) NV -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-11MSXY85SZ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		
		function gtag() {
			dataLayer.push(arguments);
		}
		
		gtag('js', new Date());
		
		gtag('config', 'G-11MSXY85SZ');
	</script>
	<!-- Google tag (gtag.js) -->
	
	<!-- Yandex.Metrika counter NV -->
	<script>
		(function (m, e, t, r, i, k, a) {
			m[i] = m[i] || function () {
				(m[i].a = m[i].a || []).push(arguments)
			};
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) {
				if (document.scripts[j].src === r) {
					return;
				}
			}
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})
			// (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			(window, document, "script", "/metrika/tag.php", "ym");
		
		ym(98576053, "init", {
			clickmap: true,
			trackLinks: true,
			accurateTrackBounce: true,
			webvisor: true
		});
	</script>
	<!-- /Yandex.Metrika counter -->
	
	<?= \ishop\App::$app->getProperty('settings')['header_scripts'] ?>

</head>
<body>

<noscript>
	<div><img loading="lazy" src="https://mc.yandex.ru/watch/98576053" style="position:absolute; left:-9999px;" alt=""/>
	</div>
</noscript>

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

<?php require APP . '/views/layouts/template/header.php'; ?>

<?php require APP . '/views/layouts/template/navigation.php'; ?>

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

<?php require APP . '/views/layouts/components/contact-form.php'; ?>
<?php require APP . '/views/layouts/components/map-block.php'; ?>

<?php require APP . '/views/layouts/template/footer.php'; ?>

<?php require APP . '/views/layouts/template/modals.php'; ?>

<div class="preloader"><img loading="lazy" src="images/ring.svg" alt="Идёт загрузка данных"
							title="Идёт загрузка данных"></div>
<script>
	var path = '<?=PATH;?>';
</script>

<script src="<?= PATH ?>/js/jquery.min.js"></script>
<script src="<?= PATH ?>/js/bootstrap.min.js"></script>
<script src="<?= PATH ?>/js/validator.js"></script>
<script src="<?= PATH ?>/js/typeahead.bundle.min.js"></script>
<script src="<?= PATH ?>/js/responsiveslides.min.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=7b7ace7f-20e8-4f2f-bc0b-95bf1fec251f"></script>
<!--<script src="js/slick.min.js"></script>-->
<script src="<?= PATH ?>/js/jquery.flexslider.min.js"></script>
<script src="<?= PATH ?>/js/jquery.inputmask.min.js"></script>
<script src="<?= PATH ?>/js/swiper-bundle.min.js"></script>
<script src="<?= PATH ?>/js/sliders.js?v=<?= $versionNumber ?>"></script>
<script src="<?= PATH ?>/js/masonry.js"></script>
<script src="<?= PATH ?>/js/base.js?v=<?= $versionNumber ?>"></script>
<script src="<?= PATH ?>/js/main.js?v=<?= $versionNumber ?>"></script>

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

$converter = new WebPParseAndConvert($content_html, $rootDir, $options);
$content_html = $converter->execute();

$content_html = str_replace(".webp.webp", ".webp", $content_html);

//выводим итоговый HTML
echo $content_html;
?>