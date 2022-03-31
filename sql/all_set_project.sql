-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 10:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `all_set_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_type_id` varchar(8) NOT NULL,
  `food_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `owner_id`, `food_name`, `food_type_id`, `food_price`) VALUES
(1, 1, 'Chicken Chop', 'WS', '22.00'),
(2, 1, 'Fish and Chips', 'WS', '11.00'),
(3, 1, 'French Fries ', 'WS', '6.00'),
(4, 1, 'Nasi Lemak with Chicken', 'LC', '8.00'),
(5, 1, 'Laksa', 'LC', '5.00'),
(8, 1, 'Canned Drink', 'DR', '3.00'),
(10, 1, 'Iced Longan', 'DR', '5.00'),
(12, 2, 'Chicken Chop with Carbonara sauce', 'WS', '15.00'),
(13, 2, 'French Fries', 'WS', '6.00'),
(14, 2, 'Fish and Chips', 'WS', '14.00'),
(15, 2, 'Beef Peperoni', 'PZ', '20.00'),
(16, 2, 'Hawaiian Extreme', 'PZ', '21.00'),
(17, 2, 'Seafood Delight', 'PZ', '25.00'),
(18, 2, 'Iced Tea', 'DR', '14.00'),
(19, 2, 'Iced Lemon Tea', 'DR', '5.00'),
(20, 2, 'Canned Drink', 'DR', '3.00'),
(21, 2, 'Carrot Juice', 'DR', '8.00'),
(22, 2, 'Lime Juice ', 'DR', '7.00'),
(23, 2, 'Bottled Drinks', 'DR', '5.50'),
(24, 3, 'Nasi Lemak', 'LC', '7.00'),
(25, 3, 'Laksa', 'LC', '5.00'),
(26, 3, 'Somtam', 'LC', '6.50'),
(27, 3, 'Chicken Burger', 'WS', '10.00'),
(28, 3, 'Tower Burger', 'WS', '15.00'),
(29, 3, 'Buttermilk Chicken', 'WS', '9.00'),
(30, 3, 'Iced Tea', 'DR', '4.00'),
(31, 3, 'Iced Lemon Tea', 'DR', '5.00'),
(32, 3, 'Canned Drink', 'DR', '3.00'),
(33, 3, 'Iced Longan', 'DR', '5.00'),
(34, 3, 'Iced Chocolate', 'DR', '6.00'),
(35, 3, 'Iced Milo', 'DR', '4.00'),
(36, 4, 'Steak', 'WS', '20.00'),
(37, 4, 'Lamb Chop', 'WS', '17.00'),
(38, 4, 'Chicken Chop', 'WS', '15.00'),
(39, 4, 'Fish and Chips', 'WS', '14.60'),
(40, 4, 'Fried Rice', 'LC', '7.00'),
(41, 4, 'Fried Rice with Shrimp', 'LC', '9.00'),
(42, 4, 'Nasi Lemak', 'LC', '6.50'),
(43, 4, 'Iced Tea', 'DR', '4.00'),
(44, 4, 'Iced Lemon Tea', 'DR', '5.00'),
(45, 4, 'Canned Drink', 'DR', '3.00'),
(46, 4, 'Iced Syrup', 'DR', '3.00'),
(47, 4, 'Hot Tea', 'DR', '3.00'),
(48, 4, 'Latte', 'DR', '6.00'),
(49, 4, 'Americano', 'DR', '5.00'),
(51, 2, 'qwtr', 'DR', '1.00'),
(53, 1, 'Nasi Ayam', 'LC', '4.50');

-- --------------------------------------------------------

--
-- Table structure for table `food_reservation`
--

CREATE TABLE `food_reservation` (
  `food_reservation_id` int(255) NOT NULL,
  `reservation_id` varchar(20) NOT NULL,
  `food_id` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `food_type_id` varchar(8) NOT NULL,
  `food_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`food_type_id`, `food_desc`) VALUES
('DR', 'Drinks'),
('LC', 'Local Cuisines'),
('PZ', 'Pizza'),
('WS', 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` varchar(20) NOT NULL,
  `user_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `reserve_date` date NOT NULL,
  `time` time NOT NULL,
  `quantity_person` int(11) NOT NULL,
  `total_pay` decimal(6,2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_owner`
--

CREATE TABLE `restaurant_owner` (
  `owner_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `restaurant_img` varchar(255) NOT NULL,
  `available` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant_owner`
--

INSERT INTO `restaurant_owner` (`owner_id`, `restaurant_name`, `owner_name`, `phone_no`, `owner_email`, `restaurant_img`, `available`) VALUES
(1, 'MIKER', 'Ahmad Farhan bin Osman', '011-11430803', 'ahmadfarhanosman145@gmail.com', 'img-restaurant/miker-food.jpg', 'Open everyday except Monday'),
(2, 'Konda Kondi', 'Ali Bin Abu', '017-56294235', 'Ali7112@gmail.com', 'img-restaurant/konda-kondi.jpg', 'Open everyday except Tuesday'),
(3, 'D\'Bois', 'Amirul bin Putra ', '010-62568456', 'Amirulputra@yahoo.com', 'img-restaurant/dBois.jpg', 'Open everyday except Saturday'),
(4, 'Marmalade', 'Haziq bin Osman', '012-61216512', 'osmanhaziq@gmail.com', 'img-restaurant/marmalade.jpg', 'Open everyday except Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `user_type_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `email`, `phone_num`, `user_type_id`) VALUES
(1, 'Ahmad Farhan bin Osman', 'paan123', 'ahmadfarhanosman145@gmail.com', '011-11430803', 'O'),
(2, 'Ali bin Abu', 'ali123', 'Ali7112@gmail.com', '017-56294235', 'O'),
(3, 'Amirul bin Putra', 'amirul123', 'Amirulputra@yahoo.com', '010-62568456', 'O'),
(4, 'Haziq bin Osman', 'haziq123', 'osmanhaziq@gmail.com', '012-61216512', 'O'),
(5, 'Adel', 'adel123', 'adel@gmail.com', '016-84739378', 'U'),
(6, 'Luqman', 'luqzi123', 'luqzi@gmail.com', '011-5241542', 'U'),
(7, 'Nazrin', 'nazrin123', 'nazrin@gmail.com', '011-5682142', 'U'),
(8, 'Lem', 'lem123', 'lem@gmail.com', '016-5234157', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_reservation`
--
ALTER TABLE `food_reservation`
  ADD PRIMARY KEY (`food_reservation_id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`food_type_id`);

--
-- Indexes for table `restaurant_owner`
--
ALTER TABLE `restaurant_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `food_reservation`
--
ALTER TABLE `food_reservation`
  MODIFY `food_reservation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `restaurant_owner`
--
ALTER TABLE `restaurant_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
