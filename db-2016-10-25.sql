-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2016 at 02:01 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cl_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin1@gmail.com', '$2y$10$7.isNFh03J6UEm.SO5cg7OL79H6j3zcwrSI7A02h7yirfqpwtyC8u'),
(2, 'admin2@gmail.com', '$2y$10$lGaL.JxPjbMSsP1AY5usZuA3U1Prm8owvyORW5jGaOtINmRBBqoEa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 1),
(4, 2, 1),
(5, 1, 2),
(6, 2, 2),
(7, 1, 1),
(8, 2, 1),
(9, 1, 1),
(10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `product_quantity`, `product_price`) VALUES
(1, 1, 1, 2, '19.00'),
(2, 1, 3, 7, '70.00'),
(3, 2, 4, 1, '289.00'),
(4, 3, 3, 2, '48.00'),
(5, 3, 2, 3, '48.00'),
(6, 3, 5, 1, '88.00'),
(7, 4, 4, 1, '56.00'),
(8, 4, 1, 1, '48.00'),
(9, 5, 1, 1, '48.00'),
(10, 6, 1, 1, '48.00'),
(11, 6, 2, 1, '48.00'),
(12, 6, 5, 1, '48.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'złożone'),
(2, 'zapłacone'),
(3, 'wysłane'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `stock`) VALUES
(1, 'Fire hat', '20.00', 'A hat to keep you warm, but not too warm.', 20),
(2, 'Water gloves', '30.99', 'Gloves to keep those fingers dry.', 20),
(3, 'Metal shoes', '79.99', 'Protect those toes on the construction site, ', 20),
(4, 'Rock watch', '300.00', 'These aren\'t diamonds, they\'re just regular r', 20),
(5, 'Earth belt', '50.00', 'Keep those pants up.', 20);

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `photo`) VALUES
(1, 1, 'fire_hat1.jpg'),
(2, 1, 'fire_hat2.png'),
(3, 1, 'fire_hat3.jpg'),
(4, 1, 'fire_hat4.jpg'),
(5, 2, 'water_gloves1.jpg'),
(6, 3, 'metal_shoes1.jpg'),
(7, 4, 'rock_watch1.jpg'),
(8, 5, 'earth_belt1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `address`) VALUES
(1, 'Greg', 'Murphy', 'slakin@hotmail.com', '$2y$10$QAHnTCPzeR5sPH8MgK8j8edzgF7agUbqYxuvwriC1BggRHjIJ1Gq2', '4216 Lowe Ranch Lake Brennan, LA 87248'),
(2, 'Georgiana', 'Prohaska', 'mbechtelar@gmail.com', '$2y$10$isITfoQTaAWgRG5EGFUiCekkUsk/Vhv00Nx5elVkHwqYr2spjK8SC', '78367 Zieme Parkway Apt. 924 Padbergton, DC 67084'),
(3, 'Kurtis', 'Fritsch', 'hillary.ratke@hotmail.com', '$2y$10$A1bkAp2kxktfcSasxEtQVuirgArpoF1u3jHW30faVbDipiDcV/Z3y', '28366 Kellen Mountain Apt. 719 Heathcoteborough, ID 07539-4608'),
(4, 'Esperanza', 'Cole', 'hauck.vaughn@gmail.com', '$2y$10$FRT82DSR1SmJGG0G2YSr/.hkA7mql3sIYrAXiG81U4x7iijP3H7.m', '213 Imani Parks Apt. 139 Prohaskaberg, OR 53516-9533'),
(5, 'Brant', 'Monahan', 'ykshlerin@hotmail.com', '$2y$10$9olblUsxrWWyVCrLpUUC6.VHe.TjMOuMJqkYJyFdpgWkdq/El2PGW', '799 Ullrich Islands South Elliott, NE 06475'),
(6, 'Noemi', 'Grimes', 'beatty.nichole@hotmail.com', '$2y$10$neLxCaEmEzoZqFUiWmoHdepYRc21jm3E.BVnTlUGv9IqWi8cDh23G', '5388 Euna Glen Suite 795 West Nathanieltown, NM 86767-4364'),
(7, 'Tyrell', 'Nicolas', 'metz.lupe@gmail.com', '$2y$10$wYU4991uYz1qMzdiSd23iuLqgrYKVndzl9sudQXGujy0PfAkv6/H.', '88495 Lehner Lock Suite 401 North Kylietown, VT 74617-5979'),
(8, 'Marlee', 'Kertzmann', 'drohan@gmail.com', '$2y$10$uoOQsE0ggBP7IMRhggvKaOy92ngC234.hQwK7fjjjA4KvFQXaaxVy', '53370 Natasha Trafficway Suite 425 East Nina, OK 56164-4501'),
(9, 'Ulices', 'Corkery', 'labadie.dawson@gmail.com', '$2y$10$1Hh2k/UHhwu6f3hZm5Md/uj7c1sbssXgFncgnXqqRHum891c3cyri', '86027 Weber Valleys Apt. 594 Beerland, SC 98462'),
(10, 'Reanna', 'Herman', 'virginia.hammes@hotmail.com', '$2y$10$QEzgaalXg5XyJImxipDtc.4Rm88j9Yxs1N3wbqLwbRkkjRfnlOW0.', '557 Stanton Garden Eleanoreton, MN 29591-6224'),
(11, 'Rey', 'Wunsch', 'neil21@gmail.com', '$2y$10$i.ymUtRFRsHa4r0X.MZyjuaIGRfpybrPt2FYLEaXBDG8zRbg.JNfa', '1041 Bode Trafficway Apt. 685 Port Prudencefurt, ID 74259'),
(12, 'Gerry', 'Hodkiewicz', 'hmertz@yahoo.com', '$2y$10$7Pb74LCEx1aHu.HBo0E7ru3wD0jldENxhBDZoawEIeMpvu49w5qQC', '97788 Walker Harbors Swifthaven, WY 26847-0537'),
(13, 'Guiseppe', 'Lebsack', 'crona.tito@hotmail.com', '$2y$10$4OT8mi3.cgV1TytkYxmYNuYOewhe/cZW7z63HP.VplL5SsSCBcxL6', '338 Aleen Spring Wymanmouth, NV 75320-3014'),
(14, 'Aisha', 'Stark', 'bayer.liza@gmail.com', '$2y$10$Jch4VOOg.HV8Yn1S071xJOa29eLl/e7gwnvjZftzzn5Brn2gF.dte', '881 Oceane Way Suite 197 Port Easton, UT 66848'),
(15, 'Orlo', 'Wilkinson', 'victoria73@hotmail.com', '$2y$10$TpicSYmrszDDNEvz4qbDDOICIraYlKSUxM/jdGm4kZQrgvfuyhgPO', '645 Gudrun Plain Apt. 658 Jacobsonfort, AL 14028-7759'),
(16, 'Arlie', 'Kreiger', 'maida42@hotmail.com', '$2y$10$y3rNV/Wvpt1TxDkq7TeE1ui6SSv5JJ4E57g7gd9nFLN5jDSLERc8e', '31867 Garett Motorway Port Tavares, ME 73667'),
(17, 'Kamron', 'Metz', 'jace.reinger@yahoo.com', '$2y$10$1IlWrHsVa7u3LWt7RVaXUuDikbrgMUwvgfX8uT0xHzrz695mHGbeS', '7549 Elisa Estate Apt. 054 Garfieldview, MI 11265-0592'),
(18, 'Mozelle', 'Dach', 'von.jaylon@hotmail.com', '$2y$10$c1znwVgQfvkPvaol0PEMsOMS3R5LoGvgt9Grn32l1In5KPG6ZkAMi', '23287 Kshlerin Via Vitoport, WY 05915-1977'),
(19, 'Adam', 'Corkery', 'haley.christ@gmail.com', '$2y$10$U0I0KyWAaNzyYzJw7cSh7uXtP/kQNwr2C.wEGVJfm2ET5s9texmzu', '90806 Kirlin Corner Streichfurt, IL 45980-9526'),
(20, 'Juliana', 'Trantow', 'becker.travis@hotmail.com', '$2y$10$uZ53Fb.y/3g0VLmy/Lk3e.WSiv9TksRyNIOW1twthE2feuKpg17iq', '7717 Sawayn Viaduct South Magnolia, IN 67907'),
(21, 'John', 'Doe', 'jdoe@gmail.com', '$2y$10$HpcSkEyaMOK93duCme1Sg.vZYNrnW8gu3ZnJjvLXuIlfmI42m.1v2', 'llksdahf;skadfhjas;lkdfjas;ljkf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `status_id_2` (`status_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id_2` (`order_id`),
  ADD KEY `order_id_3` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idx` (`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD CONSTRAINT `id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
