<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4 text-center"> Thêm sản phẩm mới</h2>

    <form method="POST" action="index.php?controller=product&action=store" class="border rounded p-4 shadow-sm bg-white" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm:</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success"> Thêm sản phẩm</button>
            <a href="index.php?controller=product&action=manage" class="btn btn-secondary ms-2">↩ Quay lại</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>