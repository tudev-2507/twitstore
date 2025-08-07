<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $isAdmin = !empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
    $homeLink = $isAdmin ? 'index.php?controller=dashboard' : 'index.php';
    ?>
    <a class="navbar-brand fw-bold text-warning" href="<?= $homeLink ?>">Trang chủ</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=product&action=<?= $isAdmin ? 'manage' : 'index' ?>">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=category&action=<?= $isAdmin ? 'manage' : 'index' ?>">Danh mục</a>
            </li>

            <?php if (!$isAdmin): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=cart&action=index">Giỏ hàng</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=order&action=listOrders">Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=statistic&action=index">Thống kê</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=user">Quản lí Người dùng</a>
                </li>

            <?php endif; ?>
        </ul>


        <ul class="navbar-nav ms-auto">
            <?php if (!empty($_SESSION['user'])) : ?>
                <li class="nav-item">
                    <a class="nav-link disabled text-light" href="#">
                        Xin chào, <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="index.php?controller=auth&action=logout"> Đăng xuất</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link text-success" href="index.php?controller=auth&action=login"> Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="index.php?controller=auth&action=register"> Đăng ký</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>