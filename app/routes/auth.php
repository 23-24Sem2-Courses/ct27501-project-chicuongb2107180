<?php

$router->get(
    '/login',
    'App\Controllers\AuthController@createlogin'
);

$router->post(
    '/login/submit',
    'App\Controllers\AuthController@login'
);

$router->get(
    '/register',
    'App\Controllers\AuthController@createregister'
);
$router->post(
    '/register/submit',
    'App\Controllers\AuthController@register'
);
$router->get(
    '/logout',
    'App\Controllers\AuthController@logout'
);


