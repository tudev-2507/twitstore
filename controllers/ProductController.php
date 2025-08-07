<?php

require_once 'models/Product.php';
require_once 'models/Category.php';

class ProductController
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    // Danh sách sản phẩm cho người dùng
    // controllers/ProductController.php

    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            header('Location: index.php?controller=product&action=manage');
            exit;
        }

        $keyword = $_GET['keyword'] ?? null;
        $products = Product::all($this->conn, $keyword);
        require_once 'views/products/list.php';
    }



    // Chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::find($this->conn, $id);
        require_once 'views/products/detail.php';
    }

    // Trang admin - danh sách sản phẩm
    public function manage()
    {
        $this->authorizeAdmin();
        $keyword = $_GET['keyword'] ?? null;
        $products = Product::all($this->conn, $keyword);
        require_once 'views/admin/products/list.php';
    }


    // Hiển thị form thêm sản phẩm
    public function create()
    {
        $this->authorizeAdmin();
        $categories = Category::all($this->conn);
        require_once 'views/admin/products/create.php';
    }

    // Xử lý thêm sản phẩm
    public function store($data)
    {
        $this->authorizeAdmin();

        // Xử lý ảnh
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $filename;
            }
        }


        $data['image'] = $imagePath;

        Product::create($this->conn, $data);

        header('Location: index.php?controller=product&action=manage');
    }

    // Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $this->authorizeAdmin();
        $product = Product::find($this->conn, $id);
        $categories = Category::all($this->conn);
        require_once 'views/admin/products/edit.php';
    }

    // Cập nhật sản phẩm
    public function update($data)
    {
        $this->authorizeAdmin();

        // Lấy sản phẩm hiện tại để xử lý ảnh cũ
        $product = Product::find($this->conn, $data['id']);

        // Nếu có ảnh mới được upload
        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = 'uploads/' . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Xoá ảnh cũ nếu tồn tại
                if (!empty($product['image']) && file_exists('uploads/' . $product['image'])) {
                    unlink('uploads/' . $product['image']);
                }

                $data['image'] = $imageName;
            }
        } else {
            // Không upload ảnh mới → giữ ảnh cũ
            $data['image'] = $product['image'];
        }

        Product::update($this->conn, $data);

        header('Location: index.php?controller=product&action=manage');
    }


    // Xoá sản phẩm
    public function delete($id)
    {
        $this->authorizeAdmin();
        Product::delete($this->conn, $id);
        header('Location: index.php?controller=product&action=manage');
    }

    // Kiểm tra quyền admin
    private function authorizeAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('Bạn không có quyền truy cập chức năng này.');
        }
    }
}
