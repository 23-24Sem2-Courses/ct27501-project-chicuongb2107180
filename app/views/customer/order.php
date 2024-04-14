<?php require_once __DIR__ . '/../partials/header.php' ?>
<?php

use App\utils\Helper;
?>

<div class="main row" style="width:100%">
    <div class="bg-white col-md-12 shadow mt-1 mb-1">
        <h1 class="text-center">Đơn hàng của tôi</h1>
        <ul>
            <?php foreach ($orders as $order) : ?>
                <li>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <b>#Mã đơn hàng: <?= $order->getId() ?></b>

                                <?php if ($order->getStatus() == 0) : ?>
                                    <form action="/order/destroy" method="post">
                                        <input type="hidden" name="order_id" value="<?= $order->getId() ?>">
                                        <button type="submit" class="btn btn-danger">Hủy đơn</button>
                                    </form>
                                <?php else : ?>
                                    <button class="btn btn-danger" disabled>Hủy</button>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">

                                <p><b>Ngày đặt hàng: <?= Helper::formatDate($order->getOrderDate()) ?></b></p>
                                <p><b>Trạng thái:
                                        <?php if ($order->getStatus() == 0) : ?>
                                            <span class="text-warning">Đang chờ xử lý</span>
                                        <?php elseif ($order->getStatus() == 1) : ?>
                                            <span class="text-success">Đã xác nhận</span>
                                        <?php elseif ($order->getStatus() == -1) : ?>
                                            <span class="text-danger">Đã hủy</span>
                                        <?php endif ?>
                                    </b>
                                </p>
                            </div>


                            </p>
                            <table class="table" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order->getOrderDetails() as $orderDetail) :
                                        $product = $orderDetail->getProduct();
                                    ?>
                                        <tr>
                                            <td style="width:70px"><img src="/uploads/<?php echo $product->getFirstImage() ?>" alt="" style="width: 50px"></td>
                                            <td style="width:500px;text-transform: lowercase;"><?php echo Helper::htmlEscape($product->getName()) ?></td>
                                            <td><?php echo Helper::htmlEscape($product->getPrice()) ?> đ</td>
                                            <td><?= Helper::htmlEscape($orderDetail->getQuantity()) ?></td>
                                            <td><?= $product->getPrice() * $orderDetail->getQuantity() ?> đ</td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="4"><b>Tổng cộng:</b></td>
                                        <td><?= $order->getTotal() ?> đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>

    </div>

    <?php require_once __DIR__ . '/../partials/footer.php' ?>