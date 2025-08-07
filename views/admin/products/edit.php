<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4 text-center"> Sửa sản phẩm</h2>

    <form method="POST" action="index.php?controller=product&action=update" enctype="multipart/form-data" class="border rounded p-4 shadow-sm bg-white">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" rows="4" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm mới:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <?php if (!empty($product['image'])): ?>
            <div class="mb-3">
                <label class="form-label d-block">Ảnh hiện tại:</label>
                <img src="uploads/<?= $product['image'] ?>" alt="" style="max-width: 150px;" class="rounded shadow-sm">
            </div>
        <?php endif; ?>

        <div class="text-end">
            <button type="submit" class="btn btn-primary"> Cập nhật</button>
            <a href="index.php?controller=product&action=manage" class="btn btn-secondary ms-2">↩️ Quay lại</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>