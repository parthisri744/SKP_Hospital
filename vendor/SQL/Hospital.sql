-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2021 at 05:56 AM
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
(6, 'Parthi', NULL, '2021-10-01', '06383117625', 'parthibans452@gmail.com', NULL, NULL, '293, thanigai amman kovil', 'Inactive', 'kjasgfjaskgf', NULL, 'admin', '2021-10-01 21:02:03'),
(7, 'Parthiriya', NULL, '2021-10-02', '6383117625', 'parthisri744@gmail.com', NULL, NULL, 'Thanigai amman kovil\r\nNeikuppi village Anupuram', 'Inactive', 'Parthisri', '$2y$10$A1n7bZpiafGjFvRgC5AbCOw7rk0ERBMo22UHAf.cbUA74aT8qVhVq', 'admin', '2021-10-02 03:53:50'),
(9, 'Parthiban', NULL, '2021-10-01', '06383117625', 'parthibans452@gmail.com', NULL, NULL, '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'Active', 'riya24', '$2y$10$Ft4k7XBcRxg0ycofiXD1YevxHyHjosVL1qesbsjgWqy6yG2OGB0xi', 'admin', '2021-10-03 01:59:17'),
(11, 'Parthiban S', 'DOC1234', '2021-10-03', '0123645758', 'test@igcar.gov.in', NULL, NULL, 'IGCAR, Kalpakkam', 'Active', 'riya24', '$2y$10$rTCveXYMemD7kGgUSRbbSeN9OAeDsaX4kpSKb9.SmFX/iSPr3Xyg.', 'admin', '2021-10-03 14:31:22'),
(12, 'Parthiban', 'DOC1236', '2021-10-09', '06383117625', 'parthibans452@gmail.com', 'Testing', 'MBBS', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'Inactive', 'Parthisri', '$2y$10$eUgPei040P711dKRekHBMeQfDaAMr1TLmR5r9ow1RiutziXLqS0y2', 'admin', '2021-10-03 17:19:23'),
(13, 'admin', '12345', '2021-10-13', '06383117625', 'parthibans452@gmail.com', 'Testing', 'MBBS', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'Active', 'Parthiban', '$2y$10$zfOnFCmRWSPb9jl6B1cTtenV9MYkmvsjQ4PL1spmALd5n4yUDTQD6', 'admin', '2021-10-04 03:44:39');

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
(1, 'Staff', 'Parthi', 'Testing', 10000, 'admin', '2021-10-03 08:11:36'),
(2, 'Staff', 'Pathi', 'Test', 10000, 'admin', '2021-10-03 08:55:19'),
(4, 'Doctor', 'Name', 'Testing', 54654, 'admin', '2021-10-03 08:54:51'),
(5, 'Admin', '545', 'Parthi', 2123130, 'admin', '2021-10-03 06:50:45'),
(6, 'Staff', 'parthi', '212121', 12312100, 'admin', '2021-10-03 06:51:12'),
(7, 'Riya24', 'Hello', 'Testing', 212, 'admin', '2021-10-03 07:23:48');

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
(1, 1, 'OKOKOK', 'admin', '2021-10-02 04:34:19', '10.pdf'),
(2, 1, 'OKOKOK', 'admin', '2021-10-02 04:35:23', 'SKP Hospital (2).pdf'),
(3, 1, 'OKOKOK SUCCESSS', 'admin', '2021-10-02 04:36:48', '10.pdf'),
(4, 3, 'OKOKOK SUccesss', 'admin', '2021-10-02 04:37:21', '10.pdf'),
(5, 5, 'ok test', 'admin', '2021-10-02 06:50:11', 'SKP Hospital (2).pdf'),
(6, 6, 'sfgfdghjkl;\'\r\n\';lkjhgf', 'admin', '2021-10-02 06:54:23', 'file.pdf'),
(7, 3, 'OK SUccesss', 'admin', '2021-10-02 10:32:36', '10.pdf'),
(8, 9, 'OK Successs', 'admin', '2021-10-02 10:33:18', 'SKP Hospital.pdf'),
(9, 8, 'OOKOKO', 'admin', '2021-10-03 08:21:04', '10.pdf'),
(10, 14, 'OKOKOK TESTING', 'admin', '2021-10-03 02:10:18', '10.pdf'),
(11, 15, 'OKOKOK Success', 'admin', '2021-10-03 06:52:48', '10.pdf'),
(12, 16, 'OKOKOKOK', 'admin', '2021-10-03 07:24:39', 'mpdf.pdf'),
(13, 64, 'OKK', 'admin', '2021-10-04 05:51:10', 'mpdf.pdf');

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
(21, 'ParthibanS', 'SKP/10/2021/0', 21, '12345678', '1212121', 'Hello', 'admin', '2021-10-01 04:12:43'),
(23, 'Parthisri', 'SKP/10/2021/1', 23, '2121', '5454121', 'OKOKOKOK', 'admin', '2021-10-01 04:50:52'),
(25, 'ParthiSri24', 'SKP/10/2021/24', 25, '22', '3154541651', 'OKOKOKOKOK Testing', 'admin', '2021-10-01 17:02:38'),
(26, 'Parthisri', 'SKP/10/2021/26', 26, '22', '545151513', 'Thanigai Amman Kovil Street Neikuppi Village', 'admin', '2021-10-01 17:21:47'),
(27, 'Parvathi', 'SKP/10/2021/29', 27, '22', '8680954080', 'Melapalayam Tirunelveli.', 'admin', '2021-10-01 17:27:03'),
(28, 'Vedha', 'SKP/10/2021/28', 28, '35', '9089786756', 'Big street,TKM', 'admin', '2021-10-02 16:44:41'),
(29, 'Kamaraj', 'SKP/10/2021/30', 30, '36', '9089786756', 'TKM', 'admin', '2021-10-02 18:07:48'),
(30, 'Parthibna', 'SKP/10/2021/31', 31, '21', '212', 'OOKOKOKOKOL', 'admin', '2021-10-03 05:45:05'),
(31, 'RIYARIYA', 'SKP/10/2021/32', 32, '121', '5466531465', 'okokokok', 'admin', '2021-10-03 05:45:47'),
(32, 'Parthiban', 'SKP/10/2021/33', 33, '54', '5456511154', 'OKOKOKOKK', 'admin', '2021-10-03 06:56:44');

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
(1, 23, 'SKP/10/2021/1', 'admin', '2021-10-07 15:53:00', 51312, 'admin', '2021-10-02 12:23:24', 'OKOKOKOKOK DOCTOR PROCCED', 'admin', '2021-10-02 12:59:51', 'Comleted'),
(2, 27, 'SKP/10/2021/29', 'admin', '2021-10-01 16:30:00', 12345, 'admin', '2021-10-02 01:00:35', 'OKOKOK TESTING', 'admin', '2021-10-02 01:20:41', 'Completed'),
(3, 27, 'SKP/10/2021/29', 'admin', '2021-10-01 16:38:00', 12345, 'admin', '2021-10-02 01:08:30', 'OK Proccessed', 'admin', '2021-10-02 07:53:26', 'Completed'),
(5, 28, 'SKP/10/2021/28', 'admin', '2021-10-04 22:16:00', 111, 'admin', '2021-10-02 06:47:03', 'Testing fever fengbfngjkfngklfmglk', 'admin', '2021-10-02 06:48:48', 'Completed'),
(6, 28, 'SKP/10/2021/28', 'admin', '2021-10-14 23:22:00', 23, 'admin', '2021-10-02 06:52:10', 'okk normal', 'admin', '2021-10-02 06:53:17', 'Completed'),
(7, 28, 'SKP/10/2021/28', 'riya24', '2021-10-09 23:25:00', 34, 'admin', '2021-10-02 06:55:09', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(8, 30, 'SKP/10/2021/30', 'admin', '2021-10-02 23:50:00', 11, 'admin', '2021-10-02 08:20:23', 'OKOKOK Successs', 'admin', '2021-10-03 02:20:46', 'Completed'),
(9, 21, 'SKP/10/2021/0', 'riya24', '2021-10-21 00:00:00', 1234, 'admin', '2021-10-02 08:30:41', 'OKOKOK Success', 'admin', '2021-10-02 10:31:58', 'Completed'),
(10, 23, 'SKP/10/2021/1', 'riya24', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:34:57', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(11, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:35:06', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(12, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:36:37', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(13, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:36:53', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(14, 23, 'SKP/10/2021/1', 'riya24', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:37:12', 'OKOKOKOK SUccesss', 'admin', '2021-10-03 08:58:58', 'Completed'),
(15, 23, 'SKP/10/2021/1', 'admin', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:37:27', 'OKOKOK Visited Successfully', 'admin', '2021-10-03 05:44:11', 'Completed'),
(16, 23, 'SKP/10/2021/1', 'admin', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:37:49', 'OKOKOKOK Testing', 'admin', '2021-10-03 06:59:11', 'Completed'),
(17, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:04:00', 12345, 'admin', '2021-10-02 10:44:34', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(18, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:14:00', 12345, 'admin', '2021-10-02 10:44:47', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(19, 23, 'SKP/10/2021/1', 'Parthiriya', '2021-10-08 03:15:00', 213, 'admin', '2021-10-02 10:45:12', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(20, 23, 'SKP/10/2021/1', 'Parthiriya', '2021-10-08 03:15:00', 213, 'admin', '2021-10-02 10:45:44', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(21, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-01 02:14:00', 12345, 'admin', '2021-10-02 10:46:13', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(22, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:25:00', 3121, 'admin', '2021-10-02 10:55:31', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(23, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:25:00', 3121, 'admin', '2021-10-02 10:56:32', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(24, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:25:00', 3121, 'admin', '2021-10-02 11:01:03', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(25, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-24 02:31:00', 2132, 'admin', '2021-10-02 11:01:13', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(26, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:01:26', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(27, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:02:12', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(28, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:02:47', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(29, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:02:51', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(30, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:04:05', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(31, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:04:07', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(32, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:04:30', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(33, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-06 02:34:00', 512, 'admin', '2021-10-02 11:04:43', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(34, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-06 02:34:00', 512, 'admin', '2021-10-02 11:05:01', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(35, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-08 02:35:00', 13123, 'admin', '2021-10-02 11:05:14', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(36, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-08 02:35:00', 13123, 'admin', '2021-10-02 11:10:27', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(37, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-17 02:40:00', 21321, 'admin', '2021-10-02 11:10:39', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(38, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-17 02:40:00', 21321, 'admin', '2021-10-02 11:14:36', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(39, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-17 02:40:00', 21321, 'admin', '2021-10-02 11:15:19', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(40, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-17 02:40:00', 21321, 'admin', '2021-10-02 11:16:36', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(41, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-02 02:46:00', 532132, 'admin', '2021-10-02 11:16:47', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(42, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-22 02:47:00', 21, 'admin', '2021-10-02 11:17:07', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(43, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-22 02:47:00', 21, 'admin', '2021-10-02 11:17:39', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(44, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:47:00', 12201, 'admin', '2021-10-02 11:17:54', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(45, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:47:00', 12201, 'admin', '2021-10-02 11:20:21', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(46, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-16 02:47:00', 12201, 'admin', '2021-10-02 11:20:33', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(47, 23, 'SKP/10/2021/1', 'Parthiban S\r\n', '2021-10-16 02:47:00', 12201, 'admin', '2021-10-02 11:20:48', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(48, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-22 02:47:00', 21, 'admin', '2021-10-02 11:29:35', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(49, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-02 02:46:00', 532132, 'admin', '2021-10-02 11:30:04', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(50, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-17 02:40:00', 21321, 'admin', '2021-10-02 11:30:17', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(51, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-08 02:35:00', 13123, 'admin', '2021-10-02 11:33:11', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(52, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-06 02:34:00', 512, 'admin', '2021-10-02 11:33:15', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(53, 23, 'SKP/10/2021/1', 'Parthiban', '2021-10-07 02:31:00', 31, 'admin', '2021-10-02 11:59:43', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(54, 21, 'SKP/10/2021/0', 'Parthiban', '2021-10-17 03:52:00', 21321, 'admin', '2021-10-03 12:22:38', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(55, 21, 'SKP/10/2021/0', 'Parthiban', '2021-10-14 04:16:00', 123654, 'admin', '2021-10-03 12:46:21', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(56, 21, 'SKP/10/2021/0', 'Parthiban', '2021-10-21 04:17:00', 20201, 'admin', '2021-10-03 12:47:34', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(57, 29, 'SKP/10/2021/30', 'Parthiban', '2021-10-21 04:21:00', 46546, 'admin', '2021-10-03 12:51:45', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(58, 29, 'SKP/10/2021/30', 'Parthiban', '2021-10-10 04:24:00', 515, 'admin', '2021-10-03 12:54:45', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(59, 29, 'SKP/10/2021/30', 'Parthiban', '2021-10-02 04:26:00', 415131, 'admin', '2021-10-03 12:56:49', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(60, 23, 'SKP/10/2021/1', 'Parthiriya', '2021-10-01 05:20:00', 45456, 'admin', '2021-10-03 01:50:39', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(61, 21, 'SKP/10/2021/0', 'Parthi', '2021-10-01 10:20:00', 1234, 'admin', '2021-10-03 06:50:50', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(62, 31, 'SKP/10/2021/32', 'Parthiban', '2021-10-17 12:27:00', 123232, 'admin', '2021-10-03 08:57:10', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(63, 21, 'SKP/10/2021/0', 'Parthi', '2021-10-04 08:30:00', 1, 'admin', '2021-10-03 05:55:29', NULL, NULL, NULL, 'Waiting For Doctor Process'),
(64, 21, 'SKP/10/2021/0', 'admin', '2021-10-16 09:15:00', 1234, 'admin', '2021-10-04 05:45:26', 'Okk', 'admin', '2021-10-04 05:48:54', 'Completed');

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
(12, 14, 'Doctor', 'Parthi', NULL, 20, NULL, 'admin', '2021-10-03 11:24:52'),
(13, 14, 'Staff', 'Name', NULL, 20, NULL, 'admin', '2021-10-03 11:25:01'),
(14, 14, 'Doctor', 'Parthi', NULL, 10000, NULL, 'admin', '2021-10-03 02:35:00'),
(15, 15, 'Admin', 'Name', NULL, 54654, NULL, 'admin', '2021-10-03 06:56:32'),
(16, 16, 'Admin', 'Hello', 4, 212, 848, 'admin', '2021-10-03 07:46:31'),
(17, 16, 'Riya24', 'Parthi', 5, 10000, 50000, 'admin', '2021-10-03 07:46:49');

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
(1, 'Admin', 'Admin', 'admin452@gmail.com', '2021-09-16', 'admin', '06383117625', '$2y$10$h.GyLsTJrw3Pi1VADLzV0e/znK57T00SvjvILj/HphgdUAn.0IhCO', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', NULL, NULL, NULL),
(12, 'Staff', 'Riya', 'parthibans452@gmail.com', '2021-10-15', 'parthisri', '06383117625', '$2y$10$03TzM3bePu9PsjyApSoNy.WqGo2GgEcfcr.vRkO2taPq.fe8uEJrG', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'admin', '2021-10-03 02:15:25', 0),
(15, 'Doctor', 'Parthiban S', 'test@igcar.gov.in', '2021-10-03', 'riya24', '0123645758', '$2y$10$GoTYkiTpfFErnm6dstvunOYkTiYTDbGXZDZtoeXfPIFloGWyiUTUK', 'IGCAR, Kalpakkam', 'admin', '2021-10-03 14:31:50', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feesdeatils`
--
ALTER TABLE `feesdeatils`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fileupload`
--
ALTER TABLE `fileupload`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `patientdetails`
--
ALTER TABLE `patientdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `patinetsfeesdeatils`
--
ALTER TABLE `patinetsfeesdeatils`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
