<?php
require_once 'commons/env.php';
require_once 'commons/function.php';

class User
{
    public static function findByName($name)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name, $password, $role = 'user')
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $password, $role]);
    }

    public static function getAllUsers($conn)
    {
        $stmt = $conn->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUser($conn, $id, $username, $role)
    {
        $stmt = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        return $stmt->execute([$username, $role, $id]);
    }

    public static function deleteUser($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function countAll($conn)
    {
        $stmt = $conn->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }
}
