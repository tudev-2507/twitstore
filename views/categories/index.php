<?php require_once 'views/layouts/header.php'; ?>
<div class="container mt-4">
    <h2>Danh sách danh mục</h2>
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                        <a href="index.php?controller=product&action=index&category_id=<?= $category['id'] ?>" class="btn btn-primary">
                            Xem sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once 'views/layouts/footer.php'; ?>