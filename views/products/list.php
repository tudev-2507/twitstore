<?php require_once 'views/layouts/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Danh sách sản phẩm</h2>
    <?php require_once 'views/layouts/main.php'; ?>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="row mb-4">
        <input type="hidden" name="controller" value="product">
        <input type="hidden" name="action" value="index">
        <div class="col-md-10">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="<?= $_GET['keyword'] ?? '' ?>">
        </div>
        <div class="col-md-2 text-end">
            <button type="submit" class="btn btn-primary w-100">Tìm<i class='bxr  bx-search'></i> </button>
        </div>
    </form>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card product-card h-100">
                    <div class="image-vertical">
                        <img src="uploads/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="price"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>

                        <a href="index.php?controller=product&action=show&id=<?= $product['id'] ?>" class="btn btn-primary mb-2">Xem chi tiết</a>
                        <form method="POST" action="index.php?controller=cart&action=buyNow" class="mt-auto">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-buy-now w-100"> Mua ngay</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php require_once 'views/layouts/footer.php'; ?>