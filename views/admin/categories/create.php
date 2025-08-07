<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center"> Thêm danh mục mới</h2>

    <form action="index.php?controller=category&action=store" method="POST" class="border rounded p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success"> Lưu</button>
            <a href="index.php?controller=category&action=manage" class="btn btn-secondary ms-2">↩ Quay lại</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>