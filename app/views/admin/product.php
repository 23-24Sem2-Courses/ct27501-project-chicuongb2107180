<?php require_once __DIR__ . '/partials/header.php';

use App\utils\Helper;

?>
<div class="bg-white shadow mt-3" style="min-height: 460px; border-radius: 3px;">
    <h1 class="text-center">Quản lý sản phẩm</h1>
    <!--tìm sản phẩm theo tên-->
    <div class="row">
        <div class="col-md-6">
            <form action="/admin/product" method="get" class="d-flex justify-content-start">
                <div style="padding-right: 3px;">
                    <input type="text" name="search" class="form-control" style="width:300px" placeholder="Tìm kiếm sản phẩm">
                </div>
                <button type="submit" class="btn bg-color-primary">Tìm kiếm</button>
            </form>
        </div>
        <!--thêm sản phẩm-->
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="/admin/product/create" class="btn bg-color-primary">Thêm sản phẩm</a>
            </div>
        </div>
    </div>
    <table class="table table-striped" style="font-size:13px">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $key => $product) : ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo Helper::htmlEscape($product->getName()) ?></td>
                    <td><?php echo Helper::htmlEscape($product->getPrice()) ?></td>
                    <td>
                        <img src="/uploads/<?php echo Helper::htmlEscape($product->getFirstImage()) ?>" style="width: 70px">
                    </td>
                    <td class="text-xs">
                        <form action="/admin/product/edit" method="get" class="d-inline">
                            <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
                            <button type="submit" class="btn  bg-color-primary"><i class="fa fa-edit"></i></button>
                        </form>

                        <form action="/admin/product/delete" method="post" class="d-inline">
                            <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
                            <button type="submit" class="btn bg-color-primary mt-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center" style="margin: 10px;">
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                <a role="button" href="/admin/product?page=<?= $paginator->getPrevPage() ?>&limit=8" class="page-link">
                    <span>&laquo;</span>
                </a>
            </li>
            <?php foreach ($pages as $page) : ?>
                <li class="page-item <?= $paginator->getCurrPage() === $page ? 'active' : '' ?>">
                    <a role="button" href="/admin/product?page=<?= $page ?>&limit=8" class="page-link"><?= $page ?></a>
                </li>
            <?php endforeach ?>

            <li class="page-item<?= $paginator->getNextPage() ? '' : ' disabled' ?>">
                <a role="button" class="page-link" href="/admin/product?page=<?= $paginator->getNextPage() ?>&limit=8">
                    <span>&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>