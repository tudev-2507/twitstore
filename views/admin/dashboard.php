<?php
require_once 'views/layouts/header.php';
require_once 'models/User.php';
require_once 'models/Product.php';
require_once 'models/Order.php';

$totalUsers = User::countAll($conn);
$totalProducts = Product::countAll($conn);
$totalOrders = Order::countAll($conn);
?>
<?php if (isset($pendingCount) && $pendingCount > 0): ?>
    <div id="pending-popup" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #00d5ffff;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: slideIn 0.6s ease-out;
    ">
        🛒 Bạn có <strong><?= $pendingCount ?></strong> đơn hàng chưa xử lý!
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        setTimeout(() => {
            const popup = document.getElementById('pending-popup');
            if (popup) popup.style.display = 'none';
        }, 10000);
    </script>
<?php endif; ?>

<div class="container mt-5">
    <h2 class="mb-4">Bảng điều khiển quản trị</h2>

    <form method="GET" action="index.php" class="row mb-4">
        <input type="hidden" name="controller" value="product">
        <input type="hidden" name="action" value="manage">
        <div class="col-md-10">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm sản phẩm..." value="<?= $_GET['keyword'] ?? '' ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Tìm</button>
        </div>
    </form>

    <div class="row text-white mb-4">
        <div class="col-md-4">
            <div class="card bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text fs-4"><?= $totalProducts ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="card-text fs-4"><?= $totalUsers ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
                    <p class="card-text fs-4"><?= $totalOrders ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chào mừng đến với trang quản trị</h4>
            <p class="card-text">
                Đây là nơi bạn có thể quản lý toàn bộ hệ thống bao gồm người dùng, sản phẩm, đơn hàng, báo cáo, và nhiều tính năng khác.
            </p>
        </div>
    </div>
</div>


<?php require_once 'views/layouts/footer.php'; ?>