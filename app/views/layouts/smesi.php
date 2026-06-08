<?php

// отключаем layout для AJAX
if (defined('NO_LAYOUT')) return;
// включение буферизации вывода
ob_start();


if (!isset($_SESSION['csrf'])) {
	$_SESSION['csrf'] = bin2hex(random_bytes(16));
}

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
	
	<?= \ishop\App::$app->getProperty('settings')['header_scripts'] ?? null; ?>
	
	<link rel="shortcut icon" href="https://smesi.by/favicon.svg" type="image/x-icon">
	
	<base href="<?= PATH ?>/">
	
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
	
	<?= ishop\App::$app->getProperty('settings')['body_scripts']  ?? null; ?>

</head>

<?php
	$alias = \ishop\App::$app->getProperty('page_alias');
	$alias = $alias ? 'page-' . $alias : '';
?>

<body class="<?= $alias ?>">

<noscript>
	<div><img loading="lazy" src="https://mc.yandex.ru/watch/98576053" style="position:absolute; left:-9999px;" alt=""/>
	</div>
</noscript>

<?= \ishop\App::$app->getProperty('settings')['body_scripts'] ?>



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
<script>
	var path = '<?=PATH;?>';
</script>


<link rel="stylesheet" href="<?= PATH ?>/font-awesome/css/all.min.css">
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
<script src="<?= PATH ?>/js/form.js?v=<?= $versionNumber ?>"></script>

<?= \ishop\App::$app->getProperty('settings')['footer_scripts'] ?? null; ?>

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
			// НЕ трогаем <picture>, <source>, base64, svg, og, icons
			'pattern' => '/<img(?![^>]+data-no-webp)(?![^>]+src="data:)(?![^>]+src="[^"]+\.svg)(?![^>]+property="og:image")[^>]+src="([^"]+\.(?:jpg|jpeg|png))"[^>]*>/i',
			'exclude' => ['"', './']
		],
		[
			// background-image: url(...)
			'pattern' => '/background-image:\s*url\((?!data:)([^)]+\.(?:jpg|jpeg|png))\)/i',
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