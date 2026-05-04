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
				<div class="map-block-text"><?= \ishop\App::$app->getProperty('address_store')['text']; ?></div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/-/CHC3zRn5">Показать на карте</a>
				<div class="map-block-line"></div>
				<div class="map-block-title">Офис</div>
				<div class="map-block-text"><?= \ishop\App::$app->getProperty('address_office')['text']; ?></div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/-/CHC37U5S">Показать на карте</a>
			</div>
			<div class="map" id="map"></div>
		</div>
	</div>
<?php endif; ?>