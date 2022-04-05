-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 11:44 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `targetpath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `password`, `location`, `description`, `targetpath`) VALUES
('img_5e4cd9382cdd5', '', '', '', 'Enter something about yourself', 'IMG_UPLOAD\\img_5e4cd9382cdd5.png'),
('img_5e4cd95fca872', 'Tushar12', '1234', 'Jabalpur', 'hello tghere', 'IMG_UPLOAD\\img_5e4cd95fca872.png'),
('u_5e4d0aff9e901', 'Rohit Soni', '', 'Jabalpur', 'Enter something about yourself', 'IMG_UPLOAD\\img_5e4d0aff9e905.png'),
('u_5e4d106cf3d4e', 'Tushar12', '', '', 'Enter something about yourself', 'IMG_UPLOAD\\img_5e4d106cf3d57.'),
('u_5e4d112ecad85', 'Tushar12', '', '', 'Enter something about yourself', 'IMG_UPLOAD\\img_5e4d112ecad95.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
