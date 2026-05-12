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
				<div class="map-block-text"><?= \ishop\App::$app->getProperty('settings')['address_store']; ?></div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/org/smesi_by/66884555107/?ll=27.736355%2C53.946191&z=17">Показать на карте</a>
				<div class="map-block-line"></div>
				<div class="map-block-title">Офис</div>
				<div class="map-block-text"><?= \ishop\App::$app->getProperty('settings')['address_office']; ?></div>
				<a class="map-block-link" rel="nofollow" target="_blank" href="https://yandex.by/maps/-/CHC37U5S">Показать на карте</a>
			</div>
			<div class="map" id="map"></div>
		</div>
	</div>
<?php endif; ?>