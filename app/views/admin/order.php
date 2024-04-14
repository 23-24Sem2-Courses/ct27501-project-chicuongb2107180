<?php require_once __DIR__ . '/partials/header.php';

use App\utils\Helper;

?>
<div class="bg-white col-md-12 shadow mt-3 mb-1">
    <h1 class="text-center">Quản lý đơn hàng</h1>
    <div class="row">
        <div class="col-md-6 p-3">

            <form action="/admin/order" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="-2" <?php if ($status == -2) echo 'selected' ?>>Tất cả</option>
                            <option value="0" <?php if ($status == 0) echo 'selected' ?>>Đang chờ xử lý</option>
                            <option value="1" <?php if ($status == 1) echo 'selected' ?>>Đã xác nhận</option>
                            <option value="-1" <?php if ($status == -1) echo 'selected' ?>>Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn bg-color-primary">Lọc</button>
                    </div>
                </div>
            </form>

        </div>
        <ul>
            <?php foreach ($orders as $order) : ?>
                <li>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <b>#Mã đơn hàng: <?= $order->getId() ?></b>

                                <?php if ($order->getStatus() == 0) : ?>
                                    <form action="/admin/order/approve" method="post">
                                        <input type="hidden" name="order_id" value="<?= $order->getId() ?>">
                                        <button type="submit" class="btn btn-success">Duyệt đơn</button>
                                    </form>
                                <?php else : ?>
                                    <button class="btn btn-success" disabled>Duyệt đơn</button>
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
    <div class="d-flex justify-content-center" style="margin: 10px;">
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                <a role="button" href="/admin/order?page=<?= $paginator->getPrevPage() ?>&limit=5" class="page-link">
                    <span>&laquo;</span>
                </a>
            </li>
            <?php foreach ($pages as $page) : ?>
                <li class="page-item <?= $paginator->getCurrPage() === $page ? 'active' : '' ?>">
                    <a role="button" href="/admin/order?page=<?= $page ?>&limit=5" class="page-link"><?= $page ?></a>
                </li>
            <?php endforeach ?>

            <li class="page-item<?= $paginator->getNextPage() ? '' : ' disabled' ?>">
                <a role="button" class="page-link" href="/admin/order?page=<?= $paginator->getNextPage() ?>&limit=5">
                    <span>&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
    <?php require_once __DIR__ . '/partials/footer.php'; ?>