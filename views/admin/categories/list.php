<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4"> Danh sách danh mục</h2>
    <a href="index.php?controller=category&action=create" class="btn btn-success mb-3"> Thêm danh mục</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td>
                        <a href="index.php?controller=category&action=edit&id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?controller=category&action=delete&id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xoá?')"> Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>