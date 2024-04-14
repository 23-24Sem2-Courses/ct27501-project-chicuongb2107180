<?php require_once __DIR__ . '/head.php'; ?>
<?php

use App\utils\Helper;
?>

<body>
  <div class="container ap">
    <header>
      <div class="row align-item-center header rounded-bottom">
        <div class="col-md-2 text-center d-flex align-items-center justify-content-center logo-shop">
          <a href="/home" class="d-block d-flex align-items-center">
           <img src="/uploads/OIG3-removebg-preview.png" alt="" style="width:65px">
          </a>
        </div>

        <div class="col-md-6 d-flex align-items-center">
          <div class="w-100">
            <form class="row bg-white rounded-2 position-relative" action="/search" method="get">
              <input name="search" id="search-input" class="col-md-10 py-2 px-3 border-0 border-end rounded-start" type="text" placeholder="Nhập sản phẩm tìm kiếm...">
              <button type="submit" class="col-md-2 btn btn-light border-0 search-btn">Tìm kiếm</button>
            </form>
          </div>
        </div>

        <div class="col-md-3 d-flex align-items-center justify-content-center">
          <?php if (isset($_SESSION['username'])) : ?>
            <div class="d-flex align-items-center justify-content-center w-100">
              <div class="d-flex align-items-center justify-content-center position-relative logined-account">
                <div class="p-1">
                 <div class="dropdown">
                  <span><?php echo Helper::htmlEscape($_SESSION['username']) ?></span>
               <i class="fa-solid fa-angle-down"></i>
               </div>
                  <div class="position-absolute rounded-2 bg-light p-2 account-dropdown" hidden style="width:150px">
                    <a class="d-block text-decoration-none text-dark" href="/profile">Tài khoản</a>
                    <a class="d-block text-decoration-none text-dark" href="/order">Đơn hàng của tôi</a>
                    <a class="d-block text-decoration-none text-dark" href="/logout">Đăng xuất</a>
                  </div>
                </div>
              </div>
            </div>
          <?php else : ?>
            <div class="row w-100 align-items-center justify-content-end account">
              <a id="sign-in" class="d-block col-md-4 m-0 pt-2 px-1 text-center text-decoration-none" href="/login">Đăng nhập</a>
              <a id="sign-up" class="d-block col-md-4 m-0 pt-2 px-1 text-center text-decoration-none" href="/register">Đăng ký</a>
            </div>
          <?php endif ?>
        </div>

        <div class="col-md-1 d-flex align-items-center justify-content-center">
          <div id="cart" class="px-3 rounded-2 position-relative">
            <a href="/cart">
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="position-absolute d-inline-block rounded-pill cart-count"></span>
            </a>
          </div>
        </div>
      </div>
    </header>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
          dropdown.addEventListener('click', function() {
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu.hidden) {
              dropdownMenu.hidden = false;
            } else {
              dropdownMenu.hidden = true;
            }
          });
        });
      });
    </script>