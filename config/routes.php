<?php

use ishop\Router;

Router::add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
Router::add('^page/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^group/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Group', 'action' => 'view']);
Router::add('^article/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Article', 'action' => 'view']);

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

// default routes
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');