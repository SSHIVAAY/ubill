
CREATE DATABASE IF NOT EXISTS `ubill` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ubill`;

-- --------------------------------------------------------
-- Table: users
-- Stores customer registration details
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample user
INSERT INTO `users` (`name`, `mobile`, `email`, `session_id`) VALUES
('Test User', '9999999999', 'testuser@example.com', 'session123');

-- --------------------------------------------------------
-- Table: products
-- Stores product catalog
-- --------------------------------------------------------

CREATE TABLE `products` (
  `barcode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `weight_unit` varchar(10) NOT NULL,
  PRIMARY KEY (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample products
INSERT INTO `products` (`barcode`, `name`, `price`, `weight`, `weight_unit`) VALUES
('1001', 'Parle-G Biscuit', 10.00, 100.00, 'gm'),
('1002', 'Dairy Milk Chocolate', 40.00, 30.00, 'gm'),
('1003', 'Pepsi 500ml', 35.00, 500.00, 'ml'),
('1004', 'Aashirvaad Atta 5kg', 210.00, 5.00, 'kg'),
('1005', 'Fortune Oil 1L', 120.00, 1.00, 'L');

-- --------------------------------------------------------
-- Table: cart_items
-- Stores items scanned by a customer
-- Improved version of the old cart table
-- --------------------------------------------------------

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`barcode`) REFERENCES `products`(`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample cart items
INSERT INTO `cart_items` (`session_id`, `barcode`, `quantity`) VALUES
('session123', '1001', 2),
('session123', '1003', 1);

