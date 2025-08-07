<?php

class AdminController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('Bạn không có quyền truy cập trang này.');
        }

        require_once 'views/admin/dashboard.php';
    }

    public function productList()
    {
        require_once 'models/Product.php';
        $products = Product::all($this->conn);
        require_once 'views/admin/products/list.php';
    }
}
