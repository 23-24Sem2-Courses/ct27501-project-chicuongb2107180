<?php require_once __DIR__ . '/../partials/header.php' ?>
<?php

use App\utils\Helper;
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-center" style="min-height:100%">
                <div class="bg-white shadow mx-5" style="min-width:600px;min-height:100%;border-radius:solid 3px; padding: 50px">

                    <h1 class="text-center">Hóa đơn</h1>
                    <p><b>Thông tin khách hàng</b></p>
                    Họ và tên: <?= $customer->getName() ?><br>
                    Email: <?= $customer->getEmail() ?><br>
                    Số điện thoại: <?= $customer->getPhone() ?><br>
                    Địa chỉ: <?= $customer->getAddress() ?><br>
                    <p></p>
                    <p><b>Thông tin đơn hàng</b></p>
                    <table class="table" style="font-size: 11px;">
                        <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $index => $item) :
                                $product = $item['product'];
                            ?>
                                <tr>
                                    <td style="text-transform: lowercase;width:250px;"><?= Helper::htmlEscape($product->getName()) ?></td>
                                    <td><?= Helper::htmlEscape($item['quantity']) ?></td>
                                    <td><?= Helper::htmlEscape($product->getPrice()) ?> đ</td>
                                    <td><?= $product->getPrice() * $item['quantity'] ?> đ</td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="3">Tổng cộng</td>
                                <td><?= $total ?> đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Phương thức thanh toán</b>: Thanh toán khi nhận hàng</p>
                    <form action="/order/add" class="text-end" method="post">
                        <input type="hidden" name="customer_id" value="<?= $customer->getId() ?>">
                        <input type="hidden" name="total" value="<?= $total ?>">
                        <?php foreach ($cart as $index => $item) :
                         $product = $item['product'];
                        ?>
                            <input type="hidden" name="product_id[]" value="<?= $product->getId() ?>">
                            <input type="hidden" name="quantity[]" value="<?= $item['quantity'] ?>">
                        <?php endforeach ?>
                        <input type="submit" class="btn btn-success" value="Thanh toán">
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__ . '/../partials/footer.php' ?>
