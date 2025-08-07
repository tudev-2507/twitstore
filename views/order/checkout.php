<?php require_once 'views/layouts/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Xác nhận địa chỉ</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form method="post" action="index.php?controller=order&action=placeOrder" class="border p-4 rounded shadow bg-white">
                <div class="mb-3">
                    <label for="name" class="form-label"> Họ tên:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label"> Địa chỉ:</label>
                    <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"> Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-check-circle me-2"></i>Xác nhận đơn hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>