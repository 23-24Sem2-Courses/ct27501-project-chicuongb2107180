<?php require_once __DIR__ . '/../../partials/head.php'; 
use App\utils\Helper;
$prefix = Helper::getPrefixUrl();
?>


<body>
    <div class="container ap">
            <div class="row align-item-center header rounded-bottom">
                <div class="col-md-6 text-center d-flex align-items-center justify-content-center logo-shop">
                    <a href="/admin" class="d-block d-flex align-items-center">
                    <img src="/uploads/OIG3-removebg-preview.png" alt="" style="width:65px">
                        <h5>HỆ THỐNG QUẢN LÝ CỬA HÀNG SEEKSNEAKER</h5>
                    </a>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <nav>
                        <ul class="list-unstyled d-flex m-0">
                            <li class="me-3">
                                <a href="/admin/product" class="text-decoration-none <?=$prefix=='/admin/product'?'fw-bold':''?>">Quản lý sản phẩm</a>
                            </li>
                            <li class="me-3">
                                <a href="/admin/order" class="text-decoration-none  <?=$prefix=='/admin/order'?'fw-bold':''?>">Quản lý đơn hàng</a>
                            </li>
                            <li class="me-3">
                                <a href="/logout" class="text-decoration-none">Đăng xuất</a>
                            </li>
                        </ul>
                    </nav>
                    
            </div>
