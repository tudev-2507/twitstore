<?php
class OrderDetail
{
    public static function create($conn, $data)
    {
        $stmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price, status)
                            VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['order_id'],
            $data['product_id'],
            $data['quantity'],
            $data['price'],
            $data['status'] ?? 'đang xử lý'
        ]);
    }
}
