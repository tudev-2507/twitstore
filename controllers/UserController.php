<?php
require_once 'models/User.php';

class UserController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Bạn không có quyền truy cập.");
        }
    }

    public function index()
    {
        $users = User::getAllUsers($this->conn);
        require 'views/admin/users/index.php';
    }

    public function manage()
    {
        $users = User::getAllUsers($this->conn);
        require 'views/admin/users/manage.php';
    }

    public function edit($id)
    {
        $user = User::getUserById($this->conn, $id);
        require 'views/admin/users/edit.php';
    }

    public function update($post)
    {
        $id = $post['id'];
        $username = $post['username'];
        $role = $post['role'];

        // Gọi đúng thứ tự tham số
        User::updateUser($this->conn, $id, $username, $role);

        header('Location: index.php?controller=user&action=manage');
        exit;
    }

    public function delete($id)
    {
        User::deleteUser($this->conn, $id);
        header('Location: index.php?controller=user&action=manage');
        exit;
    }
}
