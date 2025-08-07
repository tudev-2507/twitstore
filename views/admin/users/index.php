<?php require_once 'views/layouts/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Quản lý người dùng</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Quyền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <a href="index.php?controller=user&action=edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>

                        <?php if ($_SESSION['user']['id'] != $user['id']): ?>
                            <a href="index.php?controller=user&action=delete&id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">Xóa</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'views/layouts/footer.php'; ?>