-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql303.epizy.com
-- Generation Time: Apr 28, 2023 at 03:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_33342181_db_floodify`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `verified_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `creation_date` datetime(6) NOT NULL,
  `date_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `verified_id`, `last_name`, `first_name`, `middle_name`, `creation_date`, `date_updated`) VALUES
(2, 2, 'Website', 'Floodify', 'F', '2023-02-16 01:45:59.000000', '2023-04-03 13:29:01.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_verify`
--

CREATE TABLE `tbl_admin_verify` (
  `verified_id` int(11) NOT NULL,
  `verified_email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `verification_code` varchar(150) NOT NULL,
  `verification_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_verify`
--

INSERT INTO `tbl_admin_verify` (`verified_id`, `verified_email`, `password`, `verification_code`, `verification_date`) VALUES
(2, 'floodify.webapp@gmail.com', '$2y$10$2PeRXwtC62ZDWOIYEFJJyeEQgZsuKvg3Ov5aUVwyqe81JUf4PLsgW', '323474', '2023-03-30 12:37:22.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_floodmap`
--

CREATE TABLE `tbl_floodmap` (
  `flood_map_id` int(11) NOT NULL,
  `flood_map_img` varchar(150) NOT NULL,
  `flood_map_title` varchar(150) NOT NULL,
  `flood_map_details` varchar(1000) NOT NULL,
  `creation_date` datetime(6) NOT NULL,
  `date_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_floodmap`
--

INSERT INTO `tbl_floodmap` (`flood_map_id`, `flood_map_img`, `flood_map_title`, `flood_map_details`, `creation_date`, `date_updated`) VALUES
(26, '6414823a6eeb34.84648132.png', 'Malabon City Flood Map', '<p>Malabon City Flood Map for User&#39;s Guide</p>', '2023-03-16 23:24:38.000000', '2023-03-17 23:07:38.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flood_risk_info`
--

CREATE TABLE `tbl_flood_risk_info` (
  `flood_risk_id` int(11) NOT NULL,
  `flood_risk_title` varchar(150) NOT NULL,
  `flood_risk_content` varchar(1000) NOT NULL,
  `creation_date` datetime(6) NOT NULL,
  `date_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_flood_risk_info`
--

INSERT INTO `tbl_flood_risk_info` (`flood_risk_id`, `flood_risk_title`, `flood_risk_content`, `creation_date`, `date_updated`) VALUES
(6, 'What To Do During Flood', '<ul><li>Be prepared to evacuate immediately when there&rsquo;s an alert for heavy rainfall.</li><li>Refrain from walking through floodwater most especially without wearing protective gear like boots.</li><li>Don&rsquo;t walk or drive through moving water.</li></ul>', '2023-03-02 18:05:33.000000', '2023-03-20 11:23:47.000000'),
(7, 'Survival Kit', '<ul><li>Water: one gallon per person</li><li>Food: non-perishable, easy-to-prepare items</li><li>Flashlight</li><li>First-Aid Kit</li><li>Medications and medical items</li><li>Sanitation and personal hygiene</li><li>Copies of personal documents (IDs, proof of address, passports, insurance policies, birth certificates)</li><li>Cellphone with chargers</li><li>Family and emergency contact information</li><li>Extra cash</li><li>Emergency blanket(s)</li></ul>', '2023-03-02 18:05:45.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_live_chat`
--

CREATE TABLE `tbl_live_chat` (
  `message_id` int(11) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `timestamp` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_live_chat`
--

INSERT INTO `tbl_live_chat` (`message_id`, `barangay`, `user_name`, `message`, `timestamp`) VALUES
(124, 'Santolan', 'Covie', 'Sample Concern', '2023-03-30 15:30:45.000000'),
(125, 'Malabon', 'MDRRMO Admin', 'Sample Respond to Concerns', '2023-04-01 10:48:14.000000'),
(126, 'Maysilo', 'Mark', 'Wala po', '2023-04-11 10:57:59.000000'),
(127, 'Dampalit', 'mischel', 'mabaho', '2023-04-20 13:29:15.000000'),
(128, 'Hulong Duhat', 'Czybrixe', 'baha', '2023-04-20 13:31:42.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requestdata`
--

CREATE TABLE `tbl_requestdata` (
  `request_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_ip_address` varchar(150) NOT NULL,
  `date_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requestdata`
--

INSERT INTO `tbl_requestdata` (`request_id`, `user_name`, `user_ip_address`, `date_updated`) VALUES
(12, 'resident', '112.201.245.213', '2023-03-16 23:22:20.000000'),
(13, 'resident', '124.105.185.67', '2023-03-17 11:08:32.000000'),
(14, 'resident', '180.191.198.76', '2023-03-17 15:17:28.000000'),
(15, 'resident', '112.201.245.213', '2023-03-17 23:05:25.000000'),
(16, 'resident', '110.235.183.86', '2023-03-19 13:25:40.000000'),
(17, 'resident', '122.3.204.186', '2023-03-20 11:28:27.000000'),
(18, 'resident', '112.198.97.47', '2023-03-20 11:36:50.000000'),
(19, 'resident', '112.198.97.47', '2023-03-20 14:36:44.000000'),
(20, 'resident', '124.105.185.67', '2023-03-20 14:51:33.000000'),
(21, 'resident', '120.28.137.1', '2023-04-11 10:55:44.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weather_info`
--

CREATE TABLE `tbl_weather_info` (
  `weather_info_id` int(11) NOT NULL,
  `location_name` varchar(150) NOT NULL,
  `temperature` varchar(150) NOT NULL,
  `wind` varchar(150) NOT NULL,
  `humidity` varchar(150) NOT NULL,
  `precipitation` varchar(150) NOT NULL,
  `weather_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_weather_info`
--

INSERT INTO `tbl_weather_info` (`weather_info_id`, `location_name`, `temperature`, `wind`, `humidity`, `precipitation`, `weather_date`) VALUES
(15, 'Malabon, PH', '24.55 Â°C', '1.91m/s', '78%', '  mm/hr', '2023-03-16 23:42:13'),
(22, 'Malabon, PH', '30.76 Â°C', '1.3m/s', '59%', '  mm/hr', '2023-03-25 09:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_website_info`
--

CREATE TABLE `tbl_website_info` (
  `website_info_id` int(11) NOT NULL,
  `website_name` varchar(150) NOT NULL,
  `website_tell_num` varchar(150) NOT NULL,
  `website_cell_num` varchar(150) NOT NULL,
  `website_fb_page` varchar(150) NOT NULL,
  `website_email` varchar(150) NOT NULL,
  `creation_date` datetime(6) NOT NULL,
  `date_updated` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_website_info`
--

INSERT INTO `tbl_website_info` (`website_info_id`, `website_name`, `website_tell_num`, `website_cell_num`, `website_fb_page`, `website_email`, `creation_date`, `date_updated`) VALUES
(2, 'Floodify', '+123-4567-890', '+639234567890', 'https://www.facebook.com/MalabonCityDRRMO', 'floodify.webapp@gmail.com', '2023-02-27 21:26:17.000000', '2023-03-17 09:41:50.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_verified_id_fk` (`verified_id`);

--
-- Indexes for table `tbl_admin_verify`
--
ALTER TABLE `tbl_admin_verify`
  ADD PRIMARY KEY (`verified_id`);

--
-- Indexes for table `tbl_floodmap`
--
ALTER TABLE `tbl_floodmap`
  ADD PRIMARY KEY (`flood_map_id`);

--
-- Indexes for table `tbl_flood_risk_info`
--
ALTER TABLE `tbl_flood_risk_info`
  ADD PRIMARY KEY (`flood_risk_id`);

--
-- Indexes for table `tbl_live_chat`
--
ALTER TABLE `tbl_live_chat`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_requestdata`
--
ALTER TABLE `tbl_requestdata`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_weather_info`
--
ALTER TABLE `tbl_weather_info`
  ADD PRIMARY KEY (`weather_info_id`);

--
-- Indexes for table `tbl_website_info`
--
ALTER TABLE `tbl_website_info`
  ADD PRIMARY KEY (`website_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_admin_verify`
--
ALTER TABLE `tbl_admin_verify`
  MODIFY `verified_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_floodmap`
--
ALTER TABLE `tbl_floodmap`
  MODIFY `flood_map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_flood_risk_info`
--
ALTER TABLE `tbl_flood_risk_info`
  MODIFY `flood_risk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_live_chat`
--
ALTER TABLE `tbl_live_chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `tbl_requestdata`
--
ALTER TABLE `tbl_requestdata`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_weather_info`
--
ALTER TABLE `tbl_weather_info`
  MODIFY `weather_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_website_info`
--
ALTER TABLE `tbl_website_info`
  MODIFY `website_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `admin_verified_id_fk` FOREIGN KEY (`verified_id`) REFERENCES `tbl_admin_verify` (`verified_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
