-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 02:25 AM
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
-- Database: `ktg`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `customerName` varchar(150) NOT NULL,
  `companyName` varchar(200) NOT NULL,
  `phoneno` varchar(150) NOT NULL,
  `companyAddress` varchar(255) NOT NULL,
  `country` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  `pincode` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `customerName`, `companyName`, `phoneno`, `companyAddress`, `country`, `state`, `district`, `pincode`) VALUES
(44, 'b', 'b', '1', 'a', 'India', 'Assam', 'Silchar', '1'),
(45, 'asd', 'asd', '1234123234567', 'dfghj', 'United Kingdom', 'dfyui', 'sdf', '123456'),
(46, '123123', 'wer', '123esdrf', 'sdf', 'India', 'Andhra Pradesh', 'Visakhapatnam', 'sdf34'),
(47, '123', 'mwer', '8825921939', '164/E,NEHRU NAGAR,\nVENGAMEDU', 'India', 'Tamil Nadu', '', '639006'),
(48, 'Durga E', '6ff', '08825921939', '164/E,NEHRU NAGAR,\nVENGAMEDU', 'India', 'Tamil Nadu', 'Chennai', '639006');

-- --------------------------------------------------------

--
-- Table structure for table `dailyupdates`
--

CREATE TABLE `dailyupdates` (
  `ID` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `projectTitle` varchar(250) NOT NULL,
  `projectType` varchar(100) NOT NULL,
  `totalDays` varchar(100) NOT NULL,
  `taskDetails` varchar(250) NOT NULL,
  `totalHrs` varchar(100) NOT NULL,
  `actualHrs` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dailyupdates`
--

INSERT INTO `dailyupdates` (`ID`, `date`, `name`, `companyName`, `projectTitle`, `projectType`, `totalDays`, `taskDetails`, `totalHrs`, `actualHrs`) VALUES
(171, '2025-03-15', 'abc', 'q', 'asdfgh', 'q', '123', 'frontend started', '2', '6'),
(172, '2025-03-15', 'abc', 'q', 'asdfgh', 'q', '123', 'asd', '3', '-'),
(173, '2025-03-15', 'asd', 'q', 'fvbgh', 'q', '21', 'f', '7', '8'),
(174, '2025-03-15', 'javavarshini', 'asd', 'dfghiop[', 'website', '10', 'ui-reason', '5', '1'),
(175, '2025-03-15', 'javavarshini', 'q', 'asdfgh', 'q', '123', 'fun', '5', '7'),
(176, '2025-03-17', 'abc', 'q', 'asdfgh', 'q', '123', 'hi hello welcome to ktg', '6', '4'),
(177, '2025-03-17', 'abc', 'q', 'fg', 'q', '12345678', 'hi hello welcome to ktg', '6', '2'),
(178, '2025-03-17', 'abc', 'q', 'fvbgh', 'q', '21', 'frontend started', '3', '2'),
(179, '2025-03-24', 'Angu durgasdfghjk,.', 'asd', 'gg', 'website', '69', 'hi hello welcome to ktg', '3', '-'),
(180, '2025-03-31', 'Angu R', 'asd', 'azsxdcv', 'website', '12', 'hi hello welcome to ktg', '2', '9'),
(181, '2025-04-10', 'Angu R', 'asd', 'azsxdcv', 'website', '12', 'a', '6', '1'),
(182, '2025-04-10', 'Angu R', 'asd', 'azsxdcv', 'website', '12', 'hi hello welcome to ktg', '8', '8');

-- --------------------------------------------------------

--
-- Table structure for table `descriptiontable`
--

CREATE TABLE `descriptiontable` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `projectTitle` varchar(100) NOT NULL,
  `desctitle` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `descriptiontable`
--

INSERT INTO `descriptiontable` (`ID`, `date`, `companyName`, `projectTitle`, `desctitle`, `description`) VALUES
(67, '2025-03-16', 'q', 'fvbgh', 'sdfghjk', 'asdfn'),
(68, '2025-03-20', 'q', 'asdfgh', 'asdfghj', 'suma'),
(69, '2025-03-14', 'asd', 'dfghiop[', 'dfghjkfg', 'fghjdfg dfghjk');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `ID` int(11) NOT NULL,
  `DesignationName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`ID`, `DesignationName`) VALUES
(21, 'lkjhtsa'),
(22, 'a'),
(23, 'z');

