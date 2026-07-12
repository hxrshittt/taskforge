-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jul 12, 2026 at 04:38 PM
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
-- Database: `taskforge`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_by`, `created_at`) VALUES
(1, 'City Suvidha – Smart Municipality Complaint Management System', 'City Suvidha is a web-based complaint management system designed to bridge the gap between citizens and municipal authorities. The platform allows users to easily report civic issues such as road damage, garbage accumulation, water leakage, or streetlight failures by submitting complaints along with images, descriptions, and precise location data using map integration.\r\n\r\nOn the user side, the system focuses on simplicity and transparency. Citizens can submit complaints with real-time location tagging and track the status of their requests from submission to resolution. They also receive notifications when their complaint is being processed or resolved, along with before-and-after image proof for better trust and accountability.\r\n\r\nOn the administrative side, complaints are automatically assigned to municipal officers based on geographic location. Officers can view assigned tasks, update the complaint status (e.g., “in progress” or “resolved”), and upload visual proof of work completion. The system ensures role-based access, where sensitive user information such as contact details is hidden from officers, maintaining privacy.\r\n\r\nOverall, City Suvidha aims to create a more efficient, transparent, and accountable municipal service system by leveraging digital tools, real-time tracking, and automated workflows.', 3, '2026-04-30 13:47:30'),
(2, 'demo', 'demo', 3, '2026-04-30 14:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(4, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `assigned_to`, `status`, `deadline`, `created_at`) VALUES
(1, 'front-end', NULL, 1, 1, 'pending', '2026-05-27', '2026-04-30 13:48:02'),
(2, 'testing', NULL, 1, 3, 'pending', '2026-05-08', '2026-04-30 13:48:39'),
(3, 'demo', NULL, 1, 5, 'in_progress', '2026-04-18', '2026-04-30 14:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','member') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'harshit', 'harshitprabtani007@gmail.com', '$2y$10$xBSym3Tcn36mKq88XnaYD.6Epq8Rig/miQMUsgE9NSP6ISSqNrqu6', 'admin', '2026-04-30 12:47:56'),
(3, 'hardy', 'admin@gmail', '$2y$10$jhpudhVrRrb/8hihtZduW.7522Hz0OjTewTEwMLsfcDGOM3fGb2O.', 'admin', '2026-04-30 13:15:01'),
(4, 'dharmik', 'dharmik@gmail.com', '$2y$10$/5QlydDRNXNIzWkE9plqtOzT6tiJtLI/G2Sd6gv2ZNhOfj2TjG6I6', 'member', '2026-04-30 14:22:44'),
(5, 'myra', 'myra@gmail.com', '$2y$10$hm5j9vLY3/EDGO5bouusuu78AJOOQriZR0fKk5ypi6a.pS1D2Svpi', 'member', '2026-04-30 14:23:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
