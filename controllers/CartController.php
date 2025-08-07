<?php
require_once 'models/Product.php';
require_once 'commons/function.php';


class CartController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $cart = $_SESSION['cart'] ?? [];

        $conn = connectDB();
        $cartItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($conn, $productId);
            if ($product) {
                $product['quantity'] = $quantity;
                $cartItems[] = $product;
            }
        }

        // Truyền $cartItems vào view
        require_once 'views/cart/index.php';
    }

    public function add()
    {
        session_start();
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }
        $_SESSION['cart'][$productId] += $quantity;

        header('Location: index.php?controller=cart&action=index');
    }

    public function remove()
    {
        session_start();
        $productId = $_GET['id'] ?? null;
        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header('Location: index.php?controller=cart&action=index');
    }

    public function clear()
    {
        session_start();
        unset($_SESSION['cart']);
        header('Location: index.php?controller=cart&action=index');
    }
    public function increase($id)
    {
        session_start();
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        }
        header("Location: index.php?controller=cart&action=index");
    }


    public function decrease($id)
    {
        session_start(); // nên thêm
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]--;
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
        header("Location: index.php?controller=cart&action=index");
    }
    public function buyNow()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=auth&action=login&redirect=order%2Fcheckout');
            exit;
        }

        $productId = $_POST['product_id'] ?? null;

        if (!$productId) {
            header('Location: index.php');
            exit;
        }

        $quantity = 1;
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }
        $_SESSION['cart'][$productId] += $quantity;

        header("Location: index.php?controller=order&action=checkout");
        exit;
    }
}
