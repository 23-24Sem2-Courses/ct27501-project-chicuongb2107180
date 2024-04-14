<?php require_once __DIR__ . '/../partials/header.php';

use App\utils\Helper;
?>
<div class="col-md-6 offset-md-3 mt-1">
    <div class="d-flex justify-content-center align-items-center" style="min-height:100%">

        <div class="bg-white shadow mt-3" style="min-width:600px;min-height: 460px;;border-radius:solid 3px; padding: 50px">
            <h1 class="text-center">Thêm sản phẩm</h1>
            <form action="/admin/product/store" method="post" enctype="multipart/form-data" id="formproduct">
                <input type="hidden" name="product_id" id="product_id" value="<?=isset($product) ? $product->getId() : -1;?>">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?=isset($product) ? $product->getName() : "";?>">
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Giá</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" value="<?=isset($product) ? $product->getPrice() : "";?>">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id"  aria-label="Default select example">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['category_id'] ?>"> <?php echo Helper::htmlEscape($category['category_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="product_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="product_description" name="product_description" ><?=isset($product) ? $product->getDescription():""?></textarea>
                </div>
                <div class="mb-3">
                    <label for="product_images" class="form-label">Hình ảnh minh họa</label>
                    <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
                    <div class="show-images mt-2"></div>
                </div>

                <button type="submit" class="btn bg-color-primary">Thêm</button>
            </form>
        </div>
    </div>
</div>

<script src="/js/addproduct.js"></script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>