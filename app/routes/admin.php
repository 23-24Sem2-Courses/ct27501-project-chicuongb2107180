<?php
## Sản phẩm
$router->get(
    '/admin',
    'App\Controllers\AdminController@product'
);
$router->get(
    '/admin/product',
    'App\Controllers\AdminController@product'
);
$router->get(
    '/admin/product/create',
    'App\Controllers\AdminController@createProduct'
);
$router->post(
    '/admin/product/store',
    'App\Controllers\AdminController@storeProduct'
);
$router->get(
    '/admin/product/edit',
    'App\Controllers\AdminController@editProduct'
);

$router->post(
    '/admin/product/delete',
    'App\Controllers\AdminController@deleteProduct'
);

##Đơn hàng
$router->get(
    '/admin/order',
    'App\Controllers\AdminController@order'
);
$router->post(
    '/admin/order/approve',
    'App\Controllers\AdminController@approveOrder'
);
$router->post(
    '/admin/order/delete/(\d+)',
    'App\Controllers\AdminController@deleteOrder'
);

