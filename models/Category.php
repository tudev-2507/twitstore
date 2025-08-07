<?php

class Category
{
    public static function all($conn)
    {
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function find($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($conn, $data)
    {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$data['name']]);
    }

    public static function update($conn, $data)
    {
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['id']]);
    }

    public static function delete($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}
