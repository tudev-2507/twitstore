<?php require_once 'views/layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6"> <!-- Căn trái -->
            <h2>Đăng nhập</h2>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form action="index.php?controller=auth&action=login" method="post">
                <div class="form-group">
                    <label>Tên đăng nhập:</label>
                    <input name="username" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary mt-2">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>