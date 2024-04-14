<?php require_once __DIR__ . '/../partials/header.php' ?>
<?php

use App\utils\Helper;
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-center" style="min-height:100%">
                <div class="bg-white shadow mx-5" style="min-width:900px;min-height:100%;border-radius:solid 3px; padding: 50px">
                    <h1 class="text-center">Thông tin tài khoản</h1>
                    <div class="bg-white shadow mx-5">
                        <h5>Thông tin cá nhân</h5>
                        <div class="row">
                            <form action="/profile/update" method="post" class="mt-3 p-3">
                                <div class="row mb-5">
                                    <label for="customer_name" class="col-sm-3 col-form-label fw-bold">Họ tên: </label>
                                    <div class="col-sm-7">
                                        <input name="customer_name" type="text" id="customer_name" class="form-control" value="<?= Helper::htmlEscape($customer->getName()) ?>">
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <label for="username" class="col-sm-3 col-form-label fw-bold">Tên đăng nhập: </label>
                                    <div class="col-sm-7">
                                        <input name="username" type="text" id="username" class="form-control" value="<?= Helper::htmlEscape($customer->getusername()) ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="customer_address" class="col-sm-3 col-form-label fw-bold">Địa chỉ: </label>
                                    <div class="col-sm-7">
                                        <input name="customer_address" type="text" id="customer_address" class="form-control" value="<?= Helper::htmlEscape($customer->getAddress()) ?>">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="customer_phone" class="col-sm-3 col-form-label fw-bold">Số điện thoại: </label>
                                    <div class="col-sm-7">
                                        <input name="customer_phone" type="text" id="customer_phone" class="form-control" value="<?= Helper::htmlEscape($customer->getPhone()) ?>">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="customer_email" class="col-sm-3 col-form-label fw-bold">Email: </label>
                                    <div class="col-sm-7">
                                        <input name="customer_email" type="email" id="customer_email" class="form-control" value="<?= Helper::htmlEscape($customer->getEmail()) ?>">
                                    </div>
                                </div>
                                <fieldset class="row mb-5">
                                    <legend class="col-form-label col-sm-3 pt-0 fw-bold">Giới tính: </legend>
                                    <div class="col-sm-7 row m-0">
                                        <div class="form-check col-md-2">
                                            <input class="form-check-input" id="1" type="radio" name="customer_gender" value="1" <?php
                                                                                                                                    if ($customer->getGender() == 1)
                                                                                                                                        echo "checked";
                                                                                                                                    ?>>
                                            <label class="form-check-label" for="1">Nam</label>
                                        </div>
                                        <div class="form-check col-md-2">
                                            <input class="form-check-input" id="-1" type="radio" name="customer_gender" value="-1" <?php
                                                                                                                                    if ($customer->getGender() == -1)
                                                                                                                                        echo "checked";
                                                                                                                                    ?>>
                                            <label class="form-check-label" for="-1">Nữ</label>
                                        </div>
                                        <div class="form-check col-md-2">
                                            <input class="form-check-input" id="0" type="radio" name="customer_gender" value="0" <?php
                                                                                                                                    if ($customer->getGender() == 0)
                                                                                                                                        echo "checked";
                                                                                                                                    ?>>
                                            <label class="form-check-label" for="0">Khác</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="text-center">
                                    <button type="submit" class="px-4 border-0 fw-bold">Cập nhật</button>
                                </div>
                            </form>
                            <!-- form đổi mật khẩu-->
                            <form action="/profile/change-password" method="post" class="mt-3 p-3" id="changePassword">
                                <h5>Đổi mật khẩu</h5>
                                <div class="row mb-5">
                                    <label for="old_password" class="col-sm-3 col-form-label fw-bold">Mật khẩu cũ: </label>
                                    <div class="col-sm-7">
                                        <input name="old_password" type="password" id="old_password" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="new_password" class="col-sm-3 col-form-label fw-bold">Mật khẩu mới: </label>
                                    <div class="col-sm-7">
                                        <input name="new_password" type="password" id="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="confirm_password" class="col-sm-3 col-form-label fw-bold">Nhập lại mật khẩu: </label>
                                    <div class="col-sm-7">
                                        <input name="confirm_password" type="password" id="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="px-4 border-0 fw-bold">Đổi mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script src="/js/profile.js"></script>

        <?php require_once __DIR__ . '/../partials/footer.php' ?>