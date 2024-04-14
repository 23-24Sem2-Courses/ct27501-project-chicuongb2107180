<?php

use App\utils\Helper;

require_once __DIR__ . '/../partials/header.php' ?>
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

    <!--new product-->
    <div class="p-3 mt-2 mx-0 bg-white">
      <div class=" p-2 me-2 shadow rounded-2 bg-white">
        <h5><strong>Sản phẩm mới nhất</strong></h5>
        <div class="m-4">
          <div class="row justify-content-around rounded-3 py-4" style="background-color:darkgrey">

            <?php foreach ($newest_Products as $newest_Product) : ?>
              <div class="col-md-3 p-0 shadow-lg">
                <div class="card">
                  <a href="/home/product/<?php echo Helper::htmlEscape($newest_Product->getId()) ?>">
                    <div class="card-imd-top">
                      <img src="uploads/<?php echo Helper::htmlEscape($newest_Product->getFirstImage()) ?>" class="w-100">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title
                    overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><b><?php echo Helper::htmlEscape($newest_Product->getName()) ?></b></h5>
                  </a>
                  <div class="d-flex justify-content-between">
                    <span class="card-text card-text__price">Giá: <?php echo Helper::htmlEscape($newest_Product->getPrice()) ?>đ</span>
                    <span class="card-text card-text__sold">Đã bán: <?php echo $newest_Product->getSoldQuantity() ?></span>
                  </div>

                  <div class="d-flex justify-content-center">
                    <form action="/cart/add" method="post">
                      <input type="hidden" name="product_id" value="<?php echo $newest_Product->getId() ?>">
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

    <div class="p-3 mt-2 mx-0 bg-white"></div>
    <div class=" p-2 me-2 shadow rounded-2 bg-white">
      <h5><strong>Tất cả sản phẩm</strong></h5>
      <div class="m-4">
        <div class="row">
          <?php foreach ($Products as $Product) : ?>
            <div class="col-md-3 p-0 shadow-lg">
              <div class="card" style="border-radius:10px; margin:1px">
                <a href="/home/product/<?php echo Helper::htmlEscape($Product->getId()) ?>">
                  <div class="card-imd-top">
                    <img src="uploads/<?php echo Helper::htmlEscape($Product->getFirstImage()) ?>" class="w-100">
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
    <nav class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
          <a role="button" href="/?page=<?= $paginator->getPrevPage() ?>&limit=8" class="page-link">
            <span>&laquo;</span>
          </a>
        </li>
        <?php foreach ($pages as $page) : ?>
          <li class="page-item <?= $paginator->getCurrPage() === $page ? 'active' : '' ?>">
            <a role="button" href="/?page=<?= $page ?>&limit=8" class="page-link"><?= $page ?></a>
          </li>
        <?php endforeach ?>

        <li class="page-item<?= $paginator->getNextPage() ? '' : ' disabled' ?>">
          <a role="button" class="page-link" href="/?page=<?= $paginator->getNextPage() ?>&limit=8">
            <span>&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
</div>


<?php require_once __DIR__ . '/../partials/footer.php' ?>