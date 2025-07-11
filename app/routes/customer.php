<?php

$router->get(
    '/cart',
    'App\Controllers\CustomerController@cart'
);
$router->post(
    '/cart/add',
    'App\Controllers\CustomerController@addCart'
);
$router->post(
    '/cart/remove',
    'App\Controllers\CustomerController@deleteCart'
);

$router->get(
    '/checkout',
    'App\Controllers\CustomerController@checkout'
);
$router->post(
    '/order/add',
    'App\Controllers\CustomerController@addOrder'
);
$router->post(
    '/order/destroy',
    'App\Controllers\CustomerController@destroyOrder'
);
$router->get(
    '/profile',
    'App\Controllers\CustomerController@profile'
);
$router->post(
    '/profile/update',
    'App\Controllers\CustomerController@updateProfile'
);
$router->post(
    '/profile/change-password',
    'App\Controllers\CustomerController@changePassword'
);
$router->get(
    '/order',
    'App\Controllers\CustomerController@historyorder'
);
