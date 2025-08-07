# TwitStore - Dự án Web PHP MVC

> Một website thương mại điện tử cơ bản sử dụng mô hình MVC thuần PHP.

![TwitStore](https://your-image-or-logo-url-if-any.png)

## 🚀 Giới thiệu

TwitStore là một dự án web sử dụng PHP thuần theo mô hình MVC (Model - View - Controller). Dự án này phục vụ nhu cầu học tập, nghiên cứu và triển khai website bán hàng/khoá học online. Không sử dụng framework, giúp bạn hiểu rõ luồng xử lý trong PHP.

---

## 🧩 Tính năng chính

- 🛒 Danh sách sản phẩm theo danh mục
- 📦 Quản lý đơn hàng (admin)
- 👤 Đăng nhập / Đăng ký người dùng
- 🧑‍💻 Phân quyền: người dùng và admin
- 💬 Giao diện quản trị đơn giản
- 📈 Giao diện người dùng thân thiện
- 💾 Giao tiếp với CSDL MySQL

---

## 🗂️ Cấu trúc thư mục

mvc-oop-basic/
├── controllers/ # Controller xử lý logic
├── models/ # Model giao tiếp với DB
├── views/ # View giao diện người dùng & admin
├── public/ # Tệp CSS, JS, hình ảnh
├── commons/ # Cấu hình DB, hàm dùng chung
├── router.php # Điều hướng URL
├── index.php # Điểm khởi đầu
└── database.sql # Cơ sở dữ liệu (import trong phpMyAdmin)

---

## 🛠️ Yêu cầu hệ thống

- PHP >= 7.4 (khuyên dùng 8.x)
- MySQL / MariaDB
- Apache (XAMPP, Laragon, MAMP...)

---

## ⚙️ Cài đặt & chạy local

### 1. Clone dự án:

```bash
git clone https://github.com/tudev-2507/twitstore.git
C:\xampp\htdocs\Duan1\twitstore\
define('DB_HOST', 'localhost');
define('DB_NAME', 'shop_');
define('DB_USER', 'root');
define('DB_PASS', '');
http://localhost/Duan1/twitstore/index.php
💻 Liên hệ
🌐 tudev-2507.github.io

📧 Email: vtu8531@gmail.com (nếu có)


