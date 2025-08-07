<?php require_once 'views/layouts/header.php'; ?>

<h2>Thống kê sản phẩm đã bán</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tổng số lượng bán</th>
            <th>Tổng doanh thu</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($statistics)): ?>
            <?php foreach ($statistics as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= $item['total_quantity_sold'] ?></td>
                    <td><?= number_format($item['total_revenue'], 0, ',', '.') ?> đ</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Chưa có dữ liệu thống kê.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'views/layouts/footer.php'; ?>