-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 01:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anonymless`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_friends`
--

CREATE TABLE `add_friends` (
  `id` int(11) NOT NULL,
  `send_req` int(11) NOT NULL,
  `receive_req` int(11) NOT NULL,
  `pending` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_friends`
--

INSERT INTO `add_friends` (`id`, `send_req`, `receive_req`, `pending`, `confirmed`) VALUES
(9, 1, 13, 0, 1),
(11, 13, 8, 0, 1),
(12, 25, 1, 0, 1),
(13, 26, 1, 0, 1),
(14, 27, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_info_users`
--

CREATE TABLE `login_info_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_nopad_ci NOT NULL,
  `ip` varchar(255) NOT NULL,
  `connected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_info_users`
--

INSERT INTO `login_info_users` (`id`, `username`, `password`, `email`, `ip`, `connected`) VALUES
(1, 'tataie', '$argon2i$v=19$m=65536,t=4,p=1$ajJMZXY0TEQyQktaRXpJMQ$VkDpvt/jPIwQWmJdoKnl7MF9rRkUQH5ZvSa/RTHjVmA', 'constantin.george1199@gmail.com', '::1', 0),
(8, 'test1212', 'test1212', '', '::1', 0),
(9, 'anaaremere', 'meremere', '', '86.123.94.210', 0),
(13, 'test1313', 'test1313', '', '::1', 0),
(14, 'ovidiu14', 'Ovidiu1413', '', '2a02:2f08:5802:ec00:a418:51ce:eb15:ab8c', 0),
(16, 'test1414', 'test1414', 'test1414@yahoo.com', '::1', 0),
(19, 'testpass', '$argon2i$v=19$m=65536,t=4,p=1$SFpkNEZsYzdrMHBGVU41UQ$3Gs1nVJZDnUKwG35xb0NmwcD9j2xOj4VOJ0ZcD5BUEM', 'testpass@yahoo.com', '::1', 0),
(24, 'testapp', '$argon2i$v=19$m=65536,t=4,p=1$d3ZESEczMW9OMWpyNXRPYw$tGcAN0hZq60iinu36Co0Gq6aw0cFqZD2TZn6e5HEloQ', 'testapp', '', 0),
(25, 'testvideo', '$argon2i$v=19$m=65536,t=4,p=1$SFBUMkJPYy90V005U1pFQg$54j1J/8UJ+fNZGqt5VekGhBj1NXTQkG0FzMsdGqKUB8', 'testvideo@yahoo.com', '::1', 1),
(26, 'testprezentare', '$argon2i$v=19$m=65536,t=4,p=1$cjFQbFRtbFFCeGl3d1hpSA$0rWgpXd9J8F52R3J4Nngqb8PliYCxCILBloXqEkRJz0', 'testprezentare@yahoo.com', '::1', 0),
(27, 'test1010', '$argon2i$v=19$m=65536,t=4,p=1$Y0c5amFwclZ3Y3NBc0EvLg$y6A+8yywlZSfpfjF85HYjxdUdjjkA86L+y4PwSPVcU0', 'test1010@yahoo.com', '::1', 1),
(28, 'testlicenta', '$argon2i$v=19$m=65536,t=4,p=1$ZHBmbHhyTHNqZUhhRENTdA$BKxsnBE6ImIS2AWwD7m1cDBA2Ei3/m2/cGnIuIkCR7g', 'testlicenta@yahoo.com', '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `text_users_msg`
--

CREATE TABLE `text_users_msg` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `msg` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_nopad_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `text_users_msg`
--

INSERT INTO `text_users_msg` (`id`, `sender`, `receiver`, `msg`, `data`) VALUES
(266, 1, 13, 'd3JWQUVablNHRU9CRWV4MWRsS1Ridz09OjrPired9sHCyuoneRaBI5c/', '2021-05-20 10:47:04'),
(267, 1, 8, 'YkhoNUVaWWtiSUxheWFsSGVoKzVEQT09Ojq6KczeUzLkOnnLB8HIwCU7', '2021-05-23 15:17:16'),
(268, 1, 13, 'SFk4dzNzcStzTERvNmN5QnM1UjdKM3pFa0c4a2plRmZuYk40YU5HbnYzaz06OrKZFMfRQAS9D0HCi/vVi/g=', '2021-05-23 15:17:28'),
(269, 19, 13, 'VG1vSnhXYit3SGpaeFlVeitxVndJUT09OjpMRflP6TXL+6bORTXoUqIX', '2021-05-23 17:38:29'),
(277, 25, 1, 'dXlBZHlHdlREL1VLcmE0cGI1ZXppZz09OjruC10kTQMxzEQ+AGZItM05', '2021-05-31 17:54:15'),
(278, 1, 25, 'VHBTL1FIMWcxemN1bjl1andZUkozUT09OjoAlUzI33Ga1RoHsLJmM1rC', '2021-05-31 17:54:23'),
(279, 25, 1, 'KzFaQnphT2xGaEE3cGtINEJkYUp5MFdwQ2JVdHJVRnlVNkdKK1hQSk42bz06OmNZhYQfqcNPaRyLYbDrtJU=', '2021-05-31 17:54:35'),
(280, 1, 25, 'KzhZV2g0czRWQlhRbk52RmoyRityQT09Ojq2ILIDopMM4SCwalhEgpg/', '2021-06-04 00:34:29'),
(281, 1, 26, 'K0F4bUFobWRKVWI2QmpiWGhDYm4rUT09Ojr8NryXYZMXfDoFXYbtQ5M+', '2021-06-04 07:15:39'),
(282, 1, 26, 'cjV6QWZaZ2pWYTcxSHM2SkdnK2Jodz09Ojod5Tv1413yuGb+I7USUwwr', '2021-06-04 07:16:25'),
(283, 1, 26, 'ZnlWelVwQXZSRDdzWTFLUzhyRW9JZz09Ojq7kuFEZwhaMQPbPehR04Bb', '2021-06-04 07:16:27'),
(284, 1, 26, 'MjJUbVUxMzJ2SDY1K1k1bDNoN2xmdz09OjpJ8BfWvnw/BLvs5jKags8q', '2021-06-04 07:16:28'),
(285, 1, 26, 'ZXZGTDNGWjN4cDNrblFyaDdYRzNKUT09Ojp2vd0s7XG17Tb1CgpPZk7B', '2021-06-04 07:16:30'),
(286, 1, 26, 'b09kS1RTc2FpSzFkaHhyUFM5SnlUdz09OjqSV31tHe2whwCpJC3uEfbf', '2021-06-04 07:16:31'),
(287, 1, 26, 'ejVYaDEzM0ZRVmdDdml5K0VYU3lJQT09OjqNME7n8ryxwHeCF0CHE0Qj', '2021-06-04 07:16:35'),
(288, 1, 26, 'SitZczJpcWhvWkg1dER2aUxxajFDdz09OjrEoGyuvBQzMTv5XNaWCoEx', '2021-06-04 07:16:36'),
(289, 1, 26, 'ODJFMGdEdkZQU0NYS2g3UUtBTnRZQT09Ojq/hRUJaK1KW6VmIVbhyy7R', '2021-06-04 07:16:37'),
(290, 1, 27, 'eXhHQ2MwMy9oQm9UVnQ3THpYQ21QZz09OjoLdrFFd6Vr1MYcaegRLG6n', '2021-06-04 07:22:05'),
(292, 1, 26, 'b0twRDI0Q3U3MGNrZm5VakhibTg1dz09Ojr9wH2cGzFcIe4HhNnODjeb', '2021-06-12 00:07:39'),
(293, 27, 1, 'S0JjK1dSN3hZNzFKMXExYzg4TDFsUT09Ojrr3tvzJGTy7qWZQ6onxLSS', '2021-06-12 02:17:47'),
(294, 27, 1, 'SnZiREUwZFlSQUNUb0RZdEk4c1VRZz09Ojo/NH1akakIQpO4A0R3NHOV', '2021-06-12 02:17:56'),
(295, 1, 26, 'SjFNZG1zNFl5aTFpb3pDbU9DN2lJdC9xQ0puTzYxZ1phbW5MQjZKdU9GVGl6bGJxQWxKVWZnMFBORzhkT1BsL3VIS0FVUGtGSFFUVENBam1iamNCK3c9PTo6/Oh/QU1AT3nOOHQSnMLpzA==', '2021-06-12 02:28:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_friends`
--
ALTER TABLE `add_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_req` (`send_req`) USING BTREE,
  ADD KEY `receive_req` (`receive_req`);

--
-- Indexes for table `login_info_users`
--
ALTER TABLE `login_info_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `text_users_msg`
--
ALTER TABLE `text_users_msg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_friends`
--
ALTER TABLE `add_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_info_users`
--
ALTER TABLE `login_info_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `text_users_msg`
--
ALTER TABLE `text_users_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_friends`
--
ALTER TABLE `add_friends`
  ADD CONSTRAINT `add_friends_ibfk_1` FOREIGN KEY (`send_req`) REFERENCES `login_info_users` (`id`),
  ADD CONSTRAINT `add_friends_ibfk_2` FOREIGN KEY (`receive_req`) REFERENCES `login_info_users` (`id`);

--
-- Constraints for table `text_users_msg`
--
ALTER TABLE `text_users_msg`
  ADD CONSTRAINT `text_users_msg_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `login_info_users` (`id`),
  ADD CONSTRAINT `text_users_msg_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `login_info_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
