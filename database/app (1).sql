-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 09:21 AM
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
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `userid` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `image` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`userid`, `name`, `mail`, `image`, `password`) VALUES
(16, 'kasun Hewathilaka', 'kasun@gmail.com', '65e1d1f96a3ca.jpg', '$2y$10$b0PinVO17DAcUJW7E.j8c.hv5nufwKS8jb9LS2cV64wck1zgXW5V2'),
(17, 'heshan lahiru', 'heshan@gmail.com', '65e1d274a71f3.jpg', '$2y$10$1AUk8KJroMntw6FwUS8YzuzoDgpcshERgNQ0lxjji/g/ScBsDA1Vq'),
(18, 'dinali dahamsa', 'dinali@gmail.com', '65e28ec72046f.jpg', '$2y$10$Tf1kD53NuzLbUYpFdwnkSOjNGCyNyzLpHWKU387UMabyPGGLwEqim'),
(19, 'kavidu rasanjana', 'kavidu@gmail.com', '65e2a542d0c3b.jpg', '$2y$10$9Rwp/Zy5ezmBgwWEX8A.E.oRY8ut8ssll66kmURan3/jJCcoM8Emu');

-- --------------------------------------------------------

--
-- Table structure for table `likesave`
--

CREATE TABLE `likesave` (
  `likesaveid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `photouploardid` int(11) NOT NULL,
  `liked_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photouplord1`
--

CREATE TABLE `photouplord1` (
  `photouploardid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `textdata` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photouplord1`
--

INSERT INTO `photouplord1` (`photouploardid`, `userid`, `photo`, `textdata`) VALUES
(10, 16, 'uploads/entrepreneur-593358_640.jpg', 'alone life'),
(11, 16, 'uploads/istockphoto-1059661424-612x612.jpg', 'long way always say nothing'),
(12, 17, 'uploads/arm-back-muscles.jpg', 'morning wibs'),
(13, 17, 'uploads/people-875617_640.jpg', 'dark lover'),
(14, 18, 'uploads/65e28ec72046f.jpg', 'good night everyone'),
(15, 18, 'uploads/cute-girl-pic99.jpg', 'not today but tommorow'),
(16, 18, 'uploads/cute-girl-dp179.jpg', 'Hellow everyone'),
(17, 19, 'uploads/a91e2eaf-647e-4c82-bcd2-1ba9a6f05ae6.jpg', 'good evening');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `likesave`
--
ALTER TABLE `likesave`
  ADD PRIMARY KEY (`likesaveid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `photouploardid` (`photouploardid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photouplord1`
--
ALTER TABLE `photouplord1`
  ADD PRIMARY KEY (`photouploardid`),
  ADD KEY `fk_userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `likesave`
--
ALTER TABLE `likesave`
  MODIFY `likesaveid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photouplord1`
--
ALTER TABLE `photouplord1`
  MODIFY `photouploardid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likesave`
--
ALTER TABLE `likesave`
  ADD CONSTRAINT `likesave_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `data` (`userid`),
  ADD CONSTRAINT `likesave_ibfk_2` FOREIGN KEY (`photouploardid`) REFERENCES `photouplord1` (`photouploardid`);

--
-- Constraints for table `photouplord1`
--
ALTER TABLE `photouplord1`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `data` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
