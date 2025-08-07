<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="row g-5 align-items-center">
        <!-- Ảnh sản phẩm -->
        <div class="col-md-6 text-center">
            <img src="uploads/<?= $product['image'] ?>"
                alt="<?= htmlspecialchars($product['name']) ?>"
                class="img-fluid rounded shadow-sm"
                style="max-height: 420px; object-fit: cover;">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h1>
            <p class="text-muted mb-2">Giá:</p>
            <h3 class="text-danger mb-4"><?= number_format($product['price'], 0, ',', '.') ?>₫</h3>

            <p class="mb-4"><?= nl2br(htmlspecialchars($product['description'])) ?></p>

            <form method="POST" action="index.php?controller=cart&action=add">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control w-25" min="1" value="1" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>