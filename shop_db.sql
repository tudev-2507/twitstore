-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 07, 2025 lúc 09:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Thời trang nam', '2025-08-04 16:57:04'),
(2, 'Thời trang nữ', '2025-08-04 16:57:04'),
(3, 'Giày dép', '2025-08-04 16:57:04'),
(4, 'Phụ kiện', '2025-08-04 16:57:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `phone`, `created_at`, `status`) VALUES
(11, NULL, 'Vu Dinh Tư', 'Thanh Hóa', '0353802738', '2025-08-07 17:23:50', 'confirmed'),
(12, 4, 'Hoàng Thị Kha', 'Yên Bái', '0877934125', '2025-08-07 19:00:43', 'confirmed'),
(13, 4, 'Tập Cận Bình', 'China From', '0322139788', '2025-08-07 19:39:45', 'confirmed'),
(14, 4, 'Tông Tiên Sư', 'Sơn La', '0773382908', '2025-08-07 19:41:21', 'confirmed');

--
-- Bẫy `orders`
--
DELIMITER $$
CREATE TRIGGER `trg_update_order_details_status` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    -- Nếu status thay đổi thì mới cập nhật
    IF OLD.status <> NEW.status THEN
        UPDATE order_details
        SET status = NEW.status
        WHERE order_id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(1, 11, 1, 2, 200000, 'hoàn thành'),
(93868, 12, 6, 1, 20000000, 'hoàn thành'),
(93869, 13, 3, 2, 500000, 'hoàn thành'),
(93870, 13, 6, 1, 20000000, 'hoàn thành'),
(93871, 14, 1, 1, 200000, 'hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 1, 'Áo Thun Nam', 'Áo thun cotton 100%, co giãn 4 chiều.', 200000, '1754338267_1-NAU-LD9202.jpg', '2025-08-04 16:57:04'),
(2, 1, 'Quần Jean Nam', 'Quần jean xanh đậm, kiểu dáng Hàn Quốc.', 350000, '1754338311_shop-quan-jeans-dep-o-ha-noi-05.jpg', '2025-08-04 16:57:04'),
(3, 3, 'Giày Sneaker', 'Giày thể thao phong cách trẻ trung.', 500000, '1754338350_z5731188687196_a912b490066d450f58b9a1f92cfe8d2c_ddfa0309c84846db9a48b1e323237168_master.jpg', '2025-08-04 16:57:04'),
(5, 2, 'Quần jean nữ', 'Vải bò, chất xịn hàng Quảng Châu', 350000, '1754338430_800-800_e9353fe5-40a1-46e6-b617-08bfc754afe3.jpg', '2025-08-04 20:13:50'),
(6, 3, 'Dép Dior', 'Hàng Dior nhập ngoại', 20000000, '1754338488_cbfcd0c45dd5a81d7fa8854dfa39282b.jpg', '2025-08-04 20:14:48'),
(7, 1, 'Áo sơ mi', 'Vải đẹp', 990000, '1754596074_o1cn01xbfhve1m12kk6waqv4146324.webp', '2025-08-07 19:47:54'),
(8, 1, 'Áo vest nam', 'chất lượng cao', 2000000, '1754596165_vn-11134207-7ras8-m37b0jk2qdik07.webp', '2025-08-07 19:49:25'),
(9, 4, 'Mũ Lưỡi Trai ', 'erdio chuyên mua bán các kiểu nón kết, mũ lưỡi trai nam nữ đẹp, chất liệu cao cấp, hợp thời trang cho nam và nữ trên toàn quốc.', 200000, '1754596231_shopping.webp', '2025-08-07 19:50:31'),
(10, 4, 'Mũ Phớt Nam ', 'Già dặn', 700000, '1754596279_shopping (1).webp', '2025-08-07 19:51:19'),
(12, 4, 'CASIO LTP', 'Casio là một trong những thương hiệu đồng hồ hàng đầu Nhật Bản và được yêu thích trên toàn thế giới với công nghệ hoàn toàn mới với phần mặt mỏng được thiết kế thời trang theo hơi hướng của các dòng đồng hồ Châu Âu.\r\nTrong bộ sưu tập dòng Casio LTP-VT01 nhà Casio, mẫu đồng hồ nữ Casio LTP-VT01GL-9BUDF mang đến sự tinh tế và thiết kế đơn giản, tạo nên sự thanh lịch cho người đeo. Hãy cùng đánh giá chi tiết về mẫu đồng hồ này cùng casio-hcm.vn nhé!', 3000000, '1754596444_CASIO-LTP-VT01GL-9B.jpg', '2025-08-07 19:54:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$Yu4AUZgpM3Rv6s3Pl76FmOZOdxKBZ1.nxPpgk0KGgR15NBVDzQTcW', 'admin', '2025-08-04 16:57:04'),
(4, 'user', '$2y$10$Yu4AUZgpM3Rv6s3Pl76FmOZOdxKBZ1.nxPpgk0KGgR15NBVDzQTcW', 'user', '2025-08-04 17:48:51');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93872;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
