-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2021 m. Sau 28 d. 06:05
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pirma`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `gender` enum('vyras','moteris') NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `birthday` date NOT NULL,
  `education` varchar(64) NOT NULL,
  `salary` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `employees`
--

INSERT INTO `employees` (`id`, `name`, `surname`, `gender`, `phone`, `birthday`, `education`, `salary`) VALUES
(1, 'Jonas', 'Jonaitis', 'vyras', '+37062587411', '1985-02-02', 'Aukštasis', '1234.58'),
(2, 'Petras', 'Petraitis', 'vyras', '+37062587333', '1983-05-29', 'Aukštasis', '1220.13'),
(3, 'Ona', 'Onute', 'moteris', '+37061258962', '1992-08-20', 'Vidurinis', '1214.52'),
(4, 'Andrius', 'Andrijauskas', 'vyras', '+37060179000', '1985-03-07', 'Aukštasis', '1300.25'),
(6, 'Lina', 'Linute', 'moteris', '+37060179222', '1992-09-25', 'Vidurinis', '1203.52'),
(7, 'Marius', 'Andrijauskas', 'vyras', '+37063333333', '1983-04-13', 'Vidurinis', '1236.14'),
(8, 'Vutautas', 'Kazlauskas', 'vyras', '+37062598523', '1986-05-23', 'Vidurinis', '1325.25'),
(9, 'Mindaugas', 'Jonaitis', 'vyras', '+37062511111', '1982-03-07', 'Aukštasis', '1253.14'),
(10, 'Kristina', 'Petraite', 'moteris', '+37060179888', '1986-04-05', 'Aukštasis', '1201.32'),
(14, 'Lina', 'Nerijauskaitė', 'vyras', '+37061258962', '0000-00-00', 'Vidurinis', '852.00'),
(15, 'Jonas', 'Kazimieras', 'vyras', '+37061212154', '0000-00-00', 'Vidurinis', '1203.63');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
