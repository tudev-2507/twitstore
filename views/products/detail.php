<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <!-- Ảnh sản phẩm -->
        <div class="col-md-5 text-center">
            <img src="uploads/<?= $product['image'] ?>"
                alt="<?= htmlspecialchars($product['name']) ?>"
                class="img-fluid rounded shadow"
                style="max-height: 400px; object-fit: cover;">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-7">
            <h2 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h2>
            <p class="text-muted">Giá:</p>
            <h4 class="text-danger"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</h4>

            <p class="mt-4"><?= nl2br(htmlspecialchars($product['description'])) ?></p>

            <!-- Form thêm giỏ hàng -->
            <form method="POST" action="index.php?controller=cart&action=add" class="mt-4">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <div class="mb-3 d-flex align-items-center gap-3">
                    <label for="quantity" class="form-label mb-0">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1"
                        class="form-control w-auto" style="max-width: 100px;" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>