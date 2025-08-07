 <?php require_once 'views/layouts/header.php'; ?>
 <div class="container mt-5">
     <h2 class="mb-4">Danh sách đơn hàng</h2>

     <div class="table-responsive">
         <table class="table table-bordered table-striped align-middle">
             <thead class="table-dark">
                 <tr>
                     <th>ID</th>
                     <th>Người đặt</th>
                     <th>Địa chỉ</th>
                     <th>SĐT</th>
                     <th>Ngày đặt</th>
                     <th>Trạng thái</th>
                     <th>Chi tiết</th>

                 </tr>
             </thead>
             <tbody>
                 <?php if (!empty($orders)): ?>
                     <?php foreach ($orders as $order): ?>
                         <tr>
                             <td><?= $order['id'] ?></td>
                             <td><?= htmlspecialchars($order['name']) ?></td>
                             <td><?= htmlspecialchars($order['address']) ?></td>
                             <td><?= htmlspecialchars($order['phone']) ?></td>
                             <td><?= $order['created_at'] ?></td>
                             <td><?= htmlspecialchars($order['status']) ?></td>
                             <td>
                                 <a href="index.php?controller=order&action=detail&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">Xem</a>
                                 <a href="index.php?controller=order&action=confirm&id=<?= $order['id'] ?>" class="btn btn-sm btn-success">Xác nhận</a>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 <?php else: ?>
                     <tr>
                         <td colspan="6" class="text-center">Không có đơn hàng nào.</td>
                     </tr>
                 <?php endif; ?>
             </tbody>
         </table>
     </div>

     <a href="index.php?controller=admin&action=dashboard" class="btn btn-secondary mt-3">Quay lại trang Admin</a>
 </div>

 <?php require_once 'views/layouts/footer.php'; ?>