<?php
require_once 'commons/env.php';
require_once 'commons/function.php';

class DashboardController
{
    public function index()
    {
        global $conn;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Bạn không có quyền truy cập trang này.";
            exit;
        }
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE status = 'pending'");
        $stmt->execute();
        $pendingCount = $stmt->fetchColumn();

        require_once 'views/admin/dashboard.php';
    }
}
