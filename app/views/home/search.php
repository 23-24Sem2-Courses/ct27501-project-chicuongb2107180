<?php require_once __DIR__ . '/../partials/header.php' ?>
<?php

use App\utils\Helper;
?>
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
                <h5><strong>Sản phẩm chứa từ khóa "<?=$key?>"</strong></h5>

                <div class="m-4">
                    <div class="row">
                        <?php foreach ($Products as $Product) : ?>
                            <div class="col-md-3 p-0 shadow-lg">
                                <div class="card">
                                    <a href="/home/product/<?php echo Helper::htmlEscape($Product->getId()) ?>">
                                        <div class="card-imd-top">
                                            <img src="/uploads/<?php echo Helper::htmlEscape($Product->getFirstImage()) ?>" class="w-100">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><b><?php echo Helper::htmlEscape($Product->getName()) ?></b></h5>
                                    </a>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text card-text__price">Giá: <?php echo Helper::htmlEscape($Product->getPrice()) ?>đ</span>
                                        <span class="card-text card-text__sold">Đã bán: <?php echo $Product->getSoldQuantity() ?></span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <form action="/cart/add" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $Product->getId() ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn bg-color-primary">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endforeach ?>



                </div>
            </div>
        </div>

    </div>
</div>




<?php require_once __DIR__ . '/../partials/footer.php' ?>