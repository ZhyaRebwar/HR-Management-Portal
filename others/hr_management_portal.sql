-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 12:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_management_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(14, 'zhya', 'zhya@gmail.com', 'zhya123', '2023-08-08 07:40:45'),
(19, 'sha', 'sha@gmail.com', 'sha13', '2023-08-08 08:29:22'),
(34, 'frya', 'frya@gmail.com', 'frya12345', '2023-08-14 16:54:52'),
(36, 'messi', 'messi@gmail.com', 'messi1234', '2023-08-14 16:57:47'),
(37, 'rawezh', 'rawezh@gmail.com', 'rawezh12345', '2023-08-15 10:15:03'),
(39, 'jack', 'jack@gmail.com', 'jack1345', '2023-08-16 13:41:09'),
(42, 'marco', 'marco@gmail.com', 'marco543', '2023-08-19 18:39:51'),
(43, 'gino', 'gino@gmail.com', 'gino1234', '2023-08-19 18:41:10'),
(44, 'fred', 'fred@gmail.com', 'fred1234', '2023-08-19 18:41:57'),
(45, 'alfi', 'alfi@gmail.com', 'alfi123', '2023-08-20 04:36:29'),
(48, 'bako', 'bako@gmail.com', 'bako123', '2023-08-21 01:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `employees_information`
--

CREATE TABLE `employees_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(256) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `relationship` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_information`
--

INSERT INTO `employees_information` (`id`, `first_name`, `last_name`, `phone_number`, `date_of_birth`, `city`, `relationship`) VALUES
(19, 'sha', 'rebwar', NULL, NULL, NULL, NULL),
(36, 'Lionel', 'messi', NULL, NULL, NULL, NULL),
(37, 'rawezh', 'mohammed', NULL, NULL, NULL, NULL),
(39, 'jack', 'sparrow', NULL, NULL, NULL, NULL),
(42, 'marco', 'polo', NULL, NULL, NULL, NULL),
(43, 'gino', 'da', NULL, NULL, NULL, NULL),
(44, 'fred', 'salazar', NULL, NULL, NULL, NULL),
(45, 'alfi', 'solomon', NULL, NULL, NULL, NULL),
(48, 'bako', 'tea', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_benefits`
--

CREATE TABLE `employee_benefits` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `salary` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `appointed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_benefits`
--

INSERT INTO `employee_benefits` (`id`, `title`, `salary`, `bonus`, `appointed_at`) VALUES
(34, 'Administrator', 5222, 0, '2023-08-14 16:54:52'),
(36, 'administrator', 1555, 0, '2023-08-14 16:57:47'),
(37, 'employee', 2345, 0, '2023-08-15 10:15:03'),
(39, 'hr', 333, 0, '2023-08-16 13:41:09'),
(42, 'supervisor', 3353, 0, '2023-08-19 18:39:51'),
(43, 'employee', 53, 0, '2023-08-19 18:41:10'),
(44, 'employee', 539, 0, '2023-08-19 18:41:57'),
(45, 'administrator', 9539, 0, '2023-08-20 04:36:29'),
(48, 'hr', 4539, 0, '2023-08-21 01:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `employee_management`
--

CREATE TABLE `employee_management` (
  `manager_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_management`
--

INSERT INTO `employee_management` (`manager_id`, `employee_id`) VALUES
(42, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hr_management_portal_username` (`username`),
  ADD UNIQUE KEY `hr_management_portal_email` (`email`);

--
-- Indexes for table `employees_information`
--
ALTER TABLE `employees_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `employee_benefits`
--
ALTER TABLE `employee_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_management`
--
ALTER TABLE `employee_management`
  ADD PRIMARY KEY (`manager_id`,`employee_id`),
  ADD UNIQUE KEY `manager_id` (`manager_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees_information`
--
ALTER TABLE `employees_information`
  ADD CONSTRAINT `employees_information_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_benefits`
--
ALTER TABLE `employee_benefits`
  ADD CONSTRAINT `employee_benefits_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_management`
--
ALTER TABLE `employee_management`
  ADD CONSTRAINT `employee_management_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_management_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
