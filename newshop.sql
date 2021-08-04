-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 05:12 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `sold` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID`, `name`, `address`, `phone`, `email`, `user_ID`, `item_ID`, `dept_ID`, `date`, `sold`) VALUES
(3, 'amr', 'dekernis', '01021892298', 'amra065032gmail.com', 27, 1, 10, '2020-03-26 03:00:00', 0),
(11, 'amr', 'dekernis', '01021892298', 'amra06503@gmail.com', 16, 4, 10, '2020-03-27 13:00:00', 0),
(12, 'amr', 'dekernis', '01021892298', 'amra06503@gmail.com', 16, 1, 10, '2020-03-27 18:12:49', 0),
(13, 'amr', 'dekernis', '01021892298', 'amra06503@gmail.com', 16, 1, 10, '2020-03-27 18:16:51', 1),
(14, '', '', '', '', 27, 4, 10, '2020-03-28 04:33:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `name`, `description`, `img`) VALUES
(10, 'Bedroom', 'Bed, chair, pla', '68995_8064_2.jpg'),
(11, 'living room', 'Bed, chair, pla', '72389_95911_1.jpg'),
(12, 'dining room', 'Bed, chair, pla', '4149_26412_3.gif');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `name`, `description`, `price`, `img`, `dept_ID`, `user_ID`, `date`) VALUES
(1, 'Bed', 'Bed, chair, pla', '250', '93602_2.jpg', 10, 16, '2020-03-25 07:29:00'),
(4, 'Chair', 'red, wood', '100', '97839_1.jpg', 10, 27, '2020-03-25 18:58:33'),
(5, 'new', 'new', '546', '85546_3.gif', 10, 27, '2020-03-25 19:48:15'),
(6, 'coach', 'adsgdfgdaf', '800', '14787_26412_3.gif', 12, 16, '2020-03-28 17:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `ID` int(11) NOT NULL,
  `head` varchar(255) CHARACTER SET utf8 NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`ID`, `head`, `caption`, `img`) VALUES
(1, 'Head', 'Caption', '96850_cropped-1920-1080-1031440.jpg'),
(2, 'adfss', 'fadsf', '35971_6.jpg'),
(3, 'Heads', 'Caption', '48015_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `avater` varchar(255) NOT NULL,
  `GroupID` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `password`, `email`, `Date`, `avater`, `GroupID`, `status`) VALUES
(16, 'Amr', '$2y$10$3vYTe5wJ6HfFjb0Fx4sgGeiNB9FjQpCJutxG.ZmWPOcQGhDgTAN8O', 'User5@gmail.com', '2020-03-23 00:39:39', '', 0, 1),
(21, 'Username', '$2y$10$O/XafzoCauY9Lc0GeritZuzB5rZXDJYkArJ1WCsQOFS.ELe9xa9Dm', 'User5@gmail.com', '2020-03-23 04:07:20', '44782_47075236.jpg', 1, 1),
(26, 'admin', '$2y$10$qk36GjpyMz402Kjvtr6HhuOXB.Y2WC/KIBb.2b03fWjisWQjIUW.G', 'admin@gmail.com', '2020-03-24 18:50:28', '', 1, 0),
(27, 'new', '$2y$10$2gkoYpXZiQmRIOvO1srRsuneCSETioKg9ogFB8ZS.XzS7QjGqAt8W', 'new@gmail.com', '2020-03-24 18:54:07', '', 0, 0),
(28, 'adsf', '$2y$10$qgyhQB218RoOG8rnoasl6OF/l9nZHUfhU5M7g0WtJc1jK.Lmhd8Ei', 'User5@gmail.com', '2020-03-27 17:26:46', '', 0, 0),
(29, 'asdfadsfg', '$2y$10$JtbxX97xP8GVdtq/xqpCRe..SrYUkmeLfHwz0Ez8e6jCYwBSHtZD2', '', '2020-03-28 16:59:20', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `item_ID` (`item_ID`),
  ADD KEY `dept_client` (`dept_ID`),
  ADD KEY `client_user` (`user_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dept_ID` (`dept_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `client_user` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `dept_client` FOREIGN KEY (`dept_ID`) REFERENCES `department` (`ID`),
  ADD CONSTRAINT `item_ID` FOREIGN KEY (`item_ID`) REFERENCES `items` (`ID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `dept_ID` FOREIGN KEY (`dept_ID`) REFERENCES `department` (`ID`),
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
