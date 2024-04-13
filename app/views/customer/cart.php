<?php require_once __DIR__ . '/../partials/header.php' ?>
<?php

use App\utils\Helper;
?>

<div class="main row" style="width:100%">
    <div class="sidebar col-md-2" style="margin:8px 0px 0px 0px">
        <!--danh mục sản phẩm-->
        <div class="category p-2 me-2 shadow rounded-2 bg-white">
            <div class="text-center"><strong> Sản phẩm</strong></div>
            <ul>
                <?php foreach ($categories as $category) : ?>
                    <li><a href="/home/category/<?php echo Helper::htmlEscape($category['category_id']) ?>"><span><?php echo Helper::htmlEscape($category['category_name']) ?></span></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>

    <div class="col-md-10" style="padding:0px">
        <div class="p-3 mt-2 mx-0 bg-white">
            <div class=" p-2 me-2 shadow rounded-2 bg-white">
                <h5><strong>Giỏ hàng của tôi</strong></h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $index => $item) :
                            $product = $item['product'];
                        ?>
                            <tr>
                                <td><img src="/uploads/<?php echo $product->getFirstImage() ?>" alt="" style="width: 100px"></td>
                                <td style="width:340px"><?php echo Helper::htmlEscape($product->getName()) ?></td>
                                <td><?php echo Helper::htmlEscape($product->getPrice()) ?> đ</td>
                                <td><input type="number" name="quantity" id="quantity" value="<?= Helper::htmlEscape($item['quantity']) ?>" style="width:50px" min=1></td>
                                <td><span class="total"><?php echo $product->getPrice() * $item['quantity'] ?></span> đ</td>
                                <td>
                                    <form action="/cart/remove" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
                                        <button type="submit" class="btn btn-danger mt-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="/checkout" class="btn bg-color-primary p-2">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__ . '/../partials/footer.php' ?>
<script src="/js/cart.js"></script>