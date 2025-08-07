<?php
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'models/Product.php';



class OrderController
{
    public function listOrders()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('Bạn không có quyền truy cập trang này.');
        }

        $orders = Order::allWithUser($GLOBALS['conn']);
        require_once 'views/admin/orders/list.php';
    }

    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=login&redirect=order%2Fcheckout');
            exit;
        }
        require 'views/order/checkout.php';
    }

    public function placeOrder()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $cart = $_SESSION['cart'] ?? [];
        $userId = $_SESSION['user']['id'] ?? null;

        if (empty($cart)) {
            header('Location: index.php?controller=cart');
            exit;
        }

        $orderId = Order::create($GLOBALS['conn'], [
            'user_id' => $userId,
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ]);

        foreach ($cart as $productId => $qty) {
            $product = Product::find($GLOBALS['conn'], $productId);
            OrderDetail::create($GLOBALS['conn'], [
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $qty,
                'price' => $product['price']
            ]);
        }

        unset($_SESSION['cart']);
        $_SESSION['order_success'] = true; // Flash session
        header('Location: index.php');
        exit;
    }
    public function confirm()
    {

        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Bạn không có quyền truy cập chức năng này.");
        }

        if (!isset($_GET['id'])) {
            echo "Thiếu ID đơn hàng.";
            return;
        }

        $orderId = $_GET['id'];
        $order = Order::getOrderById($GLOBALS['conn'], $orderId);
        if (!$order) {
            echo "Đơn hàng không tồn tại.";
            return;
        }

        $success = Order::confirmOrder($GLOBALS['conn'], $orderId);

        if ($success) {
            header("Location: index.php?controller=order&action=listOrders");
            exit;
        } else {
            echo "Lỗi khi xác nhận đơn hàng (có thể đơn chưa có dữ liệu chi tiết).";
        }
    }
    public function detail()
    {
        $conn = connectDB();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Thiếu ID đơn hàng.";
            return;
        }

        $order = Order::findById($conn, $id);
        $orderDetails = Order::getOrderDetails($conn, $id);
        $customer = Order::getCustomerInfo($conn, $id);

        require 'views/admin/orders/detail.php';
    }
}
