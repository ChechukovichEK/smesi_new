<?php

use ishop\Router;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Router::add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'product', 'action' => 'view']);
Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'category', 'action' => 'view']);
Router::add('^page/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'page', 'action' => 'view']);
Router::add('^group/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'group', 'action' => 'view']);
Router::add('^article/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'article', 'action' => 'view']);

Router::add('^vendors/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'vendors', 'action' => 'view']);

Router::add('^xml-load$', ['controller' => 'xml', 'action' => 'add']);
Router::add('^xml-create$', ['controller' => 'xml', 'action' => 'createXml']);

for ($i = 1; $i <= 16; $i++) {
	Router::add("^feed{$i}$", ['controller' => 'yaml', 'action' => "feed{$i}"]);
}


/*
|--------------------------------------------------------------------------
| ADMIN NAVIGATION ROUTES
|--------------------------------------------------------------------------
|
| Три меню:
| - navigation         → top
| - navigation_footer  → bottom
| - navigation_mobile  → mobile
|
| Все используют один NavigationController.
|
*/

// ===== TOP MENU =====
Router::add('^admin/navigation$', [
	'controller' => 'Navigation',
	'action'     => 'index',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation',
]);

Router::add('^admin/navigation/add$', [
	'controller' => 'Navigation',
	'action'     => 'add',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation',
]);

Router::add('^admin/navigation/edit/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'edit',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation',
]);

Router::add('^admin/navigation/delete/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'delete',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation',
]);

// ===== FOOTER MENU =====
Router::add('^admin/navigation_footer$', [
	'controller' => 'Navigation',
	'action'     => 'index',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_footer',
]);

Router::add('^admin/navigation_footer/add$', [
	'controller' => 'Navigation',
	'action'     => 'add',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_footer',
]);

Router::add('^admin/navigation_footer/edit/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'edit',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_footer',
]);

Router::add('^admin/navigation_footer/delete/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'delete',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_footer',
]);

// ===== MOBILE MENU =====
Router::add('^admin/navigation_mobile$', [
	'controller' => 'Navigation',
	'action'     => 'index',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_mobile',
]);

Router::add('^admin/navigation_mobile/add$', [
	'controller' => 'Navigation',
	'action'     => 'add',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_mobile',
]);

Router::add('^admin/navigation_mobile/edit/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'edit',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_mobile',
]);

Router::add('^admin/navigation_mobile/delete/(?P<id>\d+)$', [
	'controller' => 'Navigation',
	'action'     => 'delete',
	'prefix'     => 'admin',
	'ctrl_alias' => 'navigation_mobile',
]);


/*
|--------------------------------------------------------------------------
| DEFAULT ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Router::add('^admin$', [
	'controller' => 'main',
	'action'     => 'index',
	'prefix'     => 'admin'
]);

Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', [
	'prefix' => 'admin'
]);


/*
|--------------------------------------------------------------------------
| DEFAULT FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Router::add('^$', ['controller' => 'main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');