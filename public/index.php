<?php
require_once __DIR__ . '/../bootstrap.php';

$router = new \Bramus\Router\Router();

//$router->setNamespace('\App\Controllers');

require_once __DIR__ . '/../app/routes/home.php';

require_once __DIR__ . '/../app/routes/auth.php';


require_once __DIR__ . '/../app/routes/customer.php';

require_once __DIR__ . '/../app/routes/admin.php';

// require_once __DIR__ . '/../app/routes/carts.php';

// require_once __DIR__ . '/../app/routes/orders.php';

//require_once __DIR__ . '/../app/routes/product.php';

// require_once __DIR__ . '/../app/routes/manage_products.php';

// require_once __DIR__ . '/../app/routes/manage_orders.php';

// require_once __DIR__ . '/../ap/routes/error.php';

$router->run();
