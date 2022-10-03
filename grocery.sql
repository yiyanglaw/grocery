-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2021 at 07:27 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('C1', 'Vegetable'),
('C2', 'Meat'),
('C3', 'Cooking Oil');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` varchar(50) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `cust_contact` int(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `delivery_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `cust_name`, `gender`, `cust_contact`, `email_address`, `delivery_address`) VALUES
('james123', 'James', 'Male', 134567890, 'james123@gmail.com', 'No 7, Jalan Cemerlang, 81550 Skudai, Johor.'),
('karen123', 'Karen', 'Female', 123456789, 'karen123@gmail.com', 'No 1, Jalan Bintang, 81543 Gelang Patah, Johor.');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `tracking_id` varchar(50) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `driver_contact` int(50) NOT NULL,
  `plat_number` varchar(50) NOT NULL,
  `est_delivery_time` time(6) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`tracking_id`, `driver_name`, `driver_contact`, `plat_number`, `est_delivery_time`, `payment_method`, `payment_amount`, `order_id`) VALUES
('T1234', 'Ali', 198765432, 'ABC1234', '16:16:23.000000', 'Credit card', 20.50, 'OD123'),
('T5678', 'Ah Meng', 187654321, 'EFG5678', '13:08:23.000000', 'Online banking', 6.00, 'OD456');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` varchar(50) NOT NULL,
  `rating` double(10,1) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_time` time(6) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `rating`, `comment`, `feedback_date`, `feedback_time`, `user_id`, `order_id`) VALUES
('FB123', 5.0, 'Fast delivery', '2021-09-08', '20:11:09.000000', 'karen123', 'OD123'),
('FB456', 4.9, 'Good quality', '2021-09-08', '21:11:09.000000', 'james123', 'OD456');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_quantity` int(50) NOT NULL,
  `order_amount` double(10,2) NOT NULL,
  `product_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `product_name`, `product_quantity`, `order_amount`, `product_id`) VALUES
('OD123', '2021-09-07', 'Carrot', 10, 20.50, 'PD123'),
('OD456', '2021-09-07', 'Chicken', 1, 6.00, 'PD456');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`, `payment_date`, `payment_amount`, `order_id`) VALUES
('PYM123', 'Credit card', '2021-09-07', 20.50, 'OD123'),
('PYM456', 'Online banking', '2021-09-07', 6.00, 'OD456');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_description` varchar(50) NOT NULL,
  `product_quantity` int(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category`, `product_price`, `product_description`, `product_quantity`, `image`) VALUES
('PD123', 'Carrot', 'C1', 2.05, 'Fresh carrot from organic farm', 30, 'carrot 10.PNG'),
('PD456', 'Chicken Drumstick', 'C2', 6.00, 'Fresh and healthy', 50, 'drumstick 2.png'),
('PD789', 'Sunflower Oil', 'C3', 5.00, 'Contains Omega 3 & 6 ', 30, 'cooking oil 3.png');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shop_contact` int(50) NOT NULL,
  `shop_email_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `shop_name`, `shop_address`, `shop_contact`, `shop_email_address`) VALUES
('SL123', 'EazyGrocery', 'No 123, Taman Bintang, 81550 Gelang Patah, Johor.', 192345678, 'eazygrocery@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
