-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 

Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 05:22 AM
-- 

Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ers`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `EmpPRIns` (IN `id` VARCHAR(8), IN `Comm` FLOAT, IN `Prod` FLOAT, IN `Crea` FLOAT, IN `Inte` FLOAT, IN `Punc` FLOAT, IN `Atte` FLOAT, IN `IncSaP` FLOAT, IN `ImpCS` FLOAT, IN `SettMSG` FLOAT)  BEGIN
declare com, pr float;
set Comm = Comm/5;
set Prod = Prod/5;
set Crea = Crea/5;
set Inte = Inte/5;
set Punc = Punc/5;
set Atte = Atte/5;
set IncSaP = IncSap/5;
set ImpCS = ImpCS/5;
set SettMSG = SettMSG/5;

set com = ((Comm + Prod + Crea + Inte + Punc + Atte)/6)*5;
set pr = ((IncSap + ImpCS + SettMSG)/3)*5;

update ERS.PR set Compete=com, PerGoals=pr where Empid=id;
END$$

DELIMITER ;



-- --------------------------------------------------------

--
-- Table structure for table `department`

--

CREATE TABLE `department` (
  `DeptID` int(5) NOT NULL,
  `DeptName` varchar(30) DEFAULT NULL,
  `DeptLoc` varchar(30) DEFAULT NULL,
  `MgrID` varchar(8) DEFAULT NULL,
  `HRID` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptID`, `DeptName`, `DeptLoc`, `MgrID`, `HRID`) VALUES
(1, 'Production', 'Mysuru', 'M001', 'H001'),
(2, 'Marketing', 'Mysuru', 'M002', 'H002'),
(3, 'Sales', 'Mysuru', 'M003', 'H003'),
(4, 'R&D', 'Mysuru', 'M004', 'H004');


-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` varchar(8) NOT NULL,
  `EmpName` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Phone` bigint(20) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `SupID` varchar(8) DEFAULT NULL,
  `DeptID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `EmpName`, `DOB`, `Address`, `Gender`, `Phone`, `Salary`, `SupID`, `DeptID`) VALUES
('E010', 'Raj Rajesh', '1999-12-06', 'mysuru', 'M', 9876543219, '650000.00', 'S001', 1),
('E011', 'andis', '1999-11-11', 'mysuru', 'M', 6366685091, '700000.00', NULL, 1),
('H001', 'Narendra Krishna', '1999-10-24', 'Mysuru', 'M', 9873625718, '900000.00', NULL, 1),
('H002', 'Ritu Mohanty', '1998-07-14', 'Mysuru', 'F', 9546372815, '900000.00', NULL, 2),
('H003', 'Ayush Divan', '1997-05-14', 'Mysuru', 'M', 9536271561, '900000.00', NULL, 3),
('H004', 'Shanti Kata', '1998-09-25', 'Mysuru', 'F', 6826349164, '900000.00', NULL, 4),
('M001', 'Hrithik Parmar', '1998-01-12', 'Mysuru', 'M', 9378123123, '900000.00', NULL, 1),
('M002', 'Aparna Acharya', '1999-04-17', 'Mysuru', 'F', 6713846818, '1000000.00', NULL, 2),
('M003', 'Sudhir Shankar', '1997-06-25', 'Mysuru', 'M', 6718487611, '800000.00', NULL, 3),
('M004', 'Rakesh Amble', '1998-07-29', 'Mysuru', 'M', 9876543218, '11000000.00', NULL, 4),
('S001', 'Purnima Chawla', '1996-07-29', 'Mysuru', 'F', 9216783618, '700000.00', NULL, 1),
('S002', 'Rashmi Chowdhury', '1998-09-30', 'Mysuru', 'F', 9643728467, '700000.00', NULL, 2),
('S003', 'Chetan Jha', '1999-10-25', 'Mysuru', 'M', 9278912378, '700000.00', NULL, 3),
('S004', 'Amar Mangat', '1999-11-10', 'Mysuru', 'M', 9163472524, '700000.00', NULL, 4);


-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `EmpID` varchar(8) NOT NULL,
  `Comm` int(11) DEFAULT NULL,
  `Prod` int(11) DEFAULT NULL,
  `Crea` int(11) DEFAULT NULL,
  `Inte` int(11) DEFAULT NULL,
  `Punc` int(11) DEFAULT NULL,
  `Atte` int(11) DEFAULT NULL,
  `IncSaP` int(11) DEFAULT NULL,
  `ImpCS` int(11) DEFAULT NULL,
  `SettMSG` int(11) DEFAULT NULL,
  `Compete` float DEFAULT NULL,
  `PerGoals` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pr`
--

INSERT INTO `pr` (`EmpID`, `Comm`, `Prod`, `Crea`, `Inte`, `Punc`, `Atte`, `IncSaP`, `ImpCS`, `SettMSG`, `Compete`, `PerGoals`) VALUES
('E010', 4, 3, 2, 3, 4, 3, 5, 4, 4, 3.16667, 4.33333),
('E011', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('H001', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('H002', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('H003', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('H004', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('M001', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('M002', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('M003', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('M004', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('S001', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('S002', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('S003', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
('S004', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0);


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ProjID` int(5) NOT NULL,
  `ProjName` varchar(30) DEFAULT NULL,
  `ProjLoc` varchar(30) DEFAULT NULL,
  `ProjBudg` decimal(10,2) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `DeptID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjID`, `ProjName`, `ProjLoc`, `ProjBudg`, `StartDate`, `DueDate`, `DeptID`) VALUES
(123, 'Flaps2', 'mysuru', '5000000.00', '2019-06-07', '2022-07-12', 1),
(1001, 'Turbine', 'Mysuru', '5000000.00', '2019-10-23', '2020-01-15', 1),
(67214, 'Flaps', 'mysuru', '6000000.00', '2019-12-05', '2022-12-12', 1);


-- --------------------------------------------------------

--
-- Table structure for table `workson`
--

CREATE TABLE `workson` (
  `EmpID` varchar(8) NOT NULL,
  `ProjID` int(5) NOT NULL,
  `Hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workson`
--

INSERT INTO `workson` (`EmpID`, `ProjID`, `Hours`) VALUES
('E010', 123, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptID`),
  ADD KEY `MgrID` (`MgrID`),
  ADD KEY `HRID` (`HRID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `SupID` (`SupID`),
  ADD KEY `DeptID` (`DeptID`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ProjID`),
  ADD KEY `DeptID` (`DeptID`);

--
-- Indexes for table `workson`
--
ALTER TABLE `workson`
  ADD PRIMARY KEY (`EmpID`,`ProjID`),
  ADD KEY `ProjID` (`ProjID`);

--
-- Constraints for dumped tables

--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`MgrID`) REFERENCES `employee` (`EmpID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`HRID`) REFERENCES `employee` (`EmpID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`SupID`) REFERENCES `employee` (`EmpID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`DeptID`) REFERENCES `department` (`DeptID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pr`
--
ALTER TABLE `pr`
  ADD CONSTRAINT `pr_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`DeptID`) REFERENCES `department` (`DeptID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workson`
--
ALTER TABLE `workson`
  ADD CONSTRAINT `workson_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `workson_ibfk_2` FOREIGN KEY (`ProjID`) REFERENCES `project` (`ProjID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
