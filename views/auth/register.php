<?php require_once 'views/layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6"> <!-- Căn trái -->
            <h2>Đăng ký</h2>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form action="index.php?controller=auth&action=register" method="post">
                <div class="form-group">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="username" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu:</label>
                    <input type="password" name="confirm_password" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-success mt-2">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>