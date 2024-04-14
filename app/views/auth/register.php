<?php require_once __DIR__ . '/../partials/header.php';
use App\utils\Helper;
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-center align-items-center" style="min-height:100%">
                <div class="bg-white shadow mx-5" style="min-width:600px;min-height:100%;border-radius:solid 3px; padding: 50px">
                <p class="text-danger text-center bg-light bg-gradient"><?=Helper::getOnceFromSession('errors')?></p>

                    <h1 class="text-center">Đăng ký</h1>
                    <form action="/register/submit" method="post" id="signupForm">
                        <div class="form-group">
                            <label for="customer_name">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" value="<?= $customer_name ?? '' ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Email <span class="text-danger">*</span> </label>
                            <input type="email" name="customer_email" id="customer_id" class="form-control" value="<?= $customer_id ?? '' ?>">
                          
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="<?= $customer_phone ?? '' ?>">
                          
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Địa chỉ <span class="text-danger">*</span></label>
                            <input type="text" name="customer_address" id="customer_address" class="form-control" value="<?= $customer_address ?? '' ?>">
                          
                        </div>

                        <div class="form-group">
                            <label for="username">Tên đăng nhập <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="user" class="form-control" value="<?= $username ?? '' ?>">
                        

                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control">
                            
                        </div>
                        <div class="form-group
                    ">
                            <label for="confirm_password">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                          
                        </div>
                        <div class="form-group pt-3">
                            <select name="customer_gender" id="customer_gender" class="form-select w-25" aria-label="Default select example">
                                <option value="0" selected>Giới tính</option>
                                <option value="1">nam</option>
                                <option value="-1">nữ</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-3">

                            <button type="submit" class="btn bg-color-primary">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/register.js"></script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>

