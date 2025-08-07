 <?php require_once 'views/layouts/header.php'; ?>
 <table class="table table-bordered">
     <thead class="table-light">
         <tr>
             <th>Ảnh</th>
             <th>Tên sản phẩm</th>
             <th>Giá</th>
             <th>Số lượng</th>
             <th>Thành tiền</th>
         </tr>
     </thead>
     <tbody>
         <?php
            $total = 0;
            foreach ($orderDetails as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
             <tr>
                 <td>
                     <img
                         src="uploads/<?= htmlspecialchars($item['product_image']) ?>"
                         alt="<?= htmlspecialchars($item['product_name']) ?>"
                         width="80px"
                         height="80px"
                         style="object-fit: cover;">
                 </td>
                 <td><?= htmlspecialchars($item['product_name']) ?></td>
                 <td><?= number_format($item['price']) ?> đ</td>
                 <td><?= $item['quantity'] ?></td>
                 <td><?= number_format($subtotal) ?> đ</td>
             </tr>
         <?php endforeach; ?>
         <tr>
             <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
             <td><strong><?= number_format($total) ?> đ</strong></td>
         </tr>
     </tbody>
 </table>
 <?php require_once 'views/layouts/footer.php'; ?>