<?php
class Statistic
{
    public static function getStatistics($conn)
    {
        $stmt = $conn->prepare("
        SELECT 
            products.name AS product_name,
            SUM(order_details.quantity) AS total_quantity_sold,
            SUM(order_details.price * order_details.quantity) AS total_revenue
        FROM order_details
        JOIN products ON order_details.product_id = products.id
        JOIN orders ON order_details.order_id = orders.id
        WHERE TRIM(LOWER(orders.status)) = 'confirmed'
        GROUP BY order_details.product_id
        ORDER BY total_quantity_sold DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
