<?php

use ishop\Router;

Router::add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
Router::add('^page/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^group/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Group', 'action' => 'view']);
Router::add('^article/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Article', 'action' => 'view']);

Router::add('^vendors/check$', ['controller' => 'Vendors', 'action'     => 'check']);
Router::add('^vendors/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Vendors', 'action' => 'view']);

Router::add('^xml-load$', ['controller' => 'Xml', 'action' => 'add']);
Router::add('^xml-create$', ['controller' => 'Xml', 'action' => 'createXml']);

Router::add('^feed1$', ['controller' => 'Yaml', 'action' => 'feed1']);
Router::add('^feed2$', ['controller' => 'Yaml', 'action' => 'feed2']);
Router::add('^feed3$', ['controller' => 'Yaml', 'action' => 'feed3']);
Router::add('^feed4$', ['controller' => 'Yaml', 'action' => 'feed4']);
Router::add('^feed5$', ['controller' => 'Yaml', 'action' => 'feed5']);
Router::add('^feed6$', ['controller' => 'Yaml', 'action' => 'feed6']);
Router::add('^feed7$', ['controller' => 'Yaml', 'action' => 'feed7']);
Router::add('^feed8$', ['controller' => 'Yaml', 'action' => 'feed8']);
Router::add('^feed9$', ['controller' => 'Yaml', 'action' => 'feed9']);
Router::add('^feed10$', ['controller' => 'Yaml', 'action' => 'feed10']);
Router::add('^feed11$', ['controller' => 'Yaml', 'action' => 'feed11']);
Router::add('^feed12$', ['controller' => 'Yaml', 'action' => 'feed12']);
Router::add('^feed13$', ['controller' => 'Yaml', 'action' => 'feed13']);
Router::add('^feed14$', ['controller' => 'Yaml', 'action' => 'feed14']);
Router::add('^feed15$', ['controller' => 'Yaml', 'action' => 'feed15']);
Router::add('^feed16$', ['controller' => 'Yaml', 'action' => 'feed16']);
Router::add('^feed17$', ['controller' => 'Yaml', 'action' => 'feed17']);

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


// default routes
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');