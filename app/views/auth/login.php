

<?php require_once __DIR__ . '/../partials/header.php';
use App\utils\Helper;
?>

<div class="container">
    <div class="row" style="min-height:460px">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-center align-items-center" style="min-height:100%">
                <div class="bg-white shadow" style="min-width:600px;min-height:100%;border-radius:solid 3px; padding: 50px">
                <p class="text-danger text-center bg-light bg-gradient"><?=Helper::getOnceFromSession('errors')?></p>

                    <h1 class="text-center">Đăng nhập</h1>
                    <form action="/login/submit" method="post">
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="username" name="username" id="username" class="form-control" value="<?= $data['username'] ?? ''?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div style="padding-top: 3px;" class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn bg-color-primary">Đăng nhập</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../partials/footer.php' ?>