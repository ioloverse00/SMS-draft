-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 07:42 AM
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
-- Database: `student_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities_performance_tasks`
--

CREATE TABLE `activities_performance_tasks` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `term` enum('1st','2nd') DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `task_type` enum('Activity','Performance Task','Midterm Examination','Final Examination') NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `recorded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities_performance_tasks`
--

INSERT INTO `activities_performance_tasks` (`id`, `student_id`, `subject_code`, `term`, `week`, `task_type`, `score`, `recorded_by`, `created_at`) VALUES
(1, 'S250001', 'GENMATH', '1st', 1, 'Activity', 85.00, 'T250004', '2025-04-13 14:18:28'),
(2, 'S250001', 'GENMATH', '1st', 2, 'Activity', 100.00, 'T250004', '2025-04-13 14:18:28'),
(3, 'S250001', 'GENMATH', '1st', 3, 'Activity', 75.00, 'T250004', '2025-04-13 14:18:28'),
(4, 'S250001', 'GENMATH', '1st', 4, 'Activity', 82.00, 'T250004', '2025-04-13 14:18:28'),
(5, 'S250001', 'GENMATH', '1st', 5, 'Activity', 95.34, 'T250004', '2025-04-13 14:18:28'),
(6, 'S250001', 'GENMATH', '1st', 6, 'Activity', 69.00, 'T250004', '2025-04-13 14:18:28'),
(7, 'S250001', 'GENMATH', '1st', 7, 'Activity', 78.00, 'T250004', '2025-04-13 14:18:28'),
(8, 'S250001', 'GENMATH', '1st', 8, 'Activity', 95.00, 'T250004', '2025-04-13 14:18:28'),
(9, 'S250001', 'GENMATH', '1st', 1, 'Performance Task', 100.00, 'T250004', '2025-04-13 14:20:03'),
(11, 'S250001', 'GENMATH', '1st', 2, 'Performance Task', 85.00, 'T250004', '2025-04-13 14:20:03'),
(14, 'S250001', 'GENMATH', '1st', 3, 'Performance Task', 76.00, 'T250004', '2025-04-13 14:20:03'),
(15, 'S250001', 'GENMATH', '1st', 4, 'Performance Task', 90.00, 'T250004', '2025-04-13 14:20:03'),
(16, 'S250001', 'GENMATH', '1st', 5, 'Performance Task', 82.00, 'T250004', '2025-04-13 14:20:03'),
(17, 'S250001', 'GENMATH', '1st', 6, 'Performance Task', 89.00, 'T250004', '2025-04-13 14:20:03'),
(18, 'S250001', 'GENMATH', '1st', 7, 'Performance Task', 92.00, 'T250004', '2025-04-13 14:20:03'),
(19, 'S250001', 'GENMATH', '1st', 8, 'Performance Task', 65.00, 'T250004', '2025-04-13 14:20:03'),
(25, 'S250001', 'GENMATH', '1st', NULL, 'Midterm Examination', 100.00, 'T250004', '2025-04-13 14:29:18'),
(26, 'S250001', 'GENMATH', '1st', NULL, 'Midterm Examination', 100.00, 'T250004', '2025-04-13 14:29:35'),
(27, 'S250001', 'GENMATH', '1st', NULL, 'Final Examination', 95.00, 'T250004', '2025-04-13 14:29:35'),
(28, 'S250001', 'PEH3', '1st', 1, 'Activity', 100.00, 'T250007', '2025-05-03 14:47:33'),
(29, 'S250001', 'PEH3', '1st', 2, 'Activity', 80.00, 'T250007', '2025-05-03 14:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `badge_color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `activity_type`, `description`, `timestamp`, `badge_color`) VALUES
(1, 'User Updated', 'The user with ID (P250001) has been updated.', '2025-03-23 14:47:27', 'bg-label-warning'),
(2, 'New Parent Added', 'A new Parent (Chico Sheeran) has been added.', '2025-03-23 14:58:41', 'bg-label-success'),
(3, 'New Teacher Added', 'A new Teacher (Jennylyn Ponpon) has been added.', '2025-03-23 15:01:46', 'bg-label-success'),
(4, 'Subject Deleted', 'The subject with code (ORALCOMM) has been deleted.', '2025-03-23 15:03:18', 'bg-label-danger'),
(5, 'Section Updated', 'The section (ICT - A) has been updated to (ICT - A) for grade level 12.', '2025-03-23 15:12:50', 'bg-label-warning'),
(6, 'New Teacher Added', 'A new Teacher (Jennylyn Angelio) has been added.', '2025-04-04 14:09:49', 'bg-label-success'),
(7, 'Section Updated', 'The section (ICT - A) has been updated to (ICT - A) for grade level 12.', '2025-04-13 07:25:14', 'bg-label-warning'),
(8, 'New Section Added', 'A new section (ICT - B) has been added to ICT 12.', '2025-04-13 07:25:42', 'bg-label-success'),
(9, 'New Parent Added', 'A new Parent (Karl Lorenzo) has been added.', '2025-04-13 13:16:23', 'bg-label-success'),
(10, 'New Section Added', 'A new section (ABM -  1) has been added to ABM 11.', '2025-05-02 02:54:35', 'bg-label-success'),
(11, 'New Subject Added', 'A new subject (Earth and Life Science) has been added to CORE.', '2025-05-02 03:38:29', 'bg-label-success'),
(12, 'New Subject Added', 'A new subject (Oral Communication) has been added to CORE.', '2025-05-02 03:39:27', 'bg-label-success'),
(13, 'New Subject Added', 'A new subject (General Math) has been added to CORE.', '2025-05-02 03:39:35', 'bg-label-success'),
(14, 'New Subject Added', 'A new subject (English for Academic and Professional Purposes) has been added to CORE.', '2025-05-02 03:39:42', 'bg-label-success'),
(15, 'New Subject Added', 'A new subject (Oral Communication) has been added to CORE.', '2025-05-02 03:40:11', 'bg-label-success'),
(16, 'New Subject Added', 'A new subject (Reading and Writing) has been added to CORE.', '2025-05-02 03:40:18', 'bg-label-success'),
(17, 'New Subject Added', 'A new subject (Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino) has been added to CORE.', '2025-05-02 03:40:31', 'bg-label-success'),
(18, 'New Subject Added', 'A new subject (Pagbasa at Pagsusuri ng Iba’t-Ibang Teksto Tungo sa Pananaliksik) has been added to CORE.', '2025-05-02 03:40:48', 'bg-label-success'),
(19, 'New Subject Added', 'A new subject (21st Century Literature from the Philippines and the World) has been added to CORE.', '2025-05-02 03:40:59', 'bg-label-success'),
(20, 'New Subject Added', 'A new subject (Contemporary Philippine Arts from the Regions) has been added to CORE.', '2025-05-02 03:41:09', 'bg-label-success'),
(21, 'New Subject Added', 'A new subject (Media and Information Literacy) has been added to CORE.', '2025-05-02 03:41:15', 'bg-label-success'),
(22, 'New Subject Added', 'A new subject (General Math) has been added to CORE.', '2025-05-02 03:41:26', 'bg-label-success'),
(23, 'New Subject Added', 'A new subject (Statistics and Probability) has been added to CORE.', '2025-05-02 03:41:35', 'bg-label-success'),
(24, 'New Subject Added', 'A new subject (Earth and Life Science) has been added to CORE.', '2025-05-02 03:41:42', 'bg-label-success'),
(25, 'New Subject Added', 'A new subject (Physical Science) has been added to CORE.', '2025-05-02 03:41:50', 'bg-label-success'),
(26, 'New Subject Added', 'A new subject (Introduction to the Philosophy of the Human Person) has been added to CORE.', '2025-05-02 03:42:16', 'bg-label-success'),
(27, 'New Subject Added', 'A new subject (Physical Education and Health) has been added to CORE.', '2025-05-02 03:42:35', 'bg-label-success'),
(28, 'New Subject Added', 'A new subject (Personal Development) has been added to CORE.', '2025-05-02 03:42:45', 'bg-label-success'),
(29, 'New Subject Added', 'A new subject (Understanding Culture, Society and Politics) has been added to CORE.', '2025-05-02 03:42:54', 'bg-label-success'),
(30, 'New Subject Added', 'A new subject (Applied Economics) has been added to ABM.', '2025-05-02 03:50:58', 'bg-label-success'),
(31, 'New Subject Added', 'A new subject (Business Ethics and Social Responsibility) has been added to ABM.', '2025-05-02 03:51:27', 'bg-label-success'),
(32, 'New Subject Added', 'A new subject (Fundamentals of Accountancy, Business and Management 1) has been added to ABM.', '2025-05-02 03:51:37', 'bg-label-success'),
(33, 'New Subject Added', 'A new subject (Fundamentals of Accountancy, Business and Management 2) has been added to ABM.', '2025-05-02 03:51:46', 'bg-label-success'),
(34, 'New Subject Added', 'A new subject (Business Math) has been added to ABM.', '2025-05-02 03:52:01', 'bg-label-success'),
(35, 'New Subject Added', 'A new subject (Business Finance) has been added to ABM.', '2025-05-02 03:52:13', 'bg-label-success'),
(36, 'New Subject Added', 'A new subject (Organization and Management) has been added to ABM.', '2025-05-02 03:52:27', 'bg-label-success'),
(37, 'New Subject Added', 'A new subject (Principles of Marketing) has been added to ABM.', '2025-05-02 03:52:48', 'bg-label-success'),
(38, 'New Subject Added', 'A new subject (Work Immersion) has been added to ABM.', '2025-05-02 03:54:01', 'bg-label-success'),
(39, 'New Subject Added', 'A new subject (Pre-Calculus) has been added to STEM.', '2025-05-02 04:05:26', 'bg-label-success'),
(40, 'New Subject Added', 'A new subject (Basic Calculus) has been added to STEM.', '2025-05-02 04:05:34', 'bg-label-success'),
(41, 'New Subject Added', 'A new subject (General Biology 1) has been added to STEM.', '2025-05-02 04:05:43', 'bg-label-success'),
(42, 'New Subject Added', 'A new subject (General Biology 2) has been added to STEM.', '2025-05-02 04:05:51', 'bg-label-success'),
(43, 'New Subject Added', 'A new subject (General Physics 1) has been added to STEM.', '2025-05-02 04:06:16', 'bg-label-success'),
(44, 'New Subject Added', 'A new subject (General Physics 2) has been added to STEM.', '2025-05-02 04:06:24', 'bg-label-success'),
(45, 'New Subject Added', 'A new subject (General Chemistry 1) has been added to STEM.', '2025-05-02 04:06:44', 'bg-label-success'),
(46, 'New Subject Added', 'A new subject (General Chemistry 2) has been added to STEM.', '2025-05-02 04:06:53', 'bg-label-success'),
(47, 'Subject Updated', 'The subject with code (IMMRABM) has been updated to (Work Immersion).', '2025-05-02 04:08:34', 'bg-label-warning'),
(48, 'New Subject Added', 'A new subject (Work Immersion) has been added to STEM.', '2025-05-02 04:10:40', 'bg-label-success'),
(49, 'New Subject Added', 'A new subject (Creative Writing / Malikhaing Pagsulat) has been added to HUMSS.', '2025-05-02 04:11:33', 'bg-label-success'),
(50, 'New Subject Added', 'A new subject (Introduction to World Religions and Belief Systems) has been added to HUMSS.', '2025-05-02 04:11:50', 'bg-label-success'),
(51, 'New Subject Added', 'A new subject (Creative Nonfiction) has been added to HUMSS.', '2025-05-02 04:12:00', 'bg-label-success'),
(52, 'New Subject Added', 'A new subject (Trends, Networks, and Critical Thinking in the 21st Century Culture) has been added to HUMSS.', '2025-05-02 04:12:21', 'bg-label-success'),
(53, 'New Subject Added', 'A new subject (Philippine Politics and Governance) has been added to HUMSS.', '2025-05-02 04:12:38', 'bg-label-success'),
(54, 'New Subject Added', 'A new subject (Community Engagement, Solidarity, and Citizenship) has been added to HUMSS.', '2025-05-02 04:12:47', 'bg-label-success'),
(55, 'New Subject Added', 'A new subject (Disciplines and Ideas in the Social Sciences) has been added to HUMSS.', '2025-05-02 04:13:00', 'bg-label-success'),
(56, 'New Subject Added', 'A new subject (Disciplines and Ideas in the Applied Social Sciences) has been added to HUMSS.', '2025-05-02 04:13:15', 'bg-label-success'),
(57, 'New Subject Added', 'A new subject (Work Immersion) has been added to HUMSS.', '2025-05-02 04:13:27', 'bg-label-success'),
(58, 'New Subject Added', 'A new subject (Work Immersion) has been added to HUMSS.', '2025-05-02 04:14:17', 'bg-label-success'),
(59, 'New Subject Added', 'A new subject (Business Math) has been added to ABM.', '2025-05-02 04:24:47', 'bg-label-success'),
(60, 'New Subject Added', 'A new subject (Organization and Management) has been added to ABM.', '2025-05-02 04:25:37', 'bg-label-success'),
(61, 'New Subject Added', 'A new subject (Fundamentals of Accounting, Business and Management 1) has been added to ABM.', '2025-05-02 04:25:51', 'bg-label-success'),
(62, 'New Subject Added', 'A new subject (Physical Education and Health 2) has been added to CORE.', '2025-05-02 04:28:22', 'bg-label-success'),
(63, 'New Subject Added', 'A new subject (Physical Education and Health 3) has been added to CORE.', '2025-05-02 04:28:34', 'bg-label-success'),
(64, 'New Subject Added', 'A new subject (Physical Education and Health 4) has been added to CORE.', '2025-05-02 04:28:43', 'bg-label-success'),
(65, 'New Subject Added', 'A new subject (Practical Research 1) has been added to CORE.', '2025-05-02 04:29:51', 'bg-label-success'),
(66, 'New Subject Added', 'A new subject (Practical Research 2) has been added to CORE.', '2025-05-02 04:29:56', 'bg-label-success'),
(67, 'New Subject Added', 'A new subject (Fundamentals of Accounting, Business and Management 2) has been added to ABM.', '2025-05-02 04:30:13', 'bg-label-success'),
(68, 'New Subject Added', 'A new subject (Applied Economics) has been added to ABM.', '2025-05-02 04:30:24', 'bg-label-success'),
(69, 'New Subject Added', 'A new subject (Principles of Marketing) has been added to ABM.', '2025-05-02 04:30:34', 'bg-label-success'),
(70, 'New Subject Added', 'A new subject (Entrepreneurship) has been added to CORE.', '2025-05-02 04:31:17', 'bg-label-success'),
(71, 'New Subject Added', 'A new subject (Inquiries, Investigation and Immersion) has been added to CORE.', '2025-05-02 04:32:16', 'bg-label-success'),
(72, 'New Subject Added', 'A new subject (Business Finance) has been added to ABM.', '2025-05-02 04:32:43', 'bg-label-success'),
(73, 'New Subject Added', 'A new subject (Work Immersions/Business Enterprise Simulation) has been added to ABM.', '2025-05-02 04:33:10', 'bg-label-success'),
(74, 'New Subject Added', 'A new subject (Creative Writing/Malikhaing Pagsulat) has been added to HUMSS.', '2025-05-02 04:37:27', 'bg-label-success'),
(75, 'New Subject Added', 'A new subject (Community Engagement, Solidarity, and Citizenship) has been added to HUMSS.', '2025-05-02 04:37:38', 'bg-label-success'),
(76, 'New Subject Added', 'A new subject (Creative Non-Fiction: The Literacy Essay) has been added to HUMSS.', '2025-05-02 04:37:55', 'bg-label-success'),
(77, 'New Subject Added', 'A new subject (Philippine Politics and Governance) has been added to HUMSS.', '2025-05-02 04:38:07', 'bg-label-success'),
(78, 'New Subject Added', 'A new subject (Discipline and Ideas in the Social Sciences ) has been added to HUMSS.', '2025-05-02 04:38:15', 'bg-label-success'),
(79, 'New Subject Added', 'A new subject (Discipline and Ideas in the Applied Social Sciences) has been added to HUMSS.', '2025-05-02 04:38:28', 'bg-label-success'),
(80, 'New Subject Added', 'A new subject (Trend, Networks, and Critical Thinking in the 21st Century Culture) has been added to HUMSS.', '2025-05-02 04:38:38', 'bg-label-success'),
(81, 'New Subject Added', 'A new subject (Culminating Activity/ Career Advocacy/ Work Immersion/ Research ) has been added to HUMSS.', '2025-05-02 04:39:25', 'bg-label-success'),
(82, 'New Subject Added', 'A new subject (Programming 1 (Fundamentals)) has been added to ICT.', '2025-05-02 04:41:23', 'bg-label-success'),
(83, 'New Subject Added', 'A new subject (Programming 2 (HTML5,CSS3 and JavaScript)) has been added to ICT.', '2025-05-02 04:41:31', 'bg-label-success'),
(84, 'New Subject Added', 'A new subject (Introduction to Object Oriented Programming) has been added to ICT.', '2025-05-02 04:41:48', 'bg-label-success'),
(85, 'New Subject Added', 'A new subject (Programming 3 (Developing ASP.NET MVC Application)) has been added to ICT.', '2025-05-02 04:42:21', 'bg-label-success'),
(86, 'New Subject Added', 'A new subject (Programming 4 (JAVA SE)) has been added to ICT.', '2025-05-02 04:42:39', 'bg-label-success'),
(87, 'New Subject Added', 'A new subject (2D Animation 1) has been added to ICT.', '2025-05-02 04:43:03', 'bg-label-success'),
(88, 'New Subject Added', 'A new subject (2D Animation 2) has been added to ICT.', '2025-05-02 04:43:19', 'bg-label-success'),
(89, 'New Subject Added', 'A new subject (Programming 5 (ORACLE)) has been added to ICT.', '2025-05-02 04:43:31', 'bg-label-success'),
(90, 'New Subject Added', 'A new subject (Supervised Industry Training) has been added to ICT.', '2025-05-02 04:43:43', 'bg-label-success'),
(91, 'New Subject Added', 'A new subject (Pre-Calculus) has been added to STEM.', '2025-05-02 04:44:27', 'bg-label-success'),
(92, 'New Subject Added', 'A new subject (Basic Calculus) has been added to STEM.', '2025-05-02 04:44:37', 'bg-label-success'),
(93, 'New Subject Added', 'A new subject (General Chemistry 1) has been added to STEM.', '2025-05-02 04:44:46', 'bg-label-success'),
(94, 'New Subject Added', 'A new subject (General Physics 1) has been added to STEM.', '2025-05-02 04:44:56', 'bg-label-success'),
(95, 'New Subject Added', 'A new subject (General Biology 1) has been added to STEM.', '2025-05-02 04:45:04', 'bg-label-success'),
(96, 'New Subject Added', 'A new subject (General Physics 2 ) has been added to STEM.', '2025-05-02 04:45:22', 'bg-label-success'),
(97, 'New Subject Added', 'A new subject (General Biology 2) has been added to STEM.', '2025-05-02 04:45:31', 'bg-label-success'),
(98, 'New Subject Added', 'A new subject (General Chemistry 2) has been added to STEM.', '2025-05-02 04:45:44', 'bg-label-success'),
(99, 'New Subject Added', 'A new subject (Technical Training/ Work Immersion) has been added to STEM.', '2025-05-02 04:46:01', 'bg-label-success'),
(100, 'New Subject Added', 'A new subject (English for Academic and Professional Purposes) has been added to CORE.', '2025-05-03 02:50:10', 'bg-label-success'),
(101, 'Section Updated', 'The section (ICT - A) has been updated to (ICT - A) for grade level 12.', '2025-05-03 04:58:41', 'bg-label-warning'),
(102, 'Section Updated', 'The section (ICT - B) has been updated to (ICT - B) for grade level 12.', '2025-05-03 04:58:46', 'bg-label-warning'),
(103, 'User Updated', 'The user with ID (P250005) has been updated.', '2025-05-16 02:15:01', 'bg-label-warning'),
(104, 'User Updated', 'The user with ID (P250005) has been updated.', '2025-05-16 02:17:03', 'bg-label-warning');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `recorded_by` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `term` enum('1st','2nd') NOT NULL,
  `week` int(11) NOT NULL,
  `day` enum('day1','day2','day3') NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `subject_code`, `recorded_by`, `created_at`, `term`, `week`, `day`, `status`) VALUES
