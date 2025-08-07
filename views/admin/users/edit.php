<?php require_once 'views/layouts/header.php'; ?>

<h2>Chỉnh sửa người dùng</h2>

<form method="POST" action="index.php?controller=user&action=update">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <div class="form-group">
        <label>Tên người dùng:</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>

    <div class="form-group">
        <label>Quyền:</label>
        <select name="role" class="form-control">
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<?php require_once 'views/layouts/footer.php'; ?>