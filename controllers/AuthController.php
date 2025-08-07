<?php
require_once 'models/User.php';

class AuthController
{
    public function showLoginForm()
    {
        $error = $_GET['error'] ?? null;
        require_once 'views/auth/login.php';
    }

    public function showRegisterForm()
    {
        $error = $_GET['error'] ?? null;
        require_once 'views/auth/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = User::findByName($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['name'] ?? $user['username'],
                    'role' => $user['role']
                ];

                header("Location: index.php");
                exit;
            } else {
                header("Location: index.php?controller=auth&action=showLoginForm&error=Sai+tài+khoản+hoặc+mật+khẩu");
                exit;
            }
        } else {
            header("Location: index.php?controller=auth&action=showLoginForm");
            exit;
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if ($password !== $confirm) {
                header("Location: index.php?controller=auth&action=showRegisterForm&error=Mật+khẩu+xác+nhận+không+khớp");
                exit;
            }

            if (User::findByName($name)) {
                header("Location: index.php?controller=auth&action=showRegisterForm&error=Tên+đăng+nhập+đã+tồn+tại");
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            User::create($name, $hashedPassword);

            // Sau khi đăng ký xong thì chuyển về login
            header('Location: index.php?controller=auth&action=showLoginForm');
            exit;
        } else {
            header("Location: index.php?controller=auth&action=showRegisterForm");
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