(25, 'S250001', 'PEH3', 'T250007', '2025-05-03 06:48:21', '1st', 1, 'day1', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `grade` decimal(5,2) DEFAULT NULL CHECK (`grade` between 0 and 100),
  `term` enum('1st','2nd') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `parent_id` varchar(10) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL DEFAULT 'Attendance'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `parent_id`, `student_id`, `message`, `is_read`, `created_at`, `type`) VALUES
(1, 'P250005', 'S250001', 'Your child, John Doe, got a grade of 100 for Activity no. 1 in Physical Education and Health 3.', 0, '2025-05-03 06:47:33', 'Activity'),
(2, 'P250005', 'S250001', 'Your child, John Doe, has been marked as Present in Physical Education and Health 3 today.', 0, '2025-05-03 06:48:21', 'Attendance'),
(3, 'P250005', 'S250001', 'Your child, John Doe, got a grade of 80 for Activity no. 2 in Physical Education and Health 3.', 0, '2025-05-03 06:48:59', 'Activity');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `grade_level` enum('11','12') NOT NULL,
  `strand` enum('ABM','STEM','HUMSS','ICT') NOT NULL,
  `adviser_id` varchar(10) DEFAULT NULL,
  `room` varchar(11) NOT NULL,
  `schedule` varchar(52) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `grade_level`, `strand`, `adviser_id`, `room`, `schedule`, `created_at`) VALUES