-- --------------------------------------------------------

--
-- Table structure for table `employeedetails`
--

CREATE TABLE `employeedetails` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `empPhNo` varchar(10) NOT NULL,
  `empAdd` varchar(250) NOT NULL,
  `empCountry` varchar(50) NOT NULL,
  `empState` varchar(50) NOT NULL,
  `empDistrict` varchar(50) NOT NULL,
  `empPincode` varchar(10) NOT NULL,
  `empPic` varchar(50) NOT NULL,
  `empAadhar` varchar(50) NOT NULL,
  `empPan` varchar(50) NOT NULL,
  `empUserName` varchar(50) NOT NULL,
  `empPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeedetails`
--

INSERT INTO `employeedetails` (`ID`, `Name`, `Designation`, `empPhNo`, `empAdd`, `empCountry`, `empState`, `empDistrict`, `empPincode`, `empPic`, `empAadhar`, `empPan`, `empUserName`, `empPassword`) VALUES
(94, 'bngu R', 'lkjhtsa', '0882592193', '164/E,NEHRU NAGAR,\r\nVENGAMEDU', 'India', 'TN', 'karur', '639006', '', '', '', 'y', 'y'),
(99, 'Angu durgasdfghjk,.', 'lkjhtsa', '0882592193', '164/E,NEHRU NAGAR,\r\nVENGAMEDU', 'Canada', 'TN', 'Coimbatore', '639006', '', '', '', 'k', 'o');

-- --------------------------------------------------------

--
-- Table structure for table `followups`
--

CREATE TABLE `followups` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `updates` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followups`
--

INSERT INTO `followups` (`id`, `date`, `title`, `updates`, `status`) VALUES
(26, '2025-04-10', 'durgaa', 'd', 'ongoing'),
(27, '2025-04-10,2025-04-10', 'durga', 'You want to display each date-update pair inside separate Bootstrap cards.,111111111\n8', 'ongoing'),
(28, '2025-04-10,2025-04-10,2025-04-10', 'dw', 'aa,aww,asd', 'ongoing'),
(29, '2025-04-10', 'kurinji cements kurinji cementskurinji cements', 'kurinji cements kurinji cements kurinji cements', 'ongoing'),
(30, '2025-04-10', 'a', 'a', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `followuptype`
--

CREATE TABLE `followuptype` (
  `ID` int(11) NOT NULL,
  `FollowuptypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followuptype`
--

INSERT INTO `followuptype` (`ID`, `FollowuptypeName`) VALUES
(18, 'payment'),
(19, 'ongoing'),
(20, 'new_client'),
(21, 'suma'),
(22, 's');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `name`, `username`, `password`) VALUES
(2, 'admin', '147258', '147258');

-- --------------------------------------------------------

--
-- Table structure for table `projectcreation`
--

CREATE TABLE `projectcreation` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `companyName` varchar(20) NOT NULL,
  `projectType` varchar(30) NOT NULL,
  `totalDays` varchar(10) NOT NULL,
  `projectTitle` varchar(225) NOT NULL,
  `employees` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `reqfile` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectcreation`
--

