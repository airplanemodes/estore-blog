-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2021 at 03:19 PM
-- Server version: 10.5.9-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hipo`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `info` varchar(512) NOT NULL,
  `price` double NOT NULL,
  `img_url` varchar(512) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `info`, `price`, `img_url`, `date_created`, `user_id`) VALUES
(1, 'Playstation 3', 'The best', 400, 'abcd', '2021-07-04 08:36:53', 9),
(2, 'iPhone 4', 'The game changer', 20, '', '2021-07-04 10:24:53', 9),
(8, 'Tamagochi', 'First e-toy', 5, '', '2021-07-04 14:04:18', 9),
(10, 'iPhone 4', 'The game changing smartphone', 20, '', '2021-07-06 06:39:41', 8),
(11, 'Tea', 'Green tea', 4, 'https://cdn.pixabay.com/photo/2016/11/30/06/52/tea-cup-1872026_1280.jpg', '2021-07-06 09:51:04', 14),
(12, 'Coffee', 'Capuccino', 3, 'https://cdn.pixabay.com/photo/2015/10/12/14/54/coffee-983955_1280.jpg', '2021-07-06 09:51:40', 14),
(13, 'Waffles', 'With ice cream', 8, 'https://cdn.pixabay.com/photo/2016/03/22/14/26/waffles-1272950_1280.jpg', '2021-07-06 09:52:35', 14),
(14, 'Falafel', 'Middle-east kitchen', 3, 'https://cdn.pixabay.com/photo/2019/10/12/15/39/falafel-4544137_1280.jpg', '2021-07-06 09:53:53', 14),
(15, 'Yogurt', 'For a perfect breakfast', 4, 'https://cdn.pixabay.com/photo/2021/01/10/08/04/desserts-5904329_1280.jpg', '2021-07-07 04:11:12', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