(1, 'STEM-A', '12', 'STEM', 'T250001', '201', 'Mon - Fri | 07:00 - 12:00', '2025-03-22 10:12:24'),
(2, 'ABM-B', '12', 'ABM', 'T250002', '301', 'Mon - Fri | 07:00 - 12:00', '2025-03-22 10:12:24'),
(3, 'HUMSS - A', '12', 'HUMSS', 'T250002', '201', 'Mon - Fri | 7:00 - 12:00', '2025-03-23 08:40:22'),
(4, 'ICT - A', '12', 'ICT', 'T250007', '401', 'Mon - Fri | 13:00 - 17:00', '2025-03-23 13:54:44'),
(5, 'ICT - B', '12', 'ICT', 'T250008', '402', 'Mon - Fri | 13:00 - 17:00', '2025-04-13 07:25:42'),
(6, 'ABM -  1', '11', 'ABM', 'T250004', '101', 'Mon - Fri | 07:00 - 12:00', '2025-05-02 02:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `section_subject_teacher`
--

CREATE TABLE `section_subject_teacher` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `teacher_id` varchar(10) NOT NULL,
  `schedule` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section_subject_teacher`
--

INSERT INTO `section_subject_teacher` (`id`, `section_id`, `subject_code`, `teacher_id`, `schedule`) VALUES
(4, 4, 'PEH3', 'T250007', 'Fri 8:00 AM - 9:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `grade_level` enum('11','12') NOT NULL,
  `strand` enum('ABM','STEM','HUMSS','ICT') NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `parent_id` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `address`, `grade_level`, `strand`, `section_id`, `parent_id`, `created_at`) VALUES
('S250001', 'John', 'Omsim', 'Doe', 'Male', '2025-05-03', 'Somewhere out there', '12', 'ICT', 4, 'P250005', '2025-05-03 05:00:32');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `before_insert_students` BEFORE INSERT ON `students` FOR EACH ROW BEGIN
    SET NEW.student_id = CONCAT(
        'S25', 
        LPAD((SELECT COUNT(*) + 1 FROM students), 4, '0')
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `student_id`, `subject_code`) VALUES
(21, 'S250002', '21STLIT'),
(22, 'S250002', 'EALSCI'),
(23, 'S250002', 'EAPP'),
(24, 'S250002', 'GENMATH'),
(25, 'S250002', 'KOMPAN'),
(26, 'S250002', 'ORALCOMM'),
(27, 'S250002', 'PEH1'),
(28, 'S250002', 'PERDEV'),
(29, 'S250002', 'PR1'),
(30, 'S250002', 'APPEC'),
(31, 'S250002', 'FABM1'),
(32, 'S250001', 'PEH3'),
(33, 'S250001', 'PHILO'),
(34, 'S250001', 'PR2'),
(35, 'S250001', 'UCSP'),
(36, 'S250001', '2DANM101'),
(37, 'S250001', 'OOP101'),
(38, 'S250001', 'PROG3'),
(39, 'S250001', 'PROG4');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `strand` enum('ABM','STEM','HUMSS','ICT','CORE') NOT NULL,
  `subject_type` enum('Core','Specialized') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_name`, `strand`, `subject_type`) VALUES
