-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 05:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shelter_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 NOT NULL,
  `date` varchar(32) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `owner_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `title`, `description`, `image`, `date`, `user_ID`, `owner_ID`) VALUES
(2, 'Larry the Cockatoo', 'Meet Larry the Cockatoo! He is very noisy.', 'https://lafeber.com/vet/wp-content/uploads/cockatoo-moluccan.jpg', '5/7/2021', 2, 16),
(3, 'Jinx', 'Jinx is a great Husky!', 'https://www.ddfl.org/wp-content/uploads/2019/06/husky.png', '5/8/2021', 15, 2),
(4, 'Alex the Honking Bird', 'This is Alex, a cockatiel who honks regularly.', 'https://pbs.twimg.com/media/EzVubHPVIAgcSq2.jpg', '5/8/2021', 16, NULL),
(5, 'Rex', 'Rex is a weird looking dog. Despite his big teeth, he\'s very friendly.', 'https://i.guim.co.uk/img/media/5dab212de07d8009dd06560efeb1ac87b114e23d/0_640_4183_2510/master/4183.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=7c9461c31fb8530f24343e669d6730ba', '5/8/2021', 16, NULL),
(6, 'Tuna the Dog', 'A very good boy with a fancy hat.', 'https://i.pinimg.com/originals/be/20/b2/be20b2d2e9fb30d36a5cf44589db5147.jpg', '5/8/2021', 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `password`, `firstname`, `lastname`, `is_admin`) VALUES
(2, 'ethan@ethan', '$2y$10$33QyK/4UG1707aek.VViZORApG9t1xDQKZ5795nMEkUzwGHiYSnxK', 'Ethan', 'Gil', 1),
(15, 'admin@admin', '$2y$10$TWm75Io2sYozhd/wqU/hTeDYT31XkiySfvJ6pbXgcasj3NE.q8B2W', 'AdminFirst', 'AdminLast', 1),
(16, 'gile1@nku.edu', '$2y$10$lnkkX59D1IK3YLNU4vvnfuqOxcJjeEbpnPkj30moCUzWNSlJFoQLi', 'Ethan', 'Gil', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
