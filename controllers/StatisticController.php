<?php
require_once 'models/Statistic.php';

class StatisticController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('Bạn không có quyền truy cập trang này.');
        }
    }

    public function index()
    {
        $statistics = Statistic::getStatistics($this->conn);
        require 'views/admin/statistics/index.php';
    }
}
