<?php

require_once 'models/Category.php';

class CategoryController
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    public function index()
    {
        $categories = Category::all($this->conn);
        require_once 'views/categories/index.php';
    }


    public function manage()
    {
        $this->authorizeAdmin();
        $categories = Category::all($this->conn);
        require_once 'views/admin/categories/list.php';
    }

    public function create()
    {
        $this->authorizeAdmin();
        require_once 'views/admin/categories/create.php';
    }

    public function store($data)
    {
        $this->authorizeAdmin();
        Category::create($this->conn, $data);
        header('Location: index.php?controller=category&action=manage');
    }


    public function edit($id)
    {
        $this->authorizeAdmin();
        $category = Category::find($this->conn, $id);
        require_once 'views/admin/categories/edit.php';
    }


    public function update($data)
    {
        $this->authorizeAdmin();
        Category::update($this->conn, $data);
        header('Location: index.php?controller=category&action=manage');
    }


    public function delete($id)
    {
        $this->authorizeAdmin();
        Category::delete($this->conn, $id);
        header('Location: index.php?controller=category&action=manage');
    }


    private function authorizeAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('⛔ Bạn không có quyền truy cập chức năng này.');
        }
    }
}
