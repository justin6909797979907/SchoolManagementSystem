-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2026 at 12:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `balistic_lab_borrow`
--

CREATE TABLE `balistic_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balistic_lab_damage`
--

CREATE TABLE `balistic_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balistic_lab_inventory`
--

CREATE TABLE `balistic_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balistic_lab_inventory`
--

INSERT INTO `balistic_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(1, 'Ballistic Kit', 'Ballistic kit', 'Crime Scene Laboratory', 12, 12, 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `balistic_lab_monitoring`
--

CREATE TABLE `balistic_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemistry_lab_borrow`
--

CREATE TABLE `chemistry_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemistry_lab_damage`
--

CREATE TABLE `chemistry_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemistry_lab_inventory`
--

CREATE TABLE `chemistry_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemistry_lab_inventory`
--

INSERT INTO `chemistry_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(1, 'dawdwaiuhjgt', 'dawdwa', 'Chemistry Laboratory', 21, 21, 'Damaged');

-- --------------------------------------------------------

--
-- Table structure for table `chemistry_lab_monitoring`
--

CREATE TABLE `chemistry_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crime_lab_borrow`
--

CREATE TABLE `crime_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crime_lab_damage`
--

CREATE TABLE `crime_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crime_lab_inventory`
--

CREATE TABLE `crime_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_lab_inventory`
--

INSERT INTO `crime_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(2, 'Brushes', 'Latent print kits', 'Crime Scene Laboratory', 10, 50, 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `crime_lab_monitoring`
--

CREATE TABLE `crime_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defense_lab_borrow`
--

CREATE TABLE `defense_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defense_lab_damage`
--

CREATE TABLE `defense_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `defense_lab_damage`
--

INSERT INTO `defense_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(1, 'asdfasd', 'Defense Tactics Laboratory', 'dfasd', 'sdfgfdsg', '2026-08-29', 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `defense_lab_inventory`
--

CREATE TABLE `defense_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defense_lab_monitoring`
--

CREATE TABLE `defense_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fingeprint_lab_borrow`
--

CREATE TABLE `fingeprint_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fingerprint_lab_damage`
--

CREATE TABLE `fingerprint_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fingerprint_lab_damage`
--

INSERT INTO `fingerprint_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(1, 'asdfasd', 'Fingerprint Laboratory', 'asdfasedf', 'dsfsdaf', '2026-08-03', 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `fingerprint_lab_inventory`
--

CREATE TABLE `fingerprint_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fingerprint_lab_inventory`
--

INSERT INTO `fingerprint_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(7, 'adwwa', 'dwadwa', 'Fingerprint Laboratory', 12, 123, 'Working'),
(8, 'okkk', 'mnjnjn', 'Fingerprint Laboratory', 989, 262, 'Damaged'),
(9, 'l;pll', 'jhiojo', 'Fingerprint Laboratory', 542, 2652165, 'Damaged'),
(10, '23', '511', 'Fingerprint Laboratory', 65565, 565, 'Damaged'),
(11, 'dawd', 'dawdwa', 'Fingerprint Laboratory', 12, 12, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `fingerprint_lab_monitoring`
--

CREATE TABLE `fingerprint_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `he_lab_borrow`
--

CREATE TABLE `he_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `he_lab_damage`
--

CREATE TABLE `he_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `he_lab_damage`
--

INSERT INTO `he_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(2, 'efadsfaa', 'Home Economics Laboratory', 'fasdfasd', 'asdfasdf', '2026-08-03', 'Damaged');

-- --------------------------------------------------------

--
-- Table structure for table `he_lab_inventory`
--

CREATE TABLE `he_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `he_lab_inventory`
--

INSERT INTO `he_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(3, 'zssz', 'dawdwa', 'Home Economics Laboratory', 2, 2, 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `he_lab_monitoring`
--

CREATE TABLE `he_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab1_borrow`
--

CREATE TABLE `it_lab1_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab1_damage`
--

CREATE TABLE `it_lab1_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_lab1_damage`
--

INSERT INTO `it_lab1_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(1, 'sdfadsf', 'IT Laboratory 1', 'adwsfasdf', 'asdfasdf', '2026-08-02', 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `it_lab1_inventory`
--

CREATE TABLE `it_lab1_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_lab1_inventory`
--

INSERT INTO `it_lab1_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(2, 'Mouse', 'Computer', 'IT Lab 1', 21, 21, 'Working'),
(3, 'Projector', 'PC', 'IT Lab 1', 2, 5, 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `it_lab1_monitoring`
--

CREATE TABLE `it_lab1_monitoring` (
  `id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab2_borrow`
--

CREATE TABLE `it_lab2_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab2_damage`
--

CREATE TABLE `it_lab2_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab2_inventory`
--

CREATE TABLE `it_lab2_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_lab2_inventory`
--

INSERT INTO `it_lab2_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(2, 'Monitor', 'PC', 'IT Lab 2', 32, 32, 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `it_lab2_monitoring`
--

CREATE TABLE `it_lab2_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab3_borrow`
--

CREATE TABLE `it_lab3_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab3_damage`
--

CREATE TABLE `it_lab3_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_lab3_inventory`
--

CREATE TABLE `it_lab3_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_lab3_inventory`
--

INSERT INTO `it_lab3_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(4, 'jhafdg', 'dfada', 'IT Lab 3', 23, 23, 'Under Maintenance'),
(5, 'try', 'dawa', 'IT Lab 3', 43, 43, 'Damaged'),
(6, 'Mouse', 'Computer', 'IT Lab 3', 45, 45, 'Damaged'),
(7, 'Monitor', 'PC', 'IT Lab 3', 123, 123, 'Working'),
(8, 'Mouse', 'PC', 'IT Lab 3', 30, 12, 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `it_lab3_monitoring`
--

CREATE TABLE `it_lab3_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phys_lab_borrow`
--

CREATE TABLE `phys_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` int(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phys_lab_damage`
--

CREATE TABLE `phys_lab_damage` (
  `id` int(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phys_lab_damage`
--

INSERT INTO `phys_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(3, 'adf', 'fsdf', 'adfad', 'aafad', '2026-08-03', 'Working'),
(8, 'sfdgsdfg', 'Questioned Document Laboratory', 'sdfgdsfg', 'fgsdfgsdf', '2026-08-03', 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `phys_lab_inventory`
--

CREATE TABLE `phys_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phys_lab_inventory`
--

INSERT INTO `phys_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(2, 'ddawdaw', 'dwdwa', 'wadaw', 12, 10, 'Damaged'),
(13, '232', 'rer', 'Physics Lab', 23, 12, 'Working'),
(15, 'dwaad', 'dawa', 'Physics Lab', 12, 12, 'Working'),
(16, 'fdfsd', '123', 'Physics Lab', 123, 123, 'Working'),
(18, 'adf', 'ffadf', 'Psychology Lab', 3, 14, 'Working'),
(19, 'afdaa', 'fada', 'Physics Lab', 142, 432, 'Damaged'),
(20, 'zssz', 'afdfzs', 'Physics Lab', 3, 3, 'Working'),
(21, 'TRRRRy', 'afdfzs', 'Psychology Lab', 10, 10, 'Working'),
(22, 'dfasdgf', 'dawdwa', 'Psychology Lab', 23, 23, 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `phys_lab_monitoring`
--

CREATE TABLE `phys_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psy_lab_borrow`
--

CREATE TABLE `psy_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psy_lab_damage`
--

CREATE TABLE `psy_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(11) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `psy_lab_damage`
--

INSERT INTO `psy_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(1, 'asdfasd', 'Psychology Laboratory', 'asdfasd', 'asdfasdf', '2026-08-03', 'Damaged');

-- --------------------------------------------------------

--
-- Table structure for table `psy_lab_inventory`
--

CREATE TABLE `psy_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` varchar(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `psy_lab_inventory`
--

INSERT INTO `psy_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(6, 'dawd', '12321', 'Psychology Laboratory', 12, '12', 'Under Maintenance'),
(7, '2gssdfgsdf', 'egsdfgsfg', 'Psychology Laboratory', 45354, '54354453', 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `psy_lab_monitoring`
--

CREATE TABLE `psy_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_lab_borrow`
--

CREATE TABLE `question_lab_borrow` (
  `id` int(11) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `borrower_name` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_lab_damage`
--

CREATE TABLE `question_lab_damage` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `reported_by` varchar(100) NOT NULL,
  `date_reported` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_lab_damage`
--

INSERT INTO `question_lab_damage` (`id`, `item_name`, `laboratory`, `issue`, `reported_by`, `date_reported`, `status`) VALUES
(1, 'fasdf', 'Question Document Laboratory', 'ssfds', 'sdfs', '2026-08-03', 'Damaged'),
(2, 'sdafads', 'Question Document Laboratory', 'aswdfasdf', 'asdfasdf', '2026-08-03', 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `question_lab_inventory`
--

CREATE TABLE `question_lab_inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `total_item` int(11) NOT NULL,
  `available_item` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_lab_inventory`
--

INSERT INTO `question_lab_inventory` (`id`, `item_name`, `category`, `laboratory`, `total_item`, `available_item`, `status`) VALUES
(1, 'dawd', 'ffadf', 'Questioned Documents Lab', 2321, 2343, 'Under Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `question_lab_monitoring`
--

CREATE TABLE `question_lab_monitoring` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `laboratory` varchar(100) NOT NULL,
  `equipment_condition` varchar(100) NOT NULL,
  `last_checked` date NOT NULL DEFAULT current_timestamp(),
  `checked_by` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balistic_lab_borrow`
--
ALTER TABLE `balistic_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balistic_lab_damage`
--
ALTER TABLE `balistic_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balistic_lab_inventory`
--
ALTER TABLE `balistic_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balistic_lab_monitoring`
--
ALTER TABLE `balistic_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemistry_lab_borrow`
--
ALTER TABLE `chemistry_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemistry_lab_damage`
--
ALTER TABLE `chemistry_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemistry_lab_inventory`
--
ALTER TABLE `chemistry_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemistry_lab_monitoring`
--
ALTER TABLE `chemistry_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_lab_borrow`
--
ALTER TABLE `crime_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_lab_damage`
--
ALTER TABLE `crime_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_lab_inventory`
--
ALTER TABLE `crime_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_lab_monitoring`
--
ALTER TABLE `crime_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defense_lab_borrow`
--
ALTER TABLE `defense_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defense_lab_damage`
--
ALTER TABLE `defense_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defense_lab_inventory`
--
ALTER TABLE `defense_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defense_lab_monitoring`
--
ALTER TABLE `defense_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingeprint_lab_borrow`
--
ALTER TABLE `fingeprint_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingerprint_lab_damage`
--
ALTER TABLE `fingerprint_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingerprint_lab_inventory`
--
ALTER TABLE `fingerprint_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fingerprint_lab_monitoring`
--
ALTER TABLE `fingerprint_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_lab_borrow`
--
ALTER TABLE `he_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_lab_damage`
--
ALTER TABLE `he_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_lab_inventory`
--
ALTER TABLE `he_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_lab_monitoring`
--
ALTER TABLE `he_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab1_borrow`
--
ALTER TABLE `it_lab1_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab1_damage`
--
ALTER TABLE `it_lab1_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab1_inventory`
--
ALTER TABLE `it_lab1_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab1_monitoring`
--
ALTER TABLE `it_lab1_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab2_borrow`
--
ALTER TABLE `it_lab2_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab2_damage`
--
ALTER TABLE `it_lab2_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab2_inventory`
--
ALTER TABLE `it_lab2_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab2_monitoring`
--
ALTER TABLE `it_lab2_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab3_borrow`
--
ALTER TABLE `it_lab3_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab3_damage`
--
ALTER TABLE `it_lab3_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab3_inventory`
--
ALTER TABLE `it_lab3_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_lab3_monitoring`
--
ALTER TABLE `it_lab3_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phys_lab_borrow`
--
ALTER TABLE `phys_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phys_lab_damage`
--
ALTER TABLE `phys_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phys_lab_inventory`
--
ALTER TABLE `phys_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phys_lab_monitoring`
--
ALTER TABLE `phys_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psy_lab_borrow`
--
ALTER TABLE `psy_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psy_lab_damage`
--
ALTER TABLE `psy_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psy_lab_inventory`
--
ALTER TABLE `psy_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psy_lab_monitoring`
--
ALTER TABLE `psy_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_lab_borrow`
--
ALTER TABLE `question_lab_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_lab_damage`
--
ALTER TABLE `question_lab_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_lab_inventory`
--
ALTER TABLE `question_lab_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_lab_monitoring`
--
ALTER TABLE `question_lab_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balistic_lab_borrow`
--
ALTER TABLE `balistic_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balistic_lab_damage`
--
ALTER TABLE `balistic_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balistic_lab_inventory`
--
ALTER TABLE `balistic_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balistic_lab_monitoring`
--
ALTER TABLE `balistic_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemistry_lab_borrow`
--
ALTER TABLE `chemistry_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemistry_lab_damage`
--
ALTER TABLE `chemistry_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemistry_lab_inventory`
--
ALTER TABLE `chemistry_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chemistry_lab_monitoring`
--
ALTER TABLE `chemistry_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crime_lab_borrow`
--
ALTER TABLE `crime_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crime_lab_damage`
--
ALTER TABLE `crime_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crime_lab_inventory`
--
ALTER TABLE `crime_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crime_lab_monitoring`
--
ALTER TABLE `crime_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defense_lab_borrow`
--
ALTER TABLE `defense_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defense_lab_damage`
--
ALTER TABLE `defense_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `defense_lab_inventory`
--
ALTER TABLE `defense_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `defense_lab_monitoring`
--
ALTER TABLE `defense_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fingeprint_lab_borrow`
--
ALTER TABLE `fingeprint_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fingerprint_lab_damage`
--
ALTER TABLE `fingerprint_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fingerprint_lab_inventory`
--
ALTER TABLE `fingerprint_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fingerprint_lab_monitoring`
--
ALTER TABLE `fingerprint_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `he_lab_borrow`
--
ALTER TABLE `he_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `he_lab_damage`
--
ALTER TABLE `he_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `he_lab_inventory`
--
ALTER TABLE `he_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `he_lab_monitoring`
--
ALTER TABLE `he_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab1_borrow`
--
ALTER TABLE `it_lab1_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab1_damage`
--
ALTER TABLE `it_lab1_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `it_lab1_inventory`
--
ALTER TABLE `it_lab1_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `it_lab1_monitoring`
--
ALTER TABLE `it_lab1_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab2_borrow`
--
ALTER TABLE `it_lab2_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab2_damage`
--
ALTER TABLE `it_lab2_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab2_inventory`
--
ALTER TABLE `it_lab2_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `it_lab2_monitoring`
--
ALTER TABLE `it_lab2_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab3_borrow`
--
ALTER TABLE `it_lab3_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab3_damage`
--
ALTER TABLE `it_lab3_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_lab3_inventory`
--
ALTER TABLE `it_lab3_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `it_lab3_monitoring`
--
ALTER TABLE `it_lab3_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phys_lab_borrow`
--
ALTER TABLE `phys_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phys_lab_damage`
--
ALTER TABLE `phys_lab_damage`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `phys_lab_inventory`
--
ALTER TABLE `phys_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `phys_lab_monitoring`
--
ALTER TABLE `phys_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `psy_lab_borrow`
--
ALTER TABLE `psy_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `psy_lab_damage`
--
ALTER TABLE `psy_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `psy_lab_inventory`
--
ALTER TABLE `psy_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `psy_lab_monitoring`
--
ALTER TABLE `psy_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_lab_borrow`
--
ALTER TABLE `question_lab_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_lab_damage`
--
ALTER TABLE `question_lab_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_lab_inventory`
--
ALTER TABLE `question_lab_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question_lab_monitoring`
--
ALTER TABLE `question_lab_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