INSERT INTO `projectcreation` (`ID`, `date`, `companyName`, `projectType`, `totalDays`, `projectTitle`, `employees`, `description`, `reqfile`) VALUES
(62, '2025-03-14', 'q', 'q', '21', 'fvbgh', 'abc,asd,qaz', 'durga', 'reqfiles/tree2.jpg'),
(63, '2025-03-14', 'q', 'q', '12', 'qwertertf', 'abc', 'asdfg', 'reqfiles/DECLARATION LETTER.pdf'),
(66, '2025-03-15', 'q', 'q', '12345678', 'fg', 'abc', 'd', 'reqfiles/l.jpg'),
(67, '2025-03-15', 'asd', 'q', '123', 'asdfgh', 'abc,javavarshini', 'MADURAI: Madras high court on Thursday set aside the order of the single bench which had allowed a plea seeking to perform angapradakshinam (roll over) on the banana leaves after the devotees have partaken their food on the eve of Jeeva Samathi day of Sri Sadasiva Brahmendral situated in Nerur village in Karur district.\r\nA division bench of Justice R Suresh Kumar and Justice G Arul Murugan observed that whether such a practice of rolling over plantain leaves would go against public or constitutional morality cannot be decided by this court at this juncture since issue in a similar matter arising out of the Karnataka high court has been seized of and pending with the order of stay before the Supreme Court.\r\nThe judge observed that since a 2015 division bench judgment of Madras high court had already attained finality and being the judgment of the higher forum (division bench) the same cannot be nullified by a lesser forum (single bench). The decision of the single bench in this regard cannot be approved by this court. Hence, the judges set aside the order of the single bench.', 'reqfiles/Doc1.docx'),
(68, '2025-03-15', 'asd', 'website', '10', 'dfghiop[', 'asd,javavarshini', 'cvghjkop', 'reqfiles/img_203390_3950e9d2_1678383199711_sc.jpg'),
(69, '2025-03-22', 'asd', 'website', '12', 'azsxdcv', 'Angu R', 'df', 'reqfiles/Screenshot (804).png'),
(70, '2025-03-24', 'asd', 'website', '69', 'gg', 'Angu durgasdfghjk,.', 'ggg', NULL),
(71, '2025-04-09', 'asd', 'website', '78', 'qwertertf', 'Angu durgasdfghjk,.', 'i', NULL),
(72, '2025-04-10', 'b', '', '', '', '', '', NULL),
(73, '2025-04-10', '', '', '', '', '', '', NULL),
(74, '2025-04-10', '', '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projecttype`
--

CREATE TABLE `projecttype` (
  `ID` int(11) NOT NULL,
  `ProjecttypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projecttype`
--

INSERT INTO `projecttype` (`ID`, `ProjecttypeName`) VALUES
(52, 'q'),
(53, 'website');

-- --------------------------------------------------------

--
-- Table structure for table `reqtable`
--

CREATE TABLE `reqtable` (
  `ID` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `projectTitle` varchar(225) NOT NULL,
  `reqfile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reqtable`
--

INSERT INTO `reqtable` (`ID`, `companyName`, `projectTitle`, `reqfile`) VALUES
(2, 'q', 'fvbgh', 'reqfiles/l.jpg'),
(3, 'q', 'fvbgh', 'reqfiles/e.jpg'),
(5, 'q', 'fg', 'reqfiles/e.jpg'),
(6, 'q', 'fg', 'reqfiles/e.jpg'),
(7, 'q', 'fg', 'reqfiles/e.jpg'),
(8, 'q', 'fvbgh', 'reqfiles/manager_document.docx'),
(9, 'q', 'asdfgh', 'reqfiles/l.jpg'),
(10, 'q', 'asdfgh', 'reqfiles/img_203390_3950e9d2_1678383199711_sc.jpg'),
(12, 'asd', 'dfghiop[', 'reqfiles/e.jpg'),
(13, 'asd', 'qwertertf', 'reqfiles/1.png'),
(18, 'asd', 'azsxdcv', 'reqfiles/4.png');

-- --------------------------------------------------------

--
-- Table structure for table `userrights`
--

CREATE TABLE `userrights` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `rights` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrights`
--

INSERT INTO `userrights` (`ID`, `name`, `module`, `rights`) VALUES
(14, 'javavarshini', 'Customer', 'View'),
(15, 'Angu R', 'FollowUps', 'Update,Delete'),
(16, 'Angu R', 'Customer', 'Add,Delete'),
(17, 'Angu R', 'Employee', 'Add'),
(18, 'Angu R', 'Designation', 'Add,Update');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dailyupdates`
--
ALTER TABLE `dailyupdates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `descriptiontable`
--
ALTER TABLE `descriptiontable`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employeedetails`
--
ALTER TABLE `employeedetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `followups`
--
ALTER TABLE `followups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followuptype`
--
ALTER TABLE `followuptype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projectcreation`
--
ALTER TABLE `projectcreation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projecttype`
--
ALTER TABLE `projecttype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reqtable`
--
ALTER TABLE `reqtable`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userrights`
--
ALTER TABLE `userrights`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `dailyupdates`
--
ALTER TABLE `dailyupdates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `descriptiontable`
--
ALTER TABLE `descriptiontable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employeedetails`
--
ALTER TABLE `employeedetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `followups`
--
ALTER TABLE `followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `followuptype`
--
ALTER TABLE `followuptype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projectcreation`
--
ALTER TABLE `projectcreation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `projecttype`
--
ALTER TABLE `projecttype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reqtable`
--
ALTER TABLE `reqtable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userrights`
--
ALTER TABLE `userrights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