('21STLIT', '21st Century Literature from the Philippines and the World', 'CORE', 'Core'),
('2DANM101', '2D Animation 1', 'ICT', 'Specialized'),
('2DANM102', '2D Animation 2', 'ICT', 'Specialized'),
('3I', 'Inquiries, Investigation and Immersion', 'CORE', 'Core'),
('APPEC', 'Applied Economics', 'ABM', 'Specialized'),
('BASCAL', 'Basic Calculus', 'STEM', 'Specialized'),
('BUSFIN', 'Business Finance', 'ABM', 'Specialized'),
('BUSMATH', 'Business Math', 'ABM', 'Specialized'),
('CESC', 'Community Engagement, Solidarity, and Citizenship', 'HUMSS', 'Specialized'),
('CPAR', 'Contemporary Philippine Arts from the Regions', 'CORE', 'Core'),
('CRNF', 'Creative Non-Fiction: The Literacy Essay', 'HUMSS', 'Specialized'),
('CRWT', 'Creative Writing/Malikhaing Pagsulat', 'HUMSS', 'Specialized'),
('DIASS', 'Discipline and Ideas in the Applied Social Sciences', 'HUMSS', 'Specialized'),
('DISS', 'Discipline and Ideas in the Social Sciences ', 'HUMSS', 'Specialized'),
('EALSCI', 'Earth and Life Science', 'CORE', 'Core'),
('EAPP', 'English for Academic and Professional Purposes', 'CORE', 'Core'),
('ENTREP', 'Entrepreneurship', 'CORE', 'Core'),
('FABM1', 'Fundamentals of Accounting, Business and Management 1', 'ABM', 'Specialized'),
('FABM2', 'Fundamentals of Accounting, Business and Management 2', 'ABM', 'Specialized'),
('GENBIO1', 'General Biology 1', 'STEM', 'Specialized'),
('GENBIO2', 'General Biology 2', 'STEM', 'Specialized'),
('GENCHEM1', 'General Chemistry 1', 'STEM', 'Specialized'),
('GENCHEM2', 'General Chemistry 2', 'STEM', 'Specialized'),
('GENMATH', 'General Math', 'CORE', 'Core'),
('GENPHY1', 'General Physics 1', 'STEM', 'Specialized'),
('GENPHY2', 'General Physics 2 ', 'STEM', 'Specialized'),
('KOMPAN', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 'CORE', 'Core'),
('MIL', 'Media and Information Literacy', 'CORE', 'Core'),
('OOP101', 'Introduction to Object Oriented Programming', 'ICT', 'Specialized'),
('ORALCOMM', 'Oral Communication', 'CORE', 'Core'),
('ORGMAN', 'Organization and Management', 'ABM', 'Specialized'),
('PAGBASA', 'Pagbasa at Pagsusuri ng Iba’t-Ibang Teksto Tungo sa Pananaliksik', 'CORE', 'Core'),
('PEH1', 'Physical Education and Health 1', 'CORE', 'Core'),
('PEH2', 'Physical Education and Health 2', 'CORE', 'Core'),
('PEH3', 'Physical Education and Health 3', 'CORE', 'Core'),
('PEH4', 'Physical Education and Health 4', 'CORE', 'Core'),
('PERDEV', 'Personal Development', 'CORE', 'Core'),
('PHILO', 'Introduction to the Philosophy of the Human Person', 'CORE', 'Core'),
('PHPG', 'Philippine Politics and Governance', 'HUMSS', 'Specialized'),
('PHYSCI', 'Physical Science', 'CORE', 'Core'),
('PR1', 'Practical Research 1', 'CORE', 'Core'),
('PR2', 'Practical Research 2', 'CORE', 'Core'),
('PRECAL', 'Pre-Calculus', 'STEM', 'Specialized'),
('PRINMAR', 'Principles of Marketing', 'ABM', 'Specialized'),
('PROG1', 'Programming 1 (Fundamentals)', 'ICT', 'Specialized'),
('PROG2', 'Programming 2 (HTML5,CSS3 and JavaScript)', 'ICT', 'Specialized'),
('PROG3', 'Programming 3 (Developing ASP.NET MVC Application)', 'ICT', 'Specialized'),
('PROG4', 'Programming 4 (JAVA SE)', 'ICT', 'Specialized'),
('PROG5', 'Programming 5 (ORACLE)', 'ICT', 'Specialized'),
('RNW', 'Reading and Writing', 'CORE', 'Core'),
('SIT', 'Supervised Industry Training', 'ICT', 'Specialized'),
('STATS', 'Statistics and Probability', 'CORE', 'Core'),
('TNCT', 'Trend, Networks, and Critical Thinking in the 21st Century Culture', 'HUMSS', 'Specialized'),
('UCSP', 'Understanding Culture, Society and Politics', 'CORE', 'Core'),
('WRIMABM', 'Work Immersions/Business Enterprise Simulation', 'ABM', 'Specialized'),
('WRIMHUMSS', 'Culminating Activity/ Career Advocacy/ Work Immersion/ Research ', 'HUMSS', 'Specialized'),
('WRIMSTEM', 'Technical Training/ Work Immersion', 'STEM', 'Specialized');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `role` enum('Admin','Teacher','Parent') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `address`, `gender`, `birthdate`, `role`, `password_hash`, `created_at`) VALUES
('P250005', 'Rafael', 'Mancia', 'Suarez', 'rfmsuarez@gmail.com', '09391234567', 'Somewhere out there, somewhere far away', 'Male', '2005-09-29', 'Parent', '$2y$10$pVq1fWOr1jUh9IgK4jcDUuTYC3yMpFAxG/FWlMp7dNFbVDfuHAnhm', '2025-05-03 04:56:05'),
('P250006', 'Chico', 'asdasd', 'Sheeran', 'sheechi@yahooo.com', '09123456789', 'Diyan lang', 'Male', '1965-05-01', 'Parent', '$2y$10$9Q9iDAA02l0xbjaSNNZQWOIaZehNuX8qbWI15UCv8hwFVlnBMdw1O', '2025-05-03 04:57:24'),
('T250007', 'Jennylyn', 'Johnson', 'Brown', 'jenjen@example.com', '09213456789', 'Caloocan City', 'Female', '2025-05-03', 'Teacher', '$2y$10$yF3xtrSf.l6bkFPS7b9AHeh7gHpVaYuq5E1YFVzAs0w66cL0KruYq', '2025-05-03 04:51:44'),
('T250008', 'Robert', 'Johnson', 'Ponpon', 'parkaholic@gmail.com', '09213456789', 'asdasd', 'Male', '2025-05-03', 'Teacher', '$2y$10$Tw6tK/J2RAqJ32BknnrUAuqCg4DfmjL1uq4FjFKrs5z1Ui7YpO3.W', '2025-05-03 04:52:14');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `before_insert_parents` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.role = 'Parent' THEN
        UPDATE user_counters SET count = count + 1 WHERE role = 'Parent';
        SET NEW.user_id = CONCAT('P25', LPAD((SELECT count FROM user_counters WHERE role = 'Parent'), 4, '0'));
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_teachers` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.role = 'Teacher' THEN
        UPDATE user_counters SET count = count + 1 WHERE role = 'Teacher';
        SET NEW.user_id = CONCAT('T25', LPAD((SELECT count FROM user_counters WHERE role = 'Teacher'), 4, '0'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_counters`
--

CREATE TABLE `user_counters` (
  `role` enum('Teacher','Parent') NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_counters`
--

INSERT INTO `user_counters` (`role`, `count`) VALUES
('Teacher', 8),
('Parent', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities_performance_tasks`
--
ALTER TABLE `activities_performance_tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_task` (`student_id`,`subject_code`,`week`,`task_type`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_code` (`subject_code`),
  ADD KEY `recorded_by` (`recorded_by`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `adviser_id` (`adviser_id`);

--
-- Indexes for table `section_subject_teacher`
--
ALTER TABLE `section_subject_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_code` (`subject_code`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `students_ibfk_2` (`section_id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_counters`
--
ALTER TABLE `user_counters`
  ADD PRIMARY KEY (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities_performance_tasks`
--
ALTER TABLE `activities_performance_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section_subject_teacher`
--
ALTER TABLE `section_subject_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`adviser_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `section_subject_teacher`
--
ALTER TABLE `section_subject_teacher`
  ADD CONSTRAINT `section_subject_teacher_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`),
  ADD CONSTRAINT `section_subject_teacher_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`),
  ADD CONSTRAINT `section_subject_teacher_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD CONSTRAINT `student_subjects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subjects_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
