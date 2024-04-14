<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 10">
    <div id="toast-message" class="toast <?php
        use App\utils\Helper;
        echo (Helper::getFromSession('status')) ? 'show' : '';
        $textClass = "text-" . Helper::getOnceFromSession('status');
    ?>" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto <?= $textClass ?>">
                <?php
                if ($textClass == "text-danger") {
                    echo "Thất bại";
                } elseif ($textClass == "text-success") {
                    echo "Thành công";
                } elseif ($textClass == "text-warning") {
                    echo "Cảnh báo";
                } elseif ($textClass == "text-info") {
                    echo "Thông báo";
                }
                ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body <?= $textClass ?>">
            <?= Helper::getOnceFromSession('message') ?>
        </div>
    </div>
</div>



<script src="/js/toast.js"></script>



<footer>
    <div class="row align-item-center footer rounded-bottom">
      <div class="col-md-3  text-start">
        <span>Số điện thoại : 05940349303</span>
      </div>
      <div class="col-md-5 text-end">
        <span>Địa chỉ : 123 đường 3/2 Email: cuongb2107180.com.vn</span>
      </div>
      <div class="col-md-4 text-end">
        <a href="https://www.facebook.com/cuongb2107"><i class="fa-brands fa-facebook fa-xl"></i></a>
        <a href="#"><i class="fa-brands fa-x-twitter fa-xl"></i></a>
        <a href="#"><i class="fa-brands fa-instagram fa-xl"></i></a>

      </div>


  </footer>

  </div>

</body>


</html>