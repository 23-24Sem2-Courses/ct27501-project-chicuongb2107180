<?php require_once __DIR__ . '/partials/header.php';

use App\utils\Helper;

?>
<div class="bg-white shadow mt-3" style="min-height: 460px; border-radius: 3px;">
    <h1 class="text-center">Quản lý sản phẩm</h1>
    <div class="d-flex justify-content-end">
        <a href="/admin/product/create" class="btn bg-color-primary">Thêm sản phẩm</a>
    </div>
    <table class="table table-striped">
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
                        <img src="/uploads/<?php echo Helper::htmlEscape($product->getFirstImage()) ?>" style="width: 100px">
                    </td>
                    <td class="text-xs">
                            <form action="/admin/product/edit" method="get" class="d-inline">
                                <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                </form>
                        
                            <form action="/admin/product/delete" method="post" class="d-inline" >
                                <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
                                <button type="submit" class="btn btn-danger mt-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>