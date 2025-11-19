-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `habitrack_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `free_text` text NOT NULL,
  `steps` int(11) DEFAULT NULL,
  `caffeine` int(11) DEFAULT NULL,
  `sleep_time` time DEFAULT NULL,
  `sleep_hours` decimal(4,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `free_text`, `steps`, `caffeine`, `sleep_time`, `sleep_hours`, `created_at`) VALUES
(123, 2, 'Slept 7 hours, walked 8000 steps, had 2 cups of coffee', 8000, 190, '23:00:00', 7.00, '2025-11-10 06:00:00'),
(124, 2, 'Quick morning jog 5 km, 1 cup of coffee, slept 6.5 hours', 6000, 95, '23:30:00', 6.50, '2025-11-11 05:30:00'),
(125, 2, 'Relaxed day, watched TV, walked 2500 steps, no coffee', 2500, 0, '00:00:00', 8.00, '2025-11-12 06:00:00'),
(126, 2, 'Productive work day, walked 12000 steps, 3 cups of coffee', 12000, 285, '22:30:00', 6.75, '2025-11-13 05:45:00'),
(127, 3, 'Slept 8 hours, walked 7000 steps, drank 1 cup coffee', 7000, 95, '23:15:00', 8.00, '2025-11-10 06:00:00'),
(128, 3, 'Night out with friends, walked 1000 steps, had 2 coffee', 1000, 200, NULL, NULL, '2025-11-11 06:30:00'),
(129, 3, 'Lazy Sunday, walked 2000 steps, no coffee, slept 9 hours', 2000, 0, '00:30:00', 9.00, '2025-11-12 07:00:00'),
(130, 3, 'Morning run, 9000 steps, 1 cup coffee, slept 7 hours', 9000, 95, '22:45:00', 7.00, '2025-11-13 05:00:00'),
(131, 3, 'Slept 6 hours, walked 7000 steps, had 1 cup coffee', 7000, 95, '00:00:00', 6.00, '2025-11-10 06:00:00'),
(132, 3, 'Walked 10000 steps, drank 3 coffee, slept 8 hours', 10000, 285, '23:30:00', 8.00, '2025-11-11 05:45:00'),
(133, 3, 'Quick log: 12000 steps, 4 cups of coffee, slept 7 hours', 12000, 380, '22:45:00', 7.00, '2025-11-12 05:30:00'),
(134, 3, 'Relaxing evening, 3000 steps, 1 cup coffee, slept 7.5 hours', 3000, 95, '23:00:00', 7.50, '2025-11-13 06:15:00'),
(135, 2, 'Slept 7.5 hours, walked 6000 steps, 2 cups coffee', 6000, 190, '23:15:00', 7.50, '2025-11-10 06:00:00'),
(136, 2, 'Quick morning walk 4 km, no coffee, slept 7 hours', 4000, 0, '23:45:00', 7.00, '2025-11-11 05:30:00'),
(137, 2, 'Workday, walked 11000 steps, 3 cups coffee, slept 6.5 hours', 11000, 285, '22:30:00', 6.50, '2025-11-12 05:45:00'),
(138, 3, 'Relaxed day, 2000 steps, 1 cup coffee, slept 8 hours', 2000, 95, '00:00:00', 8.00, '2025-11-13 06:00:00'),
(139, 3, 'Evening walk, 5000 steps, 1 cup coffee, slept 6.5 hours', 5000, 95, '23:15:00', 6.50, '2025-11-14 05:30:00'),
(140, 3, 'Gym session, 8000 steps, 2 cups coffee, slept 7 hours', 8000, 190, '22:45:00', 7.00, '2025-11-14 05:00:00'),
(141, 3, 'Movie night, 1500 steps, 1 cup coffee, slept 8 hours', 1500, 95, '00:30:00', 8.00, '2025-11-14 06:30:00'),
(142, 2, 'Morning run, 9000 steps, 2 cups coffee, slept 7.5 hours', 9000, 190, '23:00:00', 7.50, '2025-11-14 05:45:00'),
(143, 3, 'i walked 10 steps and drank 3 cup of coffee', 10, 480, NULL, NULL, '2025-11-18 18:52:37'),
(145, 3, 'walked 20 km and slept at 8 am', 26000, 0, '08:00:00', NULL, '2025-11-18 19:59:12'),
(146, 3, 'walked 200 step', 200, 0, NULL, NULL, '2025-11-18 19:59:40'),
(148, 3, 'Quick log: 233 steps; 2 cups of coffee; slept from 02:23 to 12:02;', 233, 320, '02:23:00', 9.65, '2025-11-19 15:02:14'),
(152, 3, 'Quick log: 32 steps; 1 cups of coffee; slept from 14:12 to 00:22;', 32, 95, '14:12:00', 10.17, '2025-11-19 15:21:14'),
(160, 3, 'Quick log: 22 steps; 2 cups of coffee; slept from 14:22 to 02:22;', 22, 320, '14:22:00', 12.00, '2025-11-19 16:25:41'),
(161, 3, 'i walked 1000 step today', 1000, NULL, NULL, NULL, '2025-11-19 16:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `habits`
--

CREATE TABLE `habits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `habits`
--

INSERT INTO `habits` (`id`, `user_id`, `name`, `target`, `status`, `created_at`) VALUES
(10, 3, 'Reading', '15 pages', 0, '2025-11-14 07:00:00'),
(11, 3, 'Workout', '30 minutes', 0, '2025-11-16 08:00:00'),
(12, 3, 'Practice Instrument', '2 hour', 1, '2025-11-18 09:30:00'),
(13, 3, 'Water', '2 liters', 1, '2025-11-20 10:00:00'),
(14, 2, 'Meditation', '10 minutes', 1, '2025-11-14 06:45:00'),
(15, 2, 'Walking', '5000 steps', 1, '2025-11-16 07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Test User', 'test@example.com', '$2y$10$lj2txYxqCogLNitNMLgwY.wFCyqrVrb58HQ17MOYp4nZczkWmE7gS', 'user', '2025-11-14 09:42:08'),
(3, 'joya', 'gergessjoya@gmail.com', '$2y$10$EXVGLEYpfhTEaqo3zKttIeUZx1ETmpnvSN19gAafDBL.SZDMT5kE6', 'user', '2025-11-14 15:38:06'),
(6, 'Admin', 'admin@gmail.com', '$2y$10$in6g8Nz1B5kqxqQgDzwQZexIcBQTfvgynQ9JDboCmHbdfJ26NTJfy', 'admin', '2025-11-17 10:53:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `habits`
--
ALTER TABLE `habits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `habits`
--
ALTER TABLE `habits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `habits`
--
ALTER TABLE `habits`
  ADD CONSTRAINT `habits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
