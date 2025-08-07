<?php
session_start(); // Bắt buộc có để sử dụng $_SESSION

require_once 'commons/env.php';
require_once 'commons/function.php';

$conn = connectDB();


$role = $_SESSION['user']['role'] ?? 'user';

// Điều hướng mặc định dựa trên vai trò
if (!isset($_GET['controller'])) {
    $controllerName = ($role === 'admin') ? 'dashboard' : 'product';
} else {
    $controllerName = $_GET['controller'];
}

$action = $_GET['action'] ?? 'index';

$controllerFile = "controllers/" . ucfirst($controllerName) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controllerName) . "Controller";

    $controller = new $className($conn);

    if (method_exists($controller, $action)) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->$action($_POST);
        } elseif (isset($_GET['id'])) {
            $controller->$action($_GET['id']);
        } else {
            $controller->$action();
        }
    } else {
        echo "❌ Không tìm thấy action.";
    }
} else {
    echo "❌ Không tìm thấy controller.";
}
