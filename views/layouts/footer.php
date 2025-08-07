<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-left">
        <div class="row text-md-left">


            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Twit Store</h5>
                <p>Chuyên cung cấp sản phẩm chất lượng với giá cả hợp lý. Mang đến trải nghiệm mua sắm tuyệt vời cho mọi khách hàng.</p>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Liên hệ</h5>
                <p><i class="fas fa-home me-3"></i> Số 3 Ngõ 479 Hoàng Quốc Việt, Hà Nội</p>
                <p><i class="fas fa-envelope me-3"></i> vtu8531@gmail.com</p>
                <p><i class="fas fa-phone me-3"></i> 0353802738</p>
                <p><i class="fas fa-clock me-3"></i> Làm việc: T2 - CN (8:00 - 21:00)</p>
            </div>


            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Liên kết</h5>
                <p><a href="index.php" class="text-white text-decoration-none"> Trang chủ</a></p>
                <p><a href="index.php?controller=product&action=index" class="text-white text-decoration-none"> Sản phẩm</a></p>
                <p><a href="index.php?controller=cart&action=index" class="text-white text-decoration-none"> Giỏ hàng</a></p>
                <p><a href="index.php?controller=auth&action=login" class="text-white text-decoration-none"> Đăng nhập</a></p>
            </div>

        </div>

        <hr class="mb-4" style="border-top: 1px solid rgba(255,255,255,0.1);" />

        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <p class="text-white mb-0"><strong class="text-warning">Cảm ơn vì đã ghé</strong>. Thank for visit.</p>
            </div>
            <div class="col-md-4 col-lg-4 text-md-end">
                <p class="mb-0">Designed with 💙 by <strong><a href="https://tudev-2507.github.io/smart-card-by-tuw">Dev Tuw</a></strong></p>
            </div>
        </div>
    </div>
</footer><?php if (!empty($_SESSION['order_success'])): ?>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                alert("🎉 Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ xử lý sớm nhất.");
            }, 300); // nhẹ delay cho UI
        });
    </script>
    <?php unset($_SESSION['order_success']); ?>
<?php endif; ?>