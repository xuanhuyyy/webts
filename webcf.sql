-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 02, 2023 lúc 01:48 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webcf`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `image`) VALUES
(3, 'x', '356a192b7913b04c54574d18c28d46e6395428ab', 'cappuchino.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(24, 2, 4, 'Cafe Đen', 30000, 2, 'cfden.jpg'),
(25, 2, 3, 'Bạc xỉu', 35000, 1, 'bacxiu.jpg'),
(26, 2, 5, 'Cafe Nâu', 35000, 1, 'cfnau.jpg'),
(41, 4, 3, 'Bạc xỉu', 35000, 1, 'bacxiu.jpg'),
(42, 4, 4, 'Cafe Đen', 30000, 1, 'cfden.jpg'),
(43, 3, 3, 'Bạc xỉu', 35000, 1, 'bacxiu.jpg'),
(44, 5, 3, 'Bạc xỉu', 35000, 1, 'bacxiu.jpg'),
(45, 5, 4, 'Cafe Đen', 30000, 1, 'cfden.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 4, 'huy', 'hlexuan93@gmail.com', '1', 'lx\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 3, 'huy', '1', 'hlexuan93@gmail.com', 'Chuyển khoản ngân hàng', 'h', 'h (123 x 1) q (123 x 1) ', 246, '2023-11-29', 'đang xử lý'),
(2, 2, 'huy', '1', 'hlexuan93@gmail.com', 'Thanh toán khi giao hàng', 'h', 'Cafe Đen (30000 x 2) Bạc xỉu (35000 x 1) Cafe Nâu (35000 x 1) ', 130000, '2023-11-30', ''),
(3, 2, 'huy', '3', '1@gmail.com', 'Chuyển khoản ngân hàng', 'h', 'Bạc xỉu (35000 x 1) Cafe Đen (30000 x 1) Cafe Nâu (35000 x 1) ', 100000, '2023-11-30', 'completed'),
(4, 3, 'huy', '4', 'hlexuan93@gmail.com', 'Thanh toán khi giao hàng', 'h', 'Bạc xỉu (35000 x 1) ', 35000, '2023-11-30', 'pending'),
(5, 3, '1', '1', '1@gmail.com', 'Thẻ tín dụng', 'h', 'Cafe Đen (30000 x 1) ', 30000, '2023-11-30', 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`) VALUES
(3, 'Bạc xỉu', 'Bạc Xỉu đặc biệt của riêng C4 Coffee được tạo nên từ cà phê nguyên chất và cốt dừa đặc sánh. Không đậm vị cà phê như nâu đá, Bạc Xỉu ngọt ngào và dễ uống hơn.', 35000, 'bacxiu.jpg'),
(4, 'Cafe Đen', 'Sẽ thật đáng tiếc nếu không một lần nếm thử hương vị cà phê Việt Nam. Thơm nồng nàn, đắng thanh thanh, ngọt nhẹ nhàng, một sự kết hợp tinh tế và thú vị', 30000, 'cfden.jpg'),
(5, 'Cafe Nâu', 'Bạn sẽ chẳng thể tìm được ở đâu khác ngoài Việt Nam một ly Cà Phê Nâu - sự kết hợp kỳ lạ mà hoàn hảo giữa cà phê đen đắng và một chút sữa đặc béo ngọt.', 35000, 'cfnau.jpg'),
(6, 'Espresso', 'Hãy đắm chìm trong hương thơm mạnh mẽ và vị ngon độc đáo của những giọt espresso hoàn hảo, tạo nên từ những hạt cà phê tinh khiết nhất trên thế giới. ', 45000, 'Espresso.jpg'),
(7, 'Cappuchino', 'Tại đây, chúng tôi tận dụng sự hòa quyện hoàn hảo giữa cà phê đậm đà và sự mềm mại của sữa tươi, để tạo nên một cappuccino đặc sắc, với lớp bọt sữa mịn màng ở trên cùng làm cho mỗi ngụm cảm nhận như một chuyến phiêu lưu đầy thú vị.', 50000, 'cappuchino.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `diachi` varchar(100) NOT NULL DEFAULT '0',
  `sdt` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `diachi`, `sdt`) VALUES
(2, 'huy12', '1@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '', '', 0),
(3, 'huy', 'huylexuan239@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '', '', 0),
(4, 'huy', 'hlexuan293@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '', '', 0),
(5, 'huy', 'hlexuan93@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'quan6.jpg', 'ThanhHoa', 327565878);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
