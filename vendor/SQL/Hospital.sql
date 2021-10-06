-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2021 at 02:26 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctorsdetails`
--

CREATE TABLE `doctorsdetails` (
  `ID` int(11) NOT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `docdob` date DEFAULT NULL,
  `docphoneno` varchar(25) DEFAULT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docsplist` text DEFAULT NULL,
  `docqualifi` varchar(255) DEFAULT NULL,
  `docaddress` text DEFAULT NULL,
  `docstatus` varchar(25) DEFAULT NULL,
  `docusername` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `submit_name` varchar(255) DEFAULT NULL,
  `submit_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctorsdetails`
--

INSERT INTO `doctorsdetails` (`ID`, `docname`, `docid`, `docdob`, `docphoneno`, `docemail`, `docsplist`, `docqualifi`, `docaddress`, `docstatus`, `docusername`, `docpassword`, `submit_name`, `submit_time`) VALUES
(1, 'Parthiban S', 'DOC12345', '2021-10-06', '06383117625', 'parthibans452@gmail.com', 'General Physician', 'MBBS', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'Active', 'parthisri', '$2y$10$7DbOpQJhkmqZ1myUdD/jXu2vyZ5x/07llPPM9Rcn7qYrFy111Xrpu', 'admin', '2021-10-05 15:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `feesdeatils`
--

CREATE TABLE `feesdeatils` (
  `ID` int(11) NOT NULL,
  `feestype` varchar(255) DEFAULT NULL,
  `feesname` varchar(11) DEFAULT NULL,
  `feesdesc` text DEFAULT NULL,
  `feesamount` float DEFAULT NULL,
  `submit_by` varchar(255) DEFAULT NULL,
  `submit_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feesdeatils`
--

INSERT INTO `feesdeatils` (`ID`, `feestype`, `feesname`, `feesdesc`, `feesamount`, `submit_by`, `submit_time`) VALUES
(1, 'Doctor Fees', 'FEES', 'DOCTOR PAYMENT', 105, 'Admin', '2021-10-05 06:46:39'),
(2, 'Lab Fees', 'Bood test', 'LAB', 50, 'Admin', '2021-10-05 06:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `fileupload`
--

CREATE TABLE `fileupload` (
  `ID` int(11) NOT NULL,
  `patientID` int(11) DEFAULT NULL,
  `filedesc` text DEFAULT NULL,
  `fuploadname` varchar(255) DEFAULT NULL,
  `fuploadtime` datetime DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileupload`
--

INSERT INTO `fileupload` (`ID`, `patientID`, `filedesc`, `fuploadname`, `fuploadtime`, `filepath`) VALUES
(1, 1, 'OKOK TESTING ...', 'Parthiban', '2021-10-05 06:16:07', 'Paymentbill.pdf'),
(2, 2, 'OKOK TESTING', 'Admin', '2021-10-05 06:52:13', 'SKP- Hospital.pdf'),
(3, 2, 'OKOK TESTING', 'Admin', '2021-10-05 07:07:56', 'SKP- Hospital.pdf'),
(4, 2, 'OKOK TESTING', 'Admin', '2021-10-05 07:08:28', 'SKP- Hospital.pdf'),
(5, 2, 'OKOK TESTING', 'Admin', '2021-10-05 07:17:21', 'SKP- Hospital.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

CREATE TABLE `patientdetails` (
  `ID` int(11) NOT NULL,
  `patientname` varchar(255) DEFAULT NULL,
  `hpatientid` varchar(255) DEFAULT NULL,
  `patientid` int(11) NOT NULL DEFAULT 1,
  `patientage` varchar(255) DEFAULT NULL,
  `patientphno` varchar(11) NOT NULL,
  `patientadd` text DEFAULT NULL,
  `submitname` varchar(255) DEFAULT NULL,
  `submitime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientdetails`
--

INSERT INTO `patientdetails` (`ID`, `patientname`, `hpatientid`, `patientid`, `patientage`, `patientphno`, `patientadd`, `submitname`, `submitime`) VALUES
(4, 'Parthiban S', 'SKP/10/2021/1', 1, '21', '9790339185', 'NO : 293 Thanigai Amman Kovil Street Anupuram', 'admin', '2021-10-05 15:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `patientID` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `vtime` datetime DEFAULT NULL,
  `ptoken` int(11) DEFAULT NULL,
  `tocname` varchar(255) DEFAULT NULL,
  `toctime` datetime DEFAULT NULL,
  `docdesc` text DEFAULT NULL,
  `docproname` varchar(255) DEFAULT NULL,
  `docprotime` datetime DEFAULT NULL,
  `patstatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID`, `pid`, `patientID`, `docname`, `vtime`, `ptoken`, `tocname`, `toctime`, `docdesc`, `docproname`, `docprotime`, `patstatus`) VALUES
(1, 4, 'SKP/10/2021/1', 'Parthiban S', '2021-10-05 22:41:00', 1, 'admin', '2021-10-05 05:09:51', 'TESTING FOR DOCTOR SECTION', 'Parthiban S', '2021-10-05 05:36:27', 'Completed'),
(2, 4, 'SKP/10/2021/1', 'admin', '2021-10-14 01:22:00', 2, 'Admin', '2021-10-05 06:49:31', 'OKOKOKOK SUCCESS', 'Admin', '2021-10-06 06:51:21', 'Completed'),
(3, 4, 'SKP/10/2021/1', 'Parthiban S', '2021-10-06 01:52:00', 3, 'Admin', '2021-10-05 07:19:49', NULL, NULL, NULL, 'Waiting For Doctor Process');

-- --------------------------------------------------------

--
-- Table structure for table `patinetsfeesdeatils`
--

CREATE TABLE `patinetsfeesdeatils` (
  `ID` int(11) NOT NULL,
  `patinetID` int(11) DEFAULT NULL,
  `feestype` varchar(255) DEFAULT NULL,
  `feesname` varchar(11) DEFAULT NULL,
  `feesquant` int(11) DEFAULT NULL,
  `feesamount` float DEFAULT NULL,
  `totalamount` float DEFAULT NULL,
  `submit_by` varchar(255) DEFAULT NULL,
  `submit_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patinetsfeesdeatils`
--

INSERT INTO `patinetsfeesdeatils` (`ID`, `patinetID`, `feestype`, `feesname`, `feesquant`, `feesamount`, `totalamount`, `submit_by`, `submit_time`) VALUES
(1, 1, 'Doctor Fees', 'FEES', 12, 100, 1200, 'Parthiban', '2021-10-05 06:24:44'),
(2, 1, 'Lab Fees', 'Bood test', 25, 50, 1250, 'Parthiban', '2021-10-06 06:24:55'),
(3, 2, 'Doctor Fees', 'Bood test', 1, 50, 50, 'Admin', '2021-10-05 06:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `category` varchar(25) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `usermail` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `uaddress` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `pflag` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `category`, `uname`, `usermail`, `birthdate`, `username`, `phoneno`, `password`, `uaddress`, `created_by`, `created_at`, `pflag`) VALUES
(1, 'Admin', 'Admin', 'admin452@gmail.com', '2021-09-16', 'admin', '06383117625', '$2y$10$czX1grNavKivzXV26g7zdeEmSroJGNNpZx.BqCgEqMGXykOo3zG9m', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'admin', '2021-10-05 00:25:06', NULL),
(16, 'Doctor', 'Parthiban S', 'parthibans452@gmail.com', '2021-10-06', 'parthisri', '06383117625', '$2y$10$KYrg.bpc8/Kluf3Pxt1t7OyU/tkVccMR645r1G9IfWH4ZybdqbGAy', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'Parthiban S', '2021-10-05 00:03:01', 0),
(17, 'Staff', 'Parthiban', 'test@igcar.gov.in', '2021-10-06', 'parthiban', '0123645758', '$2y$10$Xsc.86C7SpsqlmbP1Bteoe.GqeffMpgnCHKEelhYb3Qy5C1g8gYKi', 'IGCAR, Kalpakkam', 'Admin', '2021-10-05 15:45:48', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctorsdetails`
--
ALTER TABLE `doctorsdetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `feesdeatils`
--
ALTER TABLE `feesdeatils`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fileupload`
--
ALTER TABLE `fileupload`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patientdetails`
--
ALTER TABLE `patientdetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patinetsfeesdeatils`
--
ALTER TABLE `patinetsfeesdeatils`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctorsdetails`
--
ALTER TABLE `doctorsdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feesdeatils`
--
ALTER TABLE `feesdeatils`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fileupload`
--
ALTER TABLE `fileupload`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patientdetails`
--
ALTER TABLE `patientdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patinetsfeesdeatils`
--
ALTER TABLE `patinetsfeesdeatils`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
