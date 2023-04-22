-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 10:59 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbidea`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(255) NOT NULL,
  `CUserID` int(255) NOT NULL,
  `IdeaID` int(255) NOT NULL,
  `CommentDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `CUserID`, `IdeaID`, `CommentDescription`) VALUES
(26, 13, 71, 'check 1');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `ideaID` int(255) NOT NULL,
  `Description` text NOT NULL,
  `authorID` int(255) NOT NULL,
  `likes` int(255) DEFAULT 0,
  `authorDP` varchar(255) NOT NULL,
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`ideaID`, `Description`, `authorID`, `likes`, `authorDP`, `Category`) VALUES
(70, 'work time is too long ', 13, 0, 'InformationTechnology', 'Schedule'),
(71, 'Great management', 1, 0, 'InformationTechnology', 'Management'),
(72, 'our work time is sucks so bad lkjsndlwnedfwedw', 13, 0, 'InformationTechnology', 'Schedule'),
(73, 'wadqwdq', 13, 0, 'InformationTechnology', 'Schedule');

-- --------------------------------------------------------

--
-- Table structure for table `likedislikerecord`
--

CREATE TABLE `likedislikerecord` (
  `VUserID` int(11) NOT NULL,
  `VIdeaID` int(11) NOT NULL,
  `VoteType` varchar(255) NOT NULL,
  `VoteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likedislikerecord`
--

INSERT INTO `likedislikerecord` (`VUserID`, `VIdeaID`, `VoteType`, `VoteID`) VALUES
(1, 46, '-1', 82),
(1, 47, '1', 83),
(13, 50, '-1', 84),
(13, 51, '-1', 85),
(13, 67, '-1', 86);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` text NOT NULL,
  `Roles` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Email`, `Password`, `Name`, `Roles`, `Department`) VALUES
(1, 'DMIT@gmail.com', '123', 'DPInformationT\r\n', 'DPManager', 'InformationTechnology'),
(2, 'Admin@gmail.com', '123', 'Admin', 'Admin', ''),
(13, 'staffIT@gmail.com', '123', 'StaffIT', 'Normal', 'InformationTechnology'),
(14, 'DPCUL@gmail.com', '123', 'DPCulinary', 'DPManager', 'Culinary'),
(15, 'staffCUL@gmail.com', '123', 'StaffCulinary', 'Normal', 'Culinary'),
(17, 'DPBUS@gmail.com', '123', 'DPBusiness', 'DPManager', 'Business'),
(18, 'staffBUS@gmail.com', '123', 'StaffBusiness', 'Normal', 'Business');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `CUserID` (`CUserID`),
  ADD KEY `IdeaID` (`IdeaID`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`ideaID`),
  ADD KEY `authorID` (`authorID`);

--
-- Indexes for table `likedislikerecord`
--
ALTER TABLE `likedislikerecord`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `VIdeaID` (`VIdeaID`),
  ADD KEY `VUserID` (`VUserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `ideaID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `likedislikerecord`
--
ALTER TABLE `likedislikerecord`
  MODIFY `VoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
