<?php require_once 'views/layouts/header.php'; ?>

<div class="container mt-5">
    <h2> Giỏ hàng của bạn</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">Giỏ hàng trống.</div>
    <?php else:
        $total = 0;
    ?>

        <?php foreach ($cartItems as $product): ?>
            <?php
            $subtotal = $product['price'] * $product['quantity'];
            $total += $subtotal;
            ?>
            <div class="card mb-3 shadow-sm">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2 text-center p-2">
                        <img src="uploads/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                            class="img-fluid rounded" style="max-height: 100px; object-fit: cover;">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="mb-1">Giá: <?= number_format($product['price'], 0, ',', '.') ?> VNĐ</p>
                                    <p class="mb-1"><strong>Thành tiền:</strong> <?= number_format($subtotal, 0, ',', '.') ?> VNĐ</p>
                                </div>
                                <div class="text-end">
                                    <div class="d-flex align-items-center">
                                        <a href="index.php?controller=cart&action=decrease&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-secondary me-2">➖</a>
                                        <strong><?= $product['quantity'] ?></strong>
                                        <a href="index.php?controller=cart&action=increase&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-secondary ms-2">➕</a>
                                        <a href="index.php?controller=cart&action=remove&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm ms-3">
                                            🗑️
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="mt-4 p-3 bg-light rounded">
            <h5 class="text-end">Tổng thanh toán: <span class="text-danger"><?= number_format($total, 0, ',', '.') ?> VNĐ</span></h5>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php?controller=cart&action=clear" class="btn btn-warning">
                Xoá toàn bộ
            </a>
            <a href="index.php?controller=order&action=checkout" class="btn btn-success">
                Đặt Hàng
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'views/layouts/footer.php'; ?>