-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 07:06 PM
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
-- Database: `crms_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Super Admin','Admin','Manager') DEFAULT NULL,
  `status` enum('active') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `lastname`, `firstname`, `email`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Admin ', 'Super', 'admin@gmail.com', 'admin', '$2y$10$E6mEzOr7CbFdqUvleRNQ8uGASMVXsB8LzjZygbxSkJ5ZnU1bBoA/q', 'Super Admin', 'active', '2024-11-07 11:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `ann_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `ann_image`) VALUES
(2, 'sys-announce-2.png'),
(3, 'Screenshot 2023-03-05 140200.png'),
(6, 'Screenshot 2023-03-13 085924.png'),
(7, '482898335_1316043106317966_2147666167284074217_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `category`, `description`, `created_at`) VALUES
(109, 'Introduction to Local Governance', 'All Department', 'sadsad', '2024-11-08 07:47:49'),
(110, 'Ethics and Integrity in Public Service', 'Barangay Council', 'dasds', '2024-11-08 08:08:38'),
(111, 'Workplace Safety and Health Regulations', 'Health and Sanitation', 'dasdasda asdasd', '2024-11-08 08:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'All Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee_points`
--

CREATE TABLE `employee_points` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `voucher` int(11) NOT NULL,
  `redeem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_points`
--

INSERT INTO `employee_points` (`id`, `employee_name`, `points`, `voucher`, `redeem`) VALUES
(26, 'sad Leonoras', 500, 0, 0),
(27, 'Juan Dela Cruz', 5000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `course_file` varchar(255) DEFAULT NULL,
  `datetime_started` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `employee_name`, `course_title`, `status`, `course_file`, `datetime_started`) VALUES
(40, 'Juan Dela Cruz', 'Ethics and Integrity in Public Service', 'COMPLETED', '482932610_1854914718382564_3316667680518052139_n.png', 'March 03, 2025 04:01 am');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `firstname`, `lastname`, `email`, `message`) VALUES
(1, 'ercylie', 'cordero', 'ercyliec@gmail.com', 'New user registered: (ercyliec@gmail.com) <br> Name: ercylie cordero'),
(2, 'A', 'A', 'AA@gmail.com', 'New user registered: (AA@gmail.com) <br> Name: A A'),
(3, 'cute', 'cute', 'employee@example.com', 'New user registered: (employee@example.com) <br> Name: cute cute');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `items` int(11) NOT NULL,
  `points_per_item` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `items`, `points_per_item`, `department_id`) VALUES
(4, 'Ethics and Integrity in Public Service', 10, 1000, 1),
(5, 'Data Privacy and Protection for Barangay Employees', 10, 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registerlanding`
--

CREATE TABLE `registerlanding` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `picture_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `registerlanding`
--

INSERT INTO `registerlanding` (`id`, `email`, `session_token`, `first_name`, `last_name`, `picture_pic`) VALUES
(32, 'wendhil10@gmail.com', '398f3198057a6332f7a37e5080e46db2ddc23840402f60ff8e50eace38276451', 'wendhil', 'himarangan', ''),
(34, 'acelovewhendil@gmail.com', '561627b594d5a2ff33da2604a8ab9cd73a2a1495a80fb303337a51e15998f130', 'Ace', 'Whendil', ''),
(35, 'tffnyshnbls@gmail.com', '26ff55d6ff3a2df55b21e56932df4ba192b3b14a0ba19d7a25b6cd2c8ccd7a33', 'Tiffany', 'Shane', ''),
(36, 'jppar2121@gmail.com', '020929f63320236cd8d4030b688634c796b64d2c4e716ee9856811699cdbd1e2', 'Philip', 'John', ''),
(38, 'sardoncillolemuel@gmail.com', '876eca15fb8729d63ebc0e585caf73b6b9722be53d60c0d9c0ada1161c7baeda', 'Lemuel James', 'Leonora', ''),
(41, 'macefelixerp@gmail.com', 'a1be128bf4dfa75b07efbbe6e523d6d1cc7f18dde18466ef4ecfacba7a5716e7', 'azhii', 'manganaan', ''),
(42, 'longcopismael@gmail.com', 'faa4218cddb0aaa03e87f87d99d0f5e7003196f85c30f63546c3316c6f8262e0', 'Ismael', 'Longcop', ''),
(43, 'wendhil09@gmail.com', '6b161e83b41b676ec4bca4f138399699a66f024ae664d9e6ac0eda0b73fbc89a', 'jeremy', 'garilao', ''),
(44, 'loyiwak621@payposs.com', '946543be811e2a93dcc2836d78ba3e41cde6b31f99ea8d11a72fa5994f69c1cb', 'jose', 'manalo', '');

-- --------------------------------------------------------

--
-- Table structure for table `reg_announcements`
--

CREATE TABLE `reg_announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reg_announcements`
--

INSERT INTO `reg_announcements` (`id`, `photo_url`, `description`, `upload_date`, `created_at`, `updated_at`) VALUES
(1, 'New Feature: Automated Compliance Reporting', 'Our compliance and regulatory management system now includes automated compliance reporting, making it easier for you to stay on top of your compliance obligations.', '2024-11-23 17:37:25', '2024-11-23 17:37:25', '2024-11-23 17:37:25'),
(2, 'Update: Revised Compliance Policy', 'Our compliance policy has been revised to reflect changes in regulatory requirements. Please review the updated policy to ensure you are in compliance.', '2024-11-23 17:39:10', '2024-11-23 17:39:10', '2024-11-23 17:39:10'),
(3, 'Best Practice: Tips for Effective Compliance Management', 'Check out our latest blog post for tips on effective compliance management, including how to identify and mitigate risks', '2024-11-23 17:39:30', '2024-11-23 17:39:30', '2024-11-23 17:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `system_announcements`
--

CREATE TABLE `system_announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `system_announcements`
--

INSERT INTO `system_announcements` (`id`, `photo_url`, `description`, `upload_date`, `created_at`, `updated_at`) VALUES
(1, '', 'Sytem coming soon', '2024-11-23 11:04:05', '2024-11-23 11:04:05', '2024-11-23 11:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verification_email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `date_of_hire` date NOT NULL,
  `job_function` varchar(255) NOT NULL,
  `supervisor_name` varchar(255) NOT NULL,
  `supervisor_email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'Employee',
  `status` varchar(10) DEFAULT 'active',
  `verification_code` varchar(32) DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `firstname`, `lastname`, `email`, `verification_email`, `phone_number`, `address`, `job_title`, `department`, `employee_id`, `date_of_hire`, `job_function`, `supervisor_name`, `supervisor_email`, `location`, `password`, `created_at`, `updated_at`, `profile_picture`, `role`, `status`, `verification_code`, `blocked_at`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(6, 'Juan', 'Dela Cruz', 'sardoncillolemuel@gmail.com', NULL, '09837483921', '#62 Victory Ave. Tatalon, Quezon City', 'Councilor', 'Barangay Dept.', '21120441', '2024-09-05', 'My job is to help and creating  programs for the barangay and community', 'N/A', 'supervisor@gmail.com', 'Quezon City', '$2y$10$lM9wQjZWGwply.rT2EexN..f9g.ZlrzEF.v4jSVmK4bOK7rRh2OZy', '2024-09-30 11:11:32', '2025-03-15 09:26:02', '', 'Employee', 'blocked', NULL, '2024-10-24 14:42:13', '9218f2f1aab16d353009c5cb33bd792352e27c5e33c6c3d9bdfae89adafe37f1', '2025-03-15 10:56:02'),
(7, 'Juan', 'Dela Cruz', 'user@gmail.com', NULL, '09342312567', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$5EMeTif.84Tt4hTX4f.0fO/If2MxIKuu.ON1ZYdoJ9fiMRfof0wyC', '2024-10-01 06:17:00', '2024-11-05 09:11:09', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(8, 'Lemuel James', 'Sardoncillo', 'lemueljamesleonora.globalminds@gmail.com', NULL, '09837483921', '#62 Victory Ave. Tatalon, Quezon City', 'Assistant', 'Barangay Dept.', '21120441', '2024-10-16', 'My job is to assists and creating  programs for the barangay and community', 'N/A', 'supervisor@gmail.com', 'Quezon City', '$2y$10$uAAgoBycyirZlTZx0sLZ7eRVZOF5k324rWewOO2xJKOBfurfSwQU2', '2024-10-01 08:10:06', '2024-11-12 18:39:04', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(9, 'Lemuel James', 'Leonora', 'lj123@gmail.com', NULL, '09479370421', '#62 Victory Ave. Tatalon, Quezon City', 'IT Consultant', 'IT Department', '21120441', '2024-10-15', 'Providing expert IT guidance and support to drive business success, improve efficiency, and reduce costs.', 'Juan Dela Cruz', 'example@gmail.com', 'Quezon City', '$2y$10$O5JW1ZzBpT/8Dx.cAoe6I.qYQerewS0iIP0dQyWZjPWaswjCjc7ou', '2024-10-01 10:55:44', '2024-10-18 21:39:38', '', 'Employee', 'pending', NULL, NULL, NULL, NULL),
(10, 'Test', 'User', 'test@gmail.com', NULL, '034929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$alfrzh0SEuFnMk0LJ34ubuC3/cPNlPLKotNK5.Lh3e9ULrxOar07C', '2024-10-01 15:51:58', '2025-03-11 08:55:24', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(12, 'Test', 'User', 'test2@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$Oss1GlLHFjP4WPtTrZoSJO220BvjzhMTZUg.tkX2Quz1tFOurdxfa', '2024-10-01 16:23:08', '2024-10-01 16:44:31', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(14, 'Test', 'User', 'test3@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$qwkzlzJsFbDps9kjioGA1eWL/Q5dZAv8LmEdfQ.hsrvAyEzDM6xjq', '2024-10-01 16:29:18', '2024-10-01 16:29:18', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(15, 'Test', 'User', 'tes434t@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$DsG5WM/bu0cFJq3dUhK1VuUXzxq/qTph3gXIew1BHXypEKA0M8.i2', '2024-10-01 16:29:39', '2024-10-01 16:29:39', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(16, 'Test', 'User', 'test345@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$DGBWntW4AjJwzNF/8fpWb.V20/2rhf7xpdZzV/5MMTV3XzWeTidga', '2024-10-01 16:29:55', '2024-10-01 16:29:55', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(17, 'Test', 'User', 'tes3456789t@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$lSxSyXnmfYJ.KlHQA8zw.erKWbH.vqWwzN4909/Ux5e10hCJ0g8Ni', '2024-10-01 16:30:08', '2024-10-01 16:44:34', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(18, 'asdasa', 'sadas', 'test-123@gmail.com', NULL, '34929423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$DVZ1fxEW4sAC.27Nebrn5eXjFP8O6mR.iFd.YfLi2I7uqmCcJuiYa', '2024-10-01 16:30:27', '2025-02-25 01:19:43', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(19, 'Lemuel James', 'Leonoras', 'asdsdasd@gmail.com', NULL, '5645435', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$AlTPw8VTHLPTZEf0c/HxE.2xDOAMRMzr.yt6m4uanlJkpuLvg17n6', '2024-10-01 16:52:25', '2024-10-23 16:58:19', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(20, 'Lemuel James', 'Leonoras', 'asdsdasdaaaa@gmail.com', NULL, '5645435', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$NRkYG3KXlA6KrUiBB6ksxOQiN6bCWTp/ujBe8LeHLgqX3vIn8NkQm', '2024-10-01 16:53:46', '2024-10-14 22:21:15', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(22, 'sad', 'sdsd', 'guest03@gmail.com', NULL, '09479370421', 'Phase 5, Bagong Silang, Caloocan City', 'Chairman', 'Barangay Dept.', '21120441', '2024-10-18', 'My job is to help and creating  programs for the barangay and community', 'N/A', 'supervisor@gmail.com', 'Caloocan City', '$2y$10$P.kXdo03bZXesBvyPZqwpe7JUxowaSkf9X34BDNNyjWPu4k0wi0xu', '2024-10-04 16:17:44', '2024-10-04 16:17:44', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(23, 'sad', 'Leonoras', 'guest05@gmail.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Councilor', 'Barangay Dept.', '21120441', '2024-10-18', 'My job is to assists and creating  programs for the barangay and community', 'N/A', 'supervisor@gmail.com', 'Caloocan City', '$2y$10$V7e0zSlqUel1AEN2GVFfMubDdlUvLdexCe7ssoTxOFpSvQ6x.m53m', '2024-10-04 16:19:33', '2024-10-23 16:58:25', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(24, 'sad', 'Leonoras', 'guest10@gmail.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Assistant', 'Barangay Dept.', '21120441', '2021-12-10', 'Providing expert IT guidance and support to drive business success, improve efficiency, and reduce costs.', 'Juan Dela Cruz', 'supervisor@gmail.com', 'Caloocan City', '$2y$10$CZyteFGMJfM/RFMDG8bkheNRN9GqsCc822tt/eKaxBrVi3V7EoY1m', '2024-10-04 16:20:51', '2024-10-04 16:23:56', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(25, 'L James ', 'Leonoras', 'admin01@gmail.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Assistant', 'Barangay Dept.', '21120441', '2024-10-01', 'My job is to help and creating  programs for the barangay and community', 'Juan Dela Cruz', 'supervisor@gmail.com', 'Caloocan City', '$2y$10$qsQuQ4vdA06v61/Sno5z8eHnm42R8dRPK1mo8IotseiIdjDy6PsUm', '2024-10-04 16:24:36', '2024-10-23 16:58:44', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(26, 'This', 'Test', 'qa@gmail.com', NULL, '3423432423', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$DTyD/AAt51kwOYcgdfiQieAe4wTP/PeSYA9X6NNoMm.5f0yXy5cay', '2024-10-06 09:01:49', '2024-10-06 09:01:49', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(28, 'This', 'Test', 'qa1@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-01', 'sadasdasdasd sadsadsad', 'sadasd', 'qa@gmail.com', 'QC', 'qatest-123', '2024-10-06 10:30:12', '2024-10-06 10:30:12', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(30, 'This', 'Test', 'testko123@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-01', 'sadasdasdasd sadsadsad', 'sadasd', 'qa@gmail.com', 'QC', 'qatest-123', '2024-10-06 10:31:16', '2024-10-06 10:31:16', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(31, 'This Is', 'Test Only', 'global@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Tanod', 'Security', '111111', '2024-10-25', 'sadasdasdasd sadsadsad', 'sadasd', 'qa2223@gmail.com', 'QC', '$2y$10$7Zjl15nrNo6wtyDWaGXQPuoBH32/12SoZiCjefmj4bwcPr5RVuOwW', '2024-10-06 11:11:44', '2024-10-11 22:49:32', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(32, 'This Is', 'Test Only', 'global222@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Tanod', 'Security', '111111', '2024-10-23', 'sadasdasdasd sadsadsad', 'sadasd', 'qa2223@gmail.com', 'QC', '$2y$10$UZCWF8rZbAr6gbBpsqqxHedYxDmcXx5oX0VxMgy5w6zc8BXif7SXK', '2024-10-06 11:14:27', '2024-10-06 11:14:27', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(33, 'This Is', 'Test Only', 'globaltest@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Tanod', 'Security', '111111', '2024-10-16', 'sadasdasdasd sadsadsad', 'sadasd', 'qa233@gmail.com', 'QC', '$2y$10$JhvrGRkTUHKFyESqg8iEdO5F4UH5BsInTlnxHugBIOPQxqPnzT6jO', '2024-10-06 11:27:51', '2024-10-06 11:27:51', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(34, 'Lemuel James', 'Leonoras', 'gmap@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Chairman', 'Head', '111111', '2024-10-24', 'sadasdasdasd sadsadsad', 'sadasd', 'global@gmail.com', 'QC', '$2y$10$7JAhC4Uw8nE1MpJTtGe8Ru7AML4Fl/P6lsrzfEKJx.lWUu8aVP7kC', '2024-10-06 11:55:34', '2024-10-11 23:51:22', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(35, 'Juan', 'Dela Cruz', 'testnotify@gmail.com', NULL, '09837483921', '#62 Victory Ave. Tatalon, Quezon City', 'Assistant', 'IT Department', '21120441', '2024-10-03', 'Providing expert IT guidance and support to drive business success, improve efficiency, and reduce costs.', 'Juan Dela Cruz', 'example@gmail.com', 'Quezon City', '$2y$10$Ls75386Y7B1Dbbr.fbbLceGskDTmdf8NkCDPlo5UfdsI/h/Ok1PS2', '2024-10-06 12:25:41', '2024-10-23 16:58:31', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(36, 'Lemuel James', 'Leonora', 'lasttest@gmail.com', NULL, '09837483921', '#62 Victory Ave. Tatalon, Quezon City', 'Chairman', 'Barangay Dept.', '21120441', '2024-10-08', 'My job is to assists and creating  programs for the barangay and community', 'Juan Dela Cruz', 'example@gmail.com', 'Quezon City', '$2y$10$GRJlLd3vedBTFQw6.crslOMkbSNwhHTnCTDTKBeOFC0Av5Huywrwe', '2024-10-06 12:32:52', '2024-10-06 12:32:52', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(37, 'LJames', 'Leonora', 'final@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-08', 'sadasdasdasd sadsadsad', 'sadasd', 'qa332223@gmail.com', 'QC', '$2y$10$eR16ZI7Et85rWuZf41t9Ce9qb951eWpZYUiEGjnXPLvuZ.rn7Rg8S', '2024-10-06 13:14:37', '2024-10-16 18:12:33', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(38, 'Lemuel James', 'Leonora', 'final1@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-07', 'sadasdasdasd sadsadsad', 'sadasd', 'qa332223@gmail.com', 'QC', '$2y$10$CVNCHNmZLgAa7IVhJLd5We6ipl/i2hwV7xvNXjHhZGNMSj4YXP2m6', '2024-10-06 13:15:58', '2024-10-06 13:15:58', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(39, 'Lemuel James', 'Leonora', 'final2@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-18', 'sadasdasdasd sadsadsad', 'sadasd', 'qa233@gmail.com', 'QC', '$2y$10$Fi9O3ux0BpsNfKZBcKtWQ.GKWEIgTMoA8PFpLt3DPSsF5Bd3WiBSO', '2024-10-06 13:21:19', '2024-10-06 13:21:19', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(40, 'Lemuel James', 'Leonora', 'final3@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-02', 'sadasdasdasd sadsadsad', 'sadasd', 'qa233@gmail.com', 'QC', '$2y$10$zAj4vgmSHbYLPvfW9co9..j923eJUnC0DZBlLHfltv/F6jAXp1UN6', '2024-10-06 13:24:39', '2024-10-06 13:24:39', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(41, 'Lemuel James', 'Leonora', 'testkoto@gmail.com', NULL, '3423432423', 'Phase 5, Bagong Silang, Caloocan City', 'Web Developer', 'Public Service', '111111', '2024-10-16', 'sadasdasdasd sadsadsad', 'sadasd', 'qa233@gmail.com', 'QC', '$2y$10$i1XRMTiikAaHskHVA8BlAe3YyeJcOxL4zMO8AUYuR/Rr41Antrsru', '2024-10-06 13:31:58', '2024-10-06 13:31:58', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(42, 'Juan', 'Leonora', 'user-test@gmail.com', NULL, '09479370421', '#62 Victory Ave. Tatalon, Quezon City', 'Assistant', 'Barangay Dept.', '21120441', '2024-09-19', 'My job is to assists and creating  programs for the barangay and community', 'Juan Dela Cruz', 'supervisor@gmail.com', 'Caloocan City', '$2y$10$CzVareCQ87mBYUluhLc45eQSFRxSqa.3Gr8WJhSaFCBfpwIwmsyY6', '2024-10-06 13:44:00', '2024-10-06 13:44:00', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(43, 'Lemuel James', 'Sardoncillo', 'hahaha-123@gmail.com', NULL, '09479370421', '#62 Victory Ave. Tatalon, Quezon City', 'Councilor', 'Barangay Dept.', '21120441', '2024-10-16', 'My job is to assists and creating  programs for the barangay and community', 'Juan Dela Cruz', 'supervisor@gmail.com', 'Quezon City', '$2y$10$zDV7uojeQl3E9/gx5P8hWOQr2Imo8N0Hgho/qrg001QKYpMwWYKSi', '2024-10-06 13:55:43', '2024-10-06 13:55:43', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(44, 'Final', 'Dela Fuente', 'hello@gmail.com', NULL, '09479370421', '#62 Victory Ave. Tatalon, Quezon City', 'Assistant', 'Barangay Dept.', '21120441', '2024-10-31', 'Providing expert IT guidance and support to drive business success, improve efficiency, and reduce costs.', 'Juan Dela Cruz', 'example@gmail.com', 'Caloocan City', '$2y$10$b9iE3vBs0CfCAPaGvjC5g.LDU9pZiKSiYCfca4JVXOKiQlN8AaAjq', '2024-10-06 14:13:59', '2025-03-15 16:06:59', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(45, 'Pogi', 'Dela Cruz', 'guest20@gmail.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Chairman', 'IT Department', '21120441', '2024-10-16', 'My job is to assists and creating  programs for the barangay and community', 'Juan Dela Cruz', 'example@gmail.com', 'Caloocan City', '$2y$10$2P5r.xCF8mBxtWxVttWDNu0Zdy02NeaHLiqUD6eSXgdTpWQSAN3hi', '2024-10-06 19:06:08', '2024-10-12 01:13:04', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(46, 'Juan ', 'Dela Cruz', 'guest100@gmail.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Secretary', 'Barangay Dept.', '21120441', '2024-10-18', 'My job is to help and creating  programs for the barangay and community', 'Juan Dela Cruz', 'example@gmail.com', 'Caloocan City', '$2y$10$xga6aCTg2o60tcWGgiBnBuo/TuE8DGbaY90lWGNXWOrLihxCwgL4C', '2024-10-08 13:56:25', '2024-10-08 13:57:55', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(47, 'HAHAHAHAHA', 'Corpuz', 'sasdasd@gmail.com', NULL, '34343434', '', '', '', '', '0000-00-00', '', '', '', '', '$2y$10$caco5p9zpjNEmyUh5x27KOVpnwTYe1zlWV/JLJ4uNKpdhINTo8a0G', '2024-10-11 20:25:12', '2024-10-15 16:55:24', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(48, 'Pedro', 'Penduko', 'k.anderson@example.com', NULL, '09837483921', 'Phase 5, Bagong Silang, Caloocan City', 'Barangay Tanod', 'Crime Watch', '21120441', '2024-10-10', 'My job is to assists and creating  programs for the barangay and community', 'Juan Dela Cruz', 'example@gmail.com', 'Caloocan City', '$2y$10$75hOEzsPrxA5PX3p0NZ84OjRKyAnMt4i007oxQzpyRttXJzLYB7cW', '2024-10-11 23:50:26', '2024-10-11 23:59:15', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(49, 'BCP', 'Admin', 'bcp@gmail.com', NULL, '3432432', 'badasdasdsad', 'dasdas', 'sadsad', '23123', '2024-10-02', 'sdasdsdasd', 'asdasd', 'admin@gmail.com', 'QC', '$2y$10$ofbrKsCWrR5C.KII/sPX9.NKth07ZWCisYaOAexsX0b1AdFIpPPnm', '2024-10-13 06:10:06', '2025-03-11 09:04:40', '', 'Employee', 'blocked', NULL, NULL, NULL, NULL),
(50, 'Lemuel James', 'Leonora', 'lemueljamesleonora@gmail.com', NULL, '09479370421', '62 Victory Ave. Tatalon, Quezon City', 'IT Developer', 'IT Department', '21120441', '2024-10-31', 'As an IT, i develop system like web an app system', 'N/A', 'example@gmail.com', 'Quezon City', '$2y$10$lt.BFHePiTJSHFn/iF.DpepBnBjedt3/TBXwwBA62NhEKNE8tetNq', '2024-10-17 16:37:00', '2024-10-17 16:37:00', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(51, 'Lemuel James', 'Leonora', 'ljamesleonora@gmail.com', NULL, '09479370421', '62 Victory Ave. Tatalon, Quezon City', 'IT Developer', 'IT Department', '21120441', '2024-10-10', 'As an IT, i develop system like web an app system', 'N/A', 'example@gmail.com', 'Quezon City', '$2y$10$j7OiFTsIkp0rURjVNvs3Buzsk36JcPDXlPH7Qcx6tbrs3.q67Qwiu', '2024-10-17 17:10:25', '2024-10-17 17:10:25', '', 'Employee', 'active', NULL, NULL, NULL, NULL),
(52, 'sadsa', 'sdas', 'pogi@gmail.com', NULL, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '2024-10-23 18:51:33', '2025-03-11 09:04:51', NULL, 'Employee', 'active', NULL, NULL, 'efdd167a46665cdd2da01a65b3493d3d958981eba4d5551f0e16d10d02c57757', '2024-11-10 23:44:41'),
(54, 'Edna', 'Dela Cruz', 'ercylie0@gmail.com', NULL, '63051495790', '783 int 9 maria guizon street tondo', 'Admin', 'IT', '3243243', '2024-11-07', 'eqweqw qweqweqw', 'qweqweqw', 'ercylie0@gmail.com', 'manila', '$2y$10$uwmpF/R/kynqpELJJvwLuep3DIF4r6mvAe8MWsRRTCEkpX154ZzFS', '2024-11-08 16:09:24', '2024-11-21 09:38:44', NULL, 'Employee', 'pending', NULL, NULL, '3c89c06b1cf14d51ec930bda55b483909de5e9b61648b3f42591da894eb6dfd9', '2024-11-21 11:08:44'),
(55, 'Edna', 'Dela Cruz', 'sadsadasd@gmail.com', NULL, '63051495790', '783 int 9 maria guizon street tondo', 'Admin', 'IT', '3243243', '2024-11-22', 'eqweqw qweqweqw', 'qweqweqw', 'ercylie0@gmail.com', 'manila', '$2y$10$hWQqWWR7q8XVXXO6zZWxSe82TmDX61Pi2WBp3YHYLTHkDZKBb8LXq', '2024-11-10 07:50:36', '2024-11-10 07:50:36', NULL, 'Employee', 'active', NULL, NULL, NULL, NULL),
(56, 'ivy', 'desalisa', 'ycharlottemorillo@gmail.com', NULL, '63051495790', '783 int 9 maria guizon street tondo', 'secretary', 'IT', '21015620', '2002-11-21', 'This is a test', 'joel', 'test@gmail.com', 'manila', '$2y$10$hgE96/AwkmHJKlqye49nfON.y64E0eQkeqQ6KES33fr/Dh.m.XbGi', '2024-11-21 09:35:15', '2024-11-21 09:38:17', NULL, 'Employee', 'active', NULL, NULL, '8fd87a97a8fac7634f5968111f6f40e5a7d019b0f53b9d0baa2468d866350943', '2024-11-21 11:08:17'),
(57, 'Joshua', 'Nazareno', 'joshuanazareno928@gmail.com', NULL, '09129540695', 'Phase 5, Bagong Silang, Caloocan City', 'manager', 'IT Department', '19015300', '2002-09-28', 'Providing expert IT guidance and support to drive business success, improve efficiency, and reduce costs.', 'N/A', 'example@gmail.com', 'Caloocan City', '$2y$10$cpPVUJsNo/3aFWQgS2AON.SUQQBlLpIfQgvW9f665cW.nCY6XSMxu', '2024-11-24 01:39:41', '2024-11-24 02:10:23', NULL, 'Employee', 'active', NULL, NULL, '6ee32e0380dc2e5630f332a9cec787f6ca76d0d040c384eaa0863ca1afec579b', '2024-11-24 02:40:23'),
(58, 'Eugene', 'aureus', 'eaureus050@gmail.com', NULL, '09260287663', 'Phase 5, Bagong Silang, Caloocan City', 'Secretary', 'Barangay Dept.', '21120441', '2003-11-24', 'My job is to assists and creating  programs for the barangay and community', 'N/A', 'example@gmail.com', 'Caloocan City', '$2y$10$JtWnCR.Gi.5lXfuH294ZLe0lukDvL6Z6r1M0v1RuwbncAcaBBwK/W', '2024-11-24 02:12:38', '2024-11-24 02:12:53', NULL, 'Employee', 'active', NULL, NULL, '2903d4005c17531c1e4752d0954b12ca4b244175f0d7720dc47989fcc7bae368', '2024-11-24 02:42:53'),
(59, 'ercylie', 'cordero', 'ercyliec@gmail.com', NULL, '09123456789', 'Tondo Manila', 'secretary', 'barangay', '123456789', '2015-12-11', 'appointive official, appointed by the elected Punong Barangay.', 'Test A. Test', 'test123@gmail.com', 'Manila', '$2y$10$0aR1vCDu0ixyUDUQ4gwRT.NlnC2uEF2kYSh4L/M5DJDBk1wA5R4Cm', '2025-02-28 22:52:19', '2025-02-28 22:52:19', NULL, 'Employee', 'active', NULL, NULL, NULL, NULL),
(60, 'A', 'A', 'AA@gmail.com', NULL, '23', 'a@', 'A', 'A', '211', '2000-01-01', 'A', 'A', 'A', 'A', '$2y$10$HLX1HcujvnLZqrANx2KlDulYSjWGlM0bRfeYVhMaDJE/8b.yQJ0xW', '2025-03-11 17:37:46', '2025-03-11 17:37:46', NULL, 'Employee', 'active', NULL, NULL, NULL, NULL),
(61, 'cute', 'cute', 'employee@example.com', NULL, '12', '12', 'cc', 'cc', '12', '2025-03-14', '12', '12', '12', '12', '$2y$10$jTCndubZSV1nyS7LajoCcedqZtK2lgORYUcj9g0cc.jL8yzQfpdPm', '2025-03-11 17:42:31', '2025-03-11 17:42:31', NULL, 'Employee', 'active', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_points`
--
ALTER TABLE `employee_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `registerlanding`
--
ALTER TABLE `registerlanding`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reg_announcements`
--
ALTER TABLE `reg_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_announcements`
--
ALTER TABLE `system_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_points`
--
ALTER TABLE `employee_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registerlanding`
--
ALTER TABLE `registerlanding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reg_announcements`
--
ALTER TABLE `reg_announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_announcements`
--
ALTER TABLE `system_announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
