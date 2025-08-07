<?php
$conn = connectDB();
class Product
{
    // Lấy toàn bộ sản phẩm

    // models/Product.php

    public static function all($conn, $keyword = null)
    {
        if ($keyword) {
            $stmt = $conn->prepare("
            SELECT products.*, categories.name AS category_name 
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.name LIKE :keyword
        ");
            $stmt->execute(['keyword' => '%' . $keyword . '%']);
        } else {
            $stmt = $conn->prepare("
            SELECT products.*, categories.name AS category_name 
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id
        ");
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin 1 sản phẩm theo ID
    public static function find($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Tạo mới sản phẩm
    public static function create($conn, $data)
    {
        $stmt = $conn->prepare("
        INSERT INTO products (name, description, price, image, category_id)
        VALUES (:name, :description, :price, :image, :category_id)
    ");
        $stmt->execute([
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'image'       => $data['image'],
            'category_id' => $data['category_id'],
        ]);
    }

    // Cập nhật sản phẩm
    public static function update($conn, $data)
    {
        $stmt = $conn->prepare("
        UPDATE products 
        SET name = :name, description = :description, price = :price, image = :image, category_id = :category_id
        WHERE id = :id
    ");
        $stmt->execute([
            'id'          => $data['id'],
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'image'       => $data['image'],
            'category_id' => $data['category_id']
        ]);
    }

    // Xoá sản phẩm
    public static function delete($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public static function countAll($conn)
    {
        $stmt = $conn->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }
}
