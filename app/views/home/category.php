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
                    <li><a href="/home/category/<?php echo Helper::htmlEscape($category['category_id']) ?> 
                    " <?php if ($category_id == $category['category_id']) : ?> class="active" <?php endif ?>>
                            <span><?php echo Helper::htmlEscape($category['category_name']) ?></span>
                        </a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="col-md-10" style="padding:0px">


        <div class="p-3 mt-2 mx-0 bg-white">
            <div class=" p-2 me-2 shadow rounded-2 bg-white">
                <h5><strong>Tất cả sản phẩm</strong></h5>
                <!-- tạo nút lọc theo giá tăng hoặc giảm-->
                <form action="/home/category/<?php echo Helper::htmlEscape($category_id) ?>" method="get">
                    <div class="d-flex justify-content-end">
                        <select name="sort" class="form-select w-25" aria-label="Default select example">
                            <option value="0" selected>Sắp xếp theo giá</option>
                            <option value="1">Giá tăng dần</option>
                            <option value="-1">Giá giảm dần</option>
                        </select>
                        <span style="padding-left: 6px;"><button type="submit" class="btn bg-color-primary">Lọc</button></span>
                    </div>
                </form>


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

        <!--pagination-->
        <div class="d-flex justify-content-center" style="margin: 10px;">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>




<?php require_once __DIR__ . '/../partials/footer.php' ?>