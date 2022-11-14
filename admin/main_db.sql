-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2020 at 08:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `uid` varchar(80) NOT NULL,
  `newsCoins` varchar(10) NOT NULL,
  `quizCoins` varchar(10) NOT NULL,
  `quizMath` varchar(10) NOT NULL,
  `taskCoins` varchar(10) NOT NULL,
  `redeemMin` varchar(10) NOT NULL,
  `fbReward1` varchar(10) NOT NULL,
  `fbReward2` varchar(10) NOT NULL,
  `rewardAdCoins` varchar(10) NOT NULL,
  `newsAPI` varchar(80) NOT NULL,
  `bannerId` varchar(50) NOT NULL,
  `taskReward` varchar(20) NOT NULL,
  `fbIntersId` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`uid`, `newsCoins`, `quizCoins`, `quizMath`, `taskCoins`, `redeemMin`, `fbReward1`, `fbReward2`, `rewardAdCoins`, `newsAPI`, `bannerId`, `taskReward`, `fbIntersId`) VALUES
('24646', '1', '1', '1', '1', '1000', 'ca-app', 'ca-app', '1', '03810b68d69d4f7ebc1c71cf9270933d', 'ca-app', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `uid` varchar(80) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `coins` varchar(30) NOT NULL,
  `spins` varchar(20) NOT NULL,
  `referCode` varchar(30) NOT NULL,
  `isRefered` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `allow` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`uid`, `name`, `email`, `password`, `coins`, `spins`, `referCode`, `isRefered`, `phone`, `allow`) VALUES
('4MqC4qKVUlbPHQzMkbsgyMFL7fy2', 'Marsad Ch', 'marsadmaqsood149@gmail.com', 'marsad', '0', '2', 'marsadmaqsood149', 'false', '1036961807', 'true'),
('C5tIXqScoGMcaeGBTF9K7Dqgpv42', 'Marsad Ch', 'marsadmaqsood149@gmail.com', 'marsad', '0', '2', 'marsadmaqsood149', 'false', '1036961807', 'true'),
('RJdvZeYEGaWD6QWfq5Nu2Mc4quo1', 'Marsad Ch', 'marsadmaqsood149@gmail.com', 'marsad', '0', '2', 'marsadmaqsood149', 'false', '1036961807', 'true'),
('SXXTmGJ4HKRm1aCNDf0lPNS7rEt2', 'Marsad', 'marsadmaqsood149@gmail.com', 'marsad', '50000', '2', 'marsadmaqsood149', 'false', '1036961807', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_table`
--

CREATE TABLE `withdraw_table` (
  `uid` varchar(80) NOT NULL,
  `id` int(80) NOT NULL,
  `paytmNumber` varchar(20) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_table`
--

INSERT INTO `withdraw_table` (`uid`, `id`, `paytmNumber`, `amount`) VALUES
('SXXTmGJ4HKRm1aCNDf0lPNS7rEt2', 1, '51548484', '78'),
('SXXTmGJ4HKRm1aCNDf0lPNS7rEt2', 2, '51548484', '78');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `withdraw_table`
--
ALTER TABLE `withdraw_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `withdraw_table`
--
ALTER TABLE `withdraw_table`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
