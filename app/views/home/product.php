<?php

use App\utils\Helper;

require_once __DIR__ . '/../partials/header.php' ?>
<div class="main row" style="width:100%">
    <div class="sidebar col-md-2" style="margin:8px 0px 0px 0px">
        <!--danh mục sản phẩm-->
        <div class="category p-2 me-2 shadow rounded-2 bg-white">
        <h4 class="text-center text-secondary"><strong> Sản phẩm</strong></h2>
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
                <div class="row">
                    <div class="col-md-7">
                        <div class="p-2 me-2 shadow rounded-2 bg-white">

                            <div class="show-image" style="width: 400px">
                                <img src="/uploads/<?php echo Helper::htmlEscape($Product->getFirstImage()) ?>" style="width:100%">
                            </div>
                            <p> <b>Danh sách hình ảnh sản phẩm</b></p>
                            <div class="d-flex justify-content-start mt-1" style="width: 450px">
                                <?php foreach ($Product->getImagesArray() as $image) : ?>
                                    <div class="image-item shadow-lg mr-2" style="width: 100px; height: 100px; border-radius: 5px; cursor: pointer;">
                                        <img src="/uploads/<?php echo Helper::htmlEscape($image) ?>" style="width:100%; height:100%">
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="p-2 me-2 shadow rounded-2 bg-white">
                            <p><b>Mô tả sản phẩm</b></p>
                            <p style="text-align: justify"><?php echo Helper::htmlEscape($Product->getDescription()) ?></p>

                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="p-2 me-2 shadow rounded-2 bg-white">
                            <p><strong><?php echo Helper::htmlEscape($Product->getName()) ?></strong></p>
                            <p class="card-text card-text__price">Giá: <?php echo Helper::htmlEscape($Product->getPrice()) ?>đ</p>
                            <form action="/cart/add" method="post">
                            <div class="form-group">
                                <label for="quantity">Số lượng</label>
                                <input type="number" name="quantity" id="quantity" class="form-control w-25" value="1" min="1">
                            </div>
                            <p>Tổng tạm thời: <strong id="tong_tmp"><?php echo Helper::htmlEscape($Product->getPrice()) ?></strong> Đ</p>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="product_id" value="<?php echo $Product->getId() ?>">
                                <button type="submit" class="btn bg-color-primary">Thêm vào giỏ hàng</button>
                              </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    const price = <?php echo $Product->getPrice() ?>;
    var quantity = document.getElementById('quantity').value;
    const product_id = <?php echo $Product->getId() ?>;
</script>


<script src="/js/product.js"></script>

<?php require_once __DIR__ . '/../partials/footer.php' ?>