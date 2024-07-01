-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 02:34 PM
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
-- Database: `cleaner_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cleaner`
--

CREATE TABLE `cleaner` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cleaner`
--

INSERT INTO `cleaner` (`id`, `filename`, `name`, `price`) VALUES
(39, '20240422_220626-2180909420.webp', 'lee jeno', '199000.00'),
(40, '39f24229-6f26-4a17-aa92-44c3bd3dae9e_43.jpeg', 'hasanudin', '150000.00'),
(41, 'headline-tes-kepribadian-sederhana-kamu-orang-yang-seperti-apa-sih.jpg', 'mala', '120000.00'),
(42, 'renjun-nct-2.jpeg', 'huang renjun', '130000.00'),
(43, 'g_m_a_manis_melepas_dahaga_10_foto_chenle_nct_dream_yang_visualnya_paling_segar_bak_es_kelapa_muda_p_chenle_nct_dream-20210702-003-non_fotografer_kly.jpg', 'zhong chelee', '125000.00'),
(44, 'jisung-nctfoto-instagramcommctdream_11.jpeg', 'park jisung', '100000.00'),
(45, 'haechan-nct_230305105916-173.jpeg', 'lee haechan', '150000.00'),
(46, 'g_1_0_10_potret_jaemin_nct_dream_idol_-_aktor_pertama_nct_yang_visualnya_bikin_gak_bisa_berpaling_p_jaemin_nct_dream-20200917-008-non_fotografer_kly.jpg', 'na jaemin', '170000.00'),
(47, '07bb76ea52b30003c6c91fb52721767e.jpg', 'mark lee', '165000.00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`name`, `email`, `phone`, `service`, `message`, `id`) VALUES
('coba', 'coba@gmail.com', '098273472424', 'House Cleaning', 'help me Cleaning my house', 1),
('test', 'test@gmail.com', '081838174741', 'House Cleaning', 'Helppp meee', 2),
('dewi', 'dewi@gmail.com', '12345678', 'HouseClean', 'hahahhahahahah lucu', 3),
('dewi', 'dewi@gmail.com', '12345678', 'FurnitureClean', 'pleaseeee', 5),
('haloooo', 'dewi@gmail.com', '12345678', 'BathroomClean', '11131313dasdsafafsfsa', 6);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cleaner_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`, `create_at`, `role`) VALUES
(1, 'admin@admin.com', '123456', 'admin', '2024-06-30 06:31:03', 'admin'),
(2, 'dewi@gmail.com', '123456', 'dewi', '2024-06-30 06:31:33', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cleaner`
--
ALTER TABLE `cleaner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_id` (`cleaner_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cleaner`
--
ALTER TABLE `cleaner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaner` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
