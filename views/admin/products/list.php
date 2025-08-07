<!-- views/admin/products/list.php -->
<?php require_once __DIR__ . '/../../layouts/header.php'; ?>
<h2 class="mb-4 text-center"> Quản lý sản phẩm</h2>

<div class="text-end mb-3">
    <a href="index.php?controller=product&action=create" class="btn btn-success">
        Thêm sản phẩm
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 0, ',', '.') ?> ₫</td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="uploads/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-thumbnail" style="width: 80px; height: auto;">
                        <?php else: ?>
                            <span class="text-muted">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></td>
                    <td>
                        <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">
                            Sửa
                        </a>
                        <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xoá?')">
                            Xoá
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once 'views/layouts/footer.php'; ?>