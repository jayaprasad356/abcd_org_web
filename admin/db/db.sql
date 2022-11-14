-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2019 at 11:30 AM
-- Server version: 5.7.25
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offsette_spincash`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'info@offsettech.com', 'www.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `report` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `redeem_points` int(11) NOT NULL,
  `redeem_money` float(11,2) NOT NULL,
  `redeem_currency` varchar(255) NOT NULL,
  `minimum_redeem_points` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `publisher_id` text NOT NULL,
  `interstital_ad` text NOT NULL,
  `registration_reward` int(255) NOT NULL,
  `app_refer_reward` int(255) NOT NULL,
  `video_add_point` int(11) NOT NULL,
  `interstital_ad_id` text NOT NULL,
  `interstital_ad_click` varchar(255) NOT NULL,
  `banner_ad` text NOT NULL,
  `banner_ad_id` text NOT NULL,
  `rewarded_video_ads` varchar(255) NOT NULL,
  `rewarded_video_ads_id` varchar(255) NOT NULL,
  `daily_rewarded_video_ads_limits` varchar(15) NOT NULL,
  `app_faq` text NOT NULL,
  `payment_method1` varchar(255) NOT NULL,
  `payment_method2` varchar(255) NOT NULL,
  `payment_method3` varchar(255) NOT NULL,
  `payment_method4` varchar(255) NOT NULL,
  `daily_spin_limit` int(15) NOT NULL,
  `ads_frequency_limit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `email_from`, `redeem_points`, `redeem_money`, `redeem_currency`, `minimum_redeem_points`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `publisher_id`, `interstital_ad`, `registration_reward`, `app_refer_reward`, `video_add_point`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `rewarded_video_ads`, `rewarded_video_ads_id`, `daily_rewarded_video_ads_limits`, `app_faq`, `payment_method1`, `payment_method2`, `payment_method3`, `payment_method4`, `daily_spin_limit`, `ads_frequency_limit`) VALUES
(1, 'support@offsettech.com', 1000, 1.00, '$', 1000, 'Spin Coin', 'ic_launcher.png', 'info@offsettech.com', '1.0.0', 'Sapin Cash', '+8801718262530', 'offsettech.com', '<p>About your Aps</p>\r\n', 'Offset Tech', '<p><strong>We are committed to protecting your privacy</strong></p>\n\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\n\n<p><strong>Information Collected</strong></p>\n\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\n\n<p><strong>Information Use</strong></p>\n\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\n\n<p><strong>Cookies</strong></p>\n\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\n\n<p><strong>Disclosing Information</strong></p>\n\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\n\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\n\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\n\n<p><strong>Changes to this Policy</strong></p>\n\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\n\n<p><strong>Contacting Us</strong></p>\n\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\n', 'pub-9456493320432553', 'true', 100, 100, 50, 'ca-app-pub-3940256099942544/1033173712', '', 'true', 'ca-app-pub-3940256099942544/6300978111', 'true', 'ca-app-pub-3940256099942544/5224354917', '10', '', 'PayPal', 'PayTm', 'Bank Details', 'Other', 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spin_count`
--

CREATE TABLE `tbl_spin_count` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `device_id` varchar(25) NOT NULL,
  `daily_spin_count` int(55) NOT NULL,
  `daily_bid_count` int(55) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `tbl_support_ticket`
--

CREATE TABLE `tbl_support_ticket` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_deviceid` varchar(255) DEFAULT NULL,
  `user_code` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `refer_code` varchar(255) DEFAULT NULL,
  `total_point` int(11) NOT NULL DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reg_ip` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `tbl_users_rewards_activity`
--

CREATE TABLE `tbl_users_rewards_activity` (
  `id` int(10) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `points` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `device_id` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `point_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tbl_user_login_logs`
--

CREATE TABLE `tbl_user_login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_deviceid` varchar(250) NOT NULL,
  `user_ip` varchar(250) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logs_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `tbl_video_ads_count`
--

CREATE TABLE `tbl_video_ads_count` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `daily_vads_count` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `tbl_withdraw_request`
--

CREATE TABLE `tbl_withdraw_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(200) NOT NULL,
  `user_points` int(11) NOT NULL,
  `redeem_price` float(11,2) NOT NULL,
  `payment_mode` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `payment_details` text CHARACTER SET latin1 NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_spin_count`
--
ALTER TABLE `tbl_spin_count`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_support_ticket`
--
ALTER TABLE `tbl_support_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users_rewards_activity`
--
ALTER TABLE `tbl_users_rewards_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_login_logs`
--
ALTER TABLE `tbl_user_login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video_ads_count`
--
ALTER TABLE `tbl_video_ads_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdraw_request`
--
ALTER TABLE `tbl_withdraw_request`
  ADD PRIMARY KEY (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
