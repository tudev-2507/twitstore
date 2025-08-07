<?php
class Order
{
    public static function all($conn)
    {
        $stmt = $conn->prepare("SELECT * FROM orders ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $data)
    {
        $stmt = $conn->prepare("INSERT INTO orders (user_id, name, address, phone, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->execute([$data['user_id'], $data['name'], $data['address'], $data['phone']]);
        return $conn->lastInsertId();
    }

    public static function allWithUser($conn)
    {
        $stmt = $conn->prepare("SELECT orders.*, users.username FROM orders LEFT JOIN users ON orders.user_id = users.id ORDER BY orders.id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getOrderById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function moveToOrderDetails($conn, $order)
    {

        $stmt = $conn->prepare("SELECT * FROM order_details WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $order['id']]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($items as $item) {
            $stmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price, status)
                                VALUES (:order_id, :product_id, :quantity, :price, :status)");
            $stmt->execute([
                'order_id' => $item['order_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'status' => 'hoàn thành'
            ]);
        }

        return true;
    }
    public static function countAll($conn)
    {
        $stmt = $conn->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }
    public static function confirmOrder($conn, $orderId)
    {
        // Cập nhật trạng thái đơn hàng chính (nếu bạn có cột `status` trong bảng orders)
        $stmt = $conn->prepare("UPDATE orders SET status = 'confirmed' WHERE id = ?");
        $stmt->execute([$orderId]);

        // Cập nhật trạng thái chi tiết đơn hàng nếu có
        $stmt = $conn->prepare("SELECT COUNT(*) FROM order_details WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $stmt = $conn->prepare("UPDATE order_details SET status = 'hoàn thành' WHERE order_id = ?");
            $stmt->execute([$orderId]);
        }

        return true;
    }
    public static function findById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function getOrderDetails($conn, $order_id)
    {
        $stmt = $conn->prepare("
           SELECT 
            od.*,
            p.name AS product_name,
            p.price AS product_price,
            p.image AS product_image
            FROM order_details od 
            JOIN products p ON od.product_id = p.id 
            WHERE od.order_id = :order_id
        ");
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll();
    }

    public static function getCustomerInfo($conn, $orderId)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
