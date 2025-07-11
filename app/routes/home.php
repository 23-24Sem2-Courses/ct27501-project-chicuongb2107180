<?php

$router->get(
	'/',
	'App\Controllers\HomeController@index'
);

$router->get(
	'/home',
	'App\Controllers\HomeController@index'
);
$router->get(
	'/home/category/(\d+)',
	'App\Controllers\HomeController@category'
);
$router->get(
	'/home/product/(\d+)',
	'App\Controllers\HomeController@viewItem'
);
$router->get(
	'/search',
	'App\Controllers\HomeController@search'
);
$router->post(
	'/get-item',
	'App\Controllers\HomeController@getItem'
);
