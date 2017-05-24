-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2017 at 10:58 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `companyDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `n_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`n_id`, `title`, `content`, `date`) VALUES
(2, 'first news', 'test', '2017-05-23 23:19:35'),
(4, 'test', 'test', '2017-05-24 19:47:06'),
(5, 'test', 'test', '2017-05-24 19:47:14'),
(6, 'test', 'test', '2017-05-24 19:47:20'),
(7, 'test', 'test', '2017-05-24 19:47:25'),
(8, 'test', 'test', '2017-05-24 19:47:33'),
(9, 'test', 'test', '2017-05-24 19:47:37'),
(10, 'test', 'test', '2017-05-24 19:47:41'),
(11, 'test', 'test', '2017-05-24 19:47:46'),
(12, 'test', 'test', '2017-05-24 19:48:04'),
(13, 'test', 'test', '2017-05-24 19:52:48'),
(14, 'test', 'test', '2017-05-24 19:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `p_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`p_id`, `title`, `content`) VALUES
(2, 'about us', 'test'),
(3, 'about us', 'test'),
(13, 'test', 'tset'),
(17, 'test', 'test'),
(18, 'test', 'test'),
(19, 'test', 'test'),
(20, 'test', 'test'),
(21, 'test', 'test'),
(22, 'test', 'test'),
(23, 'test', 'test'),
(24, 'test', 'test'),
(25, 'test', 'test'),
(26, 'test', 'test'),
(27, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `site_name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `facebook_link` varchar(30) NOT NULL,
  `twitter_link` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `site_name`, `phone`, `facebook_link`, `twitter_link`) VALUES
(1, 'admin@gmail.com', 'company website', '1234567890', 'facebook/website', 'twitter/website');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_pages` int(11) NOT NULL,
  `access_news` int(11) NOT NULL,
  `access_users` int(11) NOT NULL,
  `access_settings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `access_pages`, `access_news`, `access_users`, `access_settings`) VALUES
(22, 'yomna', '70b5992d48a5ccb513904387832b6dec99c32e4f', 1, 1, 1, 1),
(23, 'fardoos', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 1, 0, 1),
(24, 'foda', '70b5992d48a5ccb513904387832b6dec99c32e4f', 1, 0, 1, 0),
(25, 'doaa', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 1, 0, 0),
(26, 'mariam', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(27, 'mona', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(28, 'hossam', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(29, 'ahmed', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(30, 'atta', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(31, 'eman', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 1),
(32, 'islam', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 1, 0),
(33, 'user', '70b5992d48a5ccb513904387832b6dec99c32e4f', 0, 0, 0, 0),
(34, 'admin', '70b5992d48a5ccb513904387832b6dec99c32e4f', 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
