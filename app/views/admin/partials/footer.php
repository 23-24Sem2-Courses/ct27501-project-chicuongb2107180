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

<div class="footer rounded-bottom text-center mt-1">
    @coppyright 2023-2024 shoe store
</div>


</div>
</div>

</body>

</html>