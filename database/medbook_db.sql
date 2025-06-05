-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 04:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medbook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_tb`
--

CREATE TABLE `booking_tb` (
  `booking_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `attendees` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `notes` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_tb`
--

CREATE TABLE `room_tb` (
  `room_id` int(10) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_status` enum('available','maintenance','ีืunavailable') NOT NULL,
  `description` text NOT NULL,
  `capacity` int(10) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `line_id` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `role` enum('user','academic','admin','moderator') NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `username`, `email`, `password`, `tel`, `line_id`, `gender`, `role`, `is_verified`, `created_at`) VALUES
(6, 'rootd', 'admin@gmail.com', '$2y$10$8cuRSHrFfWqSx374ofUCNu.dbPzMfPSkID401HK35b9UmY42ZKmWK', '08069452456', 'FarisGay', 'Male', 'user', 0, '2025-05-23 05:03:11'),
(7, 'oshi', 'oshi@gmail.com', '$2y$10$cq6nq0.M8ue50gQgvzY4MOH4A8HP.I0Izpb88A3JLYS6shUesM.Tu', '08069452456', 'FarisGay', 'Female', 'academic', 0, '2025-05-23 05:53:17'),
(8, 'Dummy', 'dummy@gmail.com', '$2y$10$NXsUIZnQnuiDi2gXwkeC8.gB2AcsURzX1UgeQGTLpFvRcnsDsn2bi', '02020202', 'FarisIsGay', 'Male', 'admin', 0, '2025-06-01 14:47:06'),
(10, 'Normal User', 'user@gmail.com', '$2y$10$ZPAuqwcYI92gg89SL018puFYQbB5LlONnFYIFXFhtUcpZQu.EtSPO', '02020202', 'FarisGay', 'Male', 'user', 0, '2025-06-02 14:17:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room_tb`
--
ALTER TABLE `room_tb`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_tb`
--
ALTER TABLE `room_tb`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
