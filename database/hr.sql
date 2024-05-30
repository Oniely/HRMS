-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 06:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `privilage` enum('super_admin','admin') NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `username`, `password`, `fname`, `lname`, `contact`, `position`, `privilage`, `photo_path`) VALUES
(1, 'admin', 'admin', 'Thomas', 'Arguelles', '09123456789', 'Head Administrator', 'super_admin', NULL),
(4, 'secretary', 'secret', 'Max', 'Verstappen', '09123456789', 'Secretary', 'admin', NULL),
(5, 'Secret', 'seventime', 'Lewis ', 'Hamilton', '09123456789', 'Ferrari Ambassador', 'admin', NULL),
(10, 'sc', 'admin', 'Rai', 'Reyes', '098738278', 'Administrator', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_address_tbl`
--

CREATE TABLE `business_address_tbl` (
  `business_id` int(11) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `children_tbl`
--

CREATE TABLE `children_tbl` (
  `c_id` int(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(50) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `college_tbl`
--

CREATE TABLE `college_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_tbl`
--

INSERT INTO `college_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
(143, 'Southland College', 'Southland College', 'Southland College', '2024-03-22'),
(10101, 'Southland College ', 'Kabankalan City', 'Accountancy', '0000-00-00'),
(12345, 'Southland College', 'Barangay 9, Kabankalan City', 'IT', '2017-07-01'),
(20202, 'Southland College', 'Kabankalan City', 'Accountancy', '2023-05-28'),
(30303, 'Southland College', 'Kabankalan City', 'Accountancy', '0000-00-00'),
(40404, 'Southland College', 'Kabankalan City', 'Mechanical Engineering', '2019-04-28'),
(50505, 'Fellowship Baptist College', 'Kabankalan City', 'Information Technology', '2010-03-03'),
(823728, 'qwe', 'qwe', 'qwe', '2002-12-22'),
(9830290, 'Southland College', 'Barangay 9, Kabankalan City', 'IT', '2018-06-07'),
(10101010, 'Cebu National University', 'Cebu', 'Accountancy', '0000-00-00'),
(20190110, 'Southland College', 'Kabankalan City', 'Kabankalan City', '2024-03-10'),
(20190111, 'Southland College', 'Kabankalan City', 'Kabankalan City', '2023-12-31'),
(20202020, 'Perpetua University of Makati', 'Makati', 'Fine Arts', '0000-00-00'),
(20903989, '', '', '', '0000-00-00'),
(20998943, 'Southland College', 'Barangay 9, Kabankalan City', 'IT', '2018-02-26'),
(30303030, 'Cebu National University', 'Cebu', 'Lawyer', '0000-00-00'),
(40404040, 'Southland College', 'Barangay 9, Kabankalan City', 'IT', '0000-00-00'),
(50505050, 'Southland College', 'Barangay 9, Kabankalan City', 'Accountancy', '0000-00-00'),
(60606060, '', '', '', '0000-00-00'),
(123456789, 'Southland College', '', '', '2024-04-30'),
(201988734, 'De La Salle Bacolod', 'Bacolod City', 'Information Technology Major in Web Development', '2024-04-05'),
(203298392, '', '', '', '1899-11-30'),
(987654321, 'Southland College', 'Barangay 9, Kabankalan City', '', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `department_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`department_id`, `username`, `password`, `fname`, `lname`, `contact`, `position`, `department`) VALUES
(1, 'secsa', 'secsa', 'Secsa', 'Secsa', '09123456789', 'Dean', 'SECSA'),
(2, 'seas', 'seas', 'Seas', 'Seas', '098893289793', 'SEAS Administrator', 'SEAS'),
(3, 'shtm', 'shtm', 'Shtm', 'Shtm', '099839829793', 'Head Administrator', 'SHTM'),
(4, 'sba', 'sba', 'SBA', 'SBA', '09898329', 'Head Administrator', 'SBA'),
(6, 'secsa101', 'secsa', 'Secretary', 'Secretary', '09887948293', 'Secretary', 'SECSA');

-- --------------------------------------------------------

--
-- Table structure for table `educational_attainment_tbl`
--

CREATE TABLE `educational_attainment_tbl` (
  `educ_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `elementary_id` int(11) NOT NULL,
  `highschool_id` int(11) NOT NULL,
  `vocational_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `graduate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elementary_tbl`
--

CREATE TABLE `elementary_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `year_graduate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elementary_tbl`
--

INSERT INTO `elementary_tbl` (`employee_id`, `schoolname`, `address`, `year_graduate`) VALUES
(10101, 'Southland College', 'Kabankalan City', '2014-03-25'),
(20202, 'Southland College ', 'Kabankalan City', '2012-03-27'),
(30303, 'Southland College', 'Kabankalan City', '2015-03-28'),
(40404, 'Salong Elementary School', 'Barangay Salong, Kabankalan City ', '2009-03-26'),
(50505, 'Erams West ', 'Kabankalan City', '2002-02-03'),
(10101010, 'Guadalupe Elementary School', 'Guadalupe', '2013-04-28'),
(20202020, 'Makati Elementary', 'Makati', '2012-03-05'),
(30303030, 'Banga Elementary School', 'Banga, Lapu-lapu', '2012-03-28'),
(40404040, 'Salong Elementary School', 'Kabankalan City', '2014-04-28'),
(50505050, 'Southland College', 'Barangay 9, Kabankalan City', '2015-03-23'),
(60606060, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `employee_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `tin_id` varchar(100) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `sss_no` varchar(100) NOT NULL,
  `pagibig_no` varchar(100) NOT NULL,
  `philhealth_no` varchar(100) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`employee_id`, `fname`, `mname`, `lname`, `date_of_birth`, `place_of_birth`, `sex`, `blood_type`, `civil_status`, `tin_id`, `citizenship`, `sss_no`, `pagibig_no`, `philhealth_no`, `height`, `weight`, `residential_address`, `permanent_address`, `email`, `contact_number`, `status`, `photo_path`, `department`) VALUES
(20202, 'Aiah Mary', 'Z.', 'Arceta', '2000-02-17', 'Barangay 9, Kabankalan City, Negros Occidental', 'Male', 'O', 'Male', 'T00993', 'Filipino', 'SSS8872', 'PG90021', 'PHN5994', 166.5, 55.2, 'Barangay 9, Kabankalan City, Negros Occidental', 'Barangay 9, Kabankalan City, Negros Occidental', 'aiah@gmail.com', '09889903', 'ACTIVE', '/hrms/admin/images/profiles/women_example.jpg', 'SECSA'),
(30303, 'Jhoanna', 'E.', 'Robles', '1995-03-28', 'Brgy 5, Kabankalan City, Negros Occidental', 'Female', 'O', 'Male', 'T001', 'Filipino', 'SSS9940', 'PG3302-1', 'PHN-233', 167.4, 51.3, 'Barangay 9, Kabankalan City, Negros Occidental', 'Punta Rojas St., Barangay 6, Kabankalan City, Negros Occidental', 'jhoanna@gmail.com', '09884873', 'INACTIVE', '/hrms/admin/images/profiles/photo_66435c74adce18.18081286.jpg', 'SEAS'),
(40404, 'Yves Saint', 'E.', 'Laurent', '1997-05-28', 'Barangay Salong, Kabankalan City, Negros Occidental', 'Male', 'AB', 'Male', 'T92003', 'Filipino', 'SSS9903', 'PG01-2', 'PHN778', 175.3, 60.4, 'Barangay 7, Kabankalan City, Negros Occidental', 'Barangay Salong, Kabankalan City, Negros Occidental', 'yves@gmail.com', '09884930', 'INACTIVE', '/hrms/admin/images/profiles/photo_665478e9ba4e53.66543055.jpg', 'SBA');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `faculty_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `tin_id` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `sss_no` varchar(255) NOT NULL,
  `pagibig_no` varchar(255) NOT NULL,
  `philhealth_no` varchar(255) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`faculty_id`, `fname`, `mname`, `lname`, `date_of_birth`, `place_of_birth`, `sex`, `blood_type`, `civil_status`, `tin_id`, `citizenship`, `sss_no`, `pagibig_no`, `philhealth_no`, `height`, `weight`, `residential_address`, `permanent_address`, `email`, `contact_number`, `status`, `photo_path`, `department`) VALUES
(10101, 'Gwen Yves', 'G.', 'Apuli', '2001-05-05', 'Barangay 5, Kabankalan City, Negros Occidental', 'Male', 'AB', 'Male', 'T0993', 'Filipino', 'SSS8833', 'PG00334-1', 'PHN2211', 167.5, 54.3, 'Barangay 5, Kabankalan City, Negros Occidental', 'Barangay 5, Kabankalan City, Negros Occidental', 'gwen@gmail.com', '0988939002', 'ACTIVE', '/hrms/admin/images/profiles/women_example.jpg', 'SECSA'),
(50505, 'Christian', 'L.', 'Dior', '1990-08-27', 'Barangay 6, Kabankalan City, Negros Occidental', 'Male', 'O', 'Male', 'T99802', 'Filipino', 'SSS0331', 'PG123', 'PHN8002', 170.5, 60.4, 'Barangay 6, Kabankalan City, Negros Occidental', 'Barangay 6, Kabankalan City, Negros Occidental', 'christian@gmail.com', '099894893', 'INACTIVE', '/hrms/admin/images/profiles/f1_by_dinapixstudio_dh4gwmr.jpg', 'SHTM');

-- --------------------------------------------------------

--
-- Table structure for table `family_background_tbl`
--

CREATE TABLE `family_background_tbl` (
  `fb_id` int(50) NOT NULL,
  `spouse_id` int(50) DEFAULT NULL,
  `employeers_name` varchar(255) DEFAULT NULL,
  `business_address` varchar(255) DEFAULT NULL,
  `children_id` int(50) DEFAULT NULL,
  `fathers_name_id` int(50) DEFAULT NULL,
  `mothers_name_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fathers_name`
--

CREATE TABLE `fathers_name` (
  `father_id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fathers_name`
--

INSERT INTO `fathers_name` (`father_id`, `employee_id`, `fname`, `mname`, `lname`) VALUES
(28, 10101010, 'Mario Jose', 'R.', 'Vergara'),
(29, 20202020, 'Josemario', 'E.', 'Recaled'),
(30, 30303030, 'Steve', 'T.', 'Parker'),
(31, 40404040, 'Antonio', 'R.', 'Apuli'),
(32, 50505050, 'Steve', 'T.', 'Parker'),
(33, 60606060, '', '', ''),
(34, 10101, 'George', 'T.', 'Apuli'),
(35, 20202, 'Andrew Lei', 'T.', 'Arceta'),
(36, 30303, 'Jack', 'R.', 'Robles'),
(37, 40404, 'Terrence', 'T.', 'Laurent'),
(38, 50505, 'Carlos', 'E.', 'Dior');

-- --------------------------------------------------------

--
-- Table structure for table `graduate_tbl`
--

CREATE TABLE `graduate_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduate_tbl`
--

INSERT INTO `graduate_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
(10101, '', '', '', '0000-00-00'),
(20202, 'Southland College', 'Kabankalan City', 'Accountancy', '2023-05-28'),
(30303, '', '', '', '0000-00-00'),
(40404, 'Southland College', 'Kabankalan City', 'Mechanical Engineering', '2019-04-28'),
(50505, 'Fellowship Baptist College', 'Kabankalan City', 'Information Technology', '2010-03-03'),
(10101010, '', '', '', '0000-00-00'),
(20202020, '', '', '', '0000-00-00'),
(30303030, '', '', '', '0000-00-00'),
(40404040, '', '', '', '0000-00-00'),
(50505050, '', '', '', '0000-00-00'),
(60606060, '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `highschool_tbl`
--

CREATE TABLE `highschool_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `highschool_tbl`
--

INSERT INTO `highschool_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
(10101, 'Southland College ', 'Kabankalan City', 'None', '2018-04-07'),
(20202, 'Southland College ', 'Kabankalan City', 'None', '2016-04-05'),
(30303, 'Southland College', 'Kabankalan City', 'None', '2019-04-15'),
(40404, 'Salong National High School', 'Barangay Salong, Kabankalan City', 'None', '2013-04-04'),
(50505, 'Fellowship Baptist College', 'Kabankalan City', 'None', '2006-03-03'),
(10101010, 'Guadalupe National High School', 'Guadalupe', 'None', '2017-05-05'),
(20202020, 'Makati High School', 'Makati', 'None', '2016-04-28'),
(30303030, 'Banga National High School', 'Banga, Lapu-lapu', 'None', '2016-12-04'),
(40404040, 'Salong Elementary School', 'Kabankalan City', 'None', '2018-05-02'),
(50505050, 'Southland College', 'Barangay 9, Kabankalan City', 'None', '2019-04-04'),
(60606060, '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_balance_tbl`
--

CREATE TABLE `leave_balance_tbl` (
  `employee_id` int(11) NOT NULL,
  `annual_leave` int(11) NOT NULL,
  `sick_leave` int(11) NOT NULL,
  `unpaid_leave` int(11) NOT NULL,
  `vacational_leave` int(11) NOT NULL,
  `bereavement_leave` int(11) NOT NULL,
  `marriage_leave` int(11) NOT NULL,
  `other_leave` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_balance_tbl`
--

INSERT INTO `leave_balance_tbl` (`employee_id`, `annual_leave`, `sick_leave`, `unpaid_leave`, `vacational_leave`, `bereavement_leave`, `marriage_leave`, `other_leave`, `balance`) VALUES
(10101, 5, 9, 5, 15, 0, 1, 0, 35),
(20202, 13, 13, 15, 15, 0, 0, 0, 35),
(30303, 3, 3, 5, 15, 1, 0, 0, 15),
(40404, 13, 15, 15, 15, 0, 0, 0, 45),
(50505, 5, 5, 5, 14, 0, 0, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `leave_tbl`
--

CREATE TABLE `leave_tbl` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `date_applied` datetime NOT NULL,
  `reason` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days_leave` int(11) NOT NULL,
  `application_status` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `accompany_with` varchar(255) NOT NULL,
  `balance_days` varchar(100) NOT NULL,
  `read_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_tbl`
--

INSERT INTO `leave_tbl` (`leave_id`, `employee_id`, `employee_name`, `department`, `leave_type`, `date_applied`, `reason`, `from_date`, `to_date`, `total_days_leave`, `application_status`, `destination`, `accompany_with`, `balance_days`, `read_status`) VALUES
(310208, 30303, 'Jhoanna Robles', 'SEAS', 'Sick Leave', '2024-05-26 00:00:00', 'N/A', '2024-05-27', '2024-05-28', 2, 'APPROVED', 'N/A', 'N/A', '3', 1),
(415089, 20202, 'Aiah Mary Arceta', 'SECSA', 'Annual Leave', '2024-05-25 00:00:00', 'N/A', '2024-05-27', '2024-05-28', 2, 'APPROVED', 'N/A', 'N/A', '13', 1),
(907174, 10101, 'Gwen Yves Apuli', 'SECSA', 'Marriage Leave', '2024-05-29 00:00:00', 'To attend marriage of relatives', '2024-05-30', '2024-05-30', 1, 'APPROVED', 'Kabankalan City', 'None', '4', 1),
(925855, 40404, 'Yves Saint Laurent', 'SBA', 'Annual Leave', '2024-05-27 00:00:00', 'Tour and Attend Program in the Siliman University', '2024-05-28', '2024-05-29', 2, 'APPROVED', 'Dumaguete', 'Students', '13', 1),
(954563, 30303, 'Jhoanna Robles', 'SEAS', 'Bereavement Leave', '2024-05-29 00:00:00', 'To attend funeral ', '2024-05-30', '2024-05-30', 1, 'APPROVED', 'Kabankalan City', 'None', '4', 1),
(991342, 50505, 'Christian Dior', 'SHTM', 'Vacational Leave', '2024-05-29 00:00:00', 'To attend seminar regarding to sports committee', '2024-05-30', '2024-05-30', 1, 'APPROVED', 'Dumaguete', 'None', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership_organization_tbl`
--

CREATE TABLE `membership_organization_tbl` (
  `membership_organization_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `inclusive_dates` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mothers_name`
--

CREATE TABLE `mothers_name` (
  `mother_id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mothers_name`
--

INSERT INTO `mothers_name` (`mother_id`, `employee_id`, `fname`, `mname`, `lname`) VALUES
(28, 10101010, 'Christine Jane', 'G.', 'Carabi-an'),
(29, 20202020, 'Ylona', 'S.', 'Gargatua'),
(30, 30303030, 'Sydney', 'E.', 'Torres'),
(31, 40404040, 'Gwyneth', 'E.', 'Moreno'),
(32, 50505050, 'Sydney', 'E.', 'Torres'),
(33, 60606060, '', '', ''),
(34, 10101, 'Gwyneth Airah', 'E.', 'Gonzaga'),
(35, 20202, 'Laureen Andrea', 'P.', 'Zamora'),
(36, 30303, 'Jericha', 'T.', 'Elula'),
(37, 40404, 'Ylona', 'M.', 'Exalia'),
(38, 50505, 'Cristina Rose', 'T.', 'Terabittha');

-- --------------------------------------------------------

--
-- Table structure for table `other_information_tbl`
--

CREATE TABLE `other_information_tbl` (
  `other_information_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `special_skills_hobbies` varchar(255) NOT NULL,
  `non_academic_distinctions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permanent_address_tbl`
--

CREATE TABLE `permanent_address_tbl` (
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permanent_address_tbl`
--

INSERT INTO `permanent_address_tbl` (`employee_id`, `barangay`, `municipality_city`, `province`) VALUES
(10101010, 'Guadalupe', 'Cebu', 'Cebu'),
(20202020, 'Makati ', 'Makati City', 'Makati'),
(30303030, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(40404040, 'Barangay Salong', 'Kabankalan City', 'Negros Occidental'),
(50505050, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(60606060, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(10101, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(20202, 'Barangay 9', 'Kabankalan City', 'Negros Occidental'),
(30303, 'Punta Rojas St., Barangay 6', 'Kabankalan City', 'Negros Occidental'),
(40404, 'Barangay Salong', 'Kabankalan City', 'Negros Occidental'),
(50505, 'Barangay 6', 'Kabankalan City', 'Negros Occidental');

-- --------------------------------------------------------

--
-- Table structure for table `place_of_birth_tbl`
--

CREATE TABLE `place_of_birth_tbl` (
  `id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_of_birth_tbl`
--

INSERT INTO `place_of_birth_tbl` (`id`, `employee_id`, `barangay`, `municipality_city`, `province`) VALUES
(1, 10101010, 'Guadalupe', 'Cebu', 'Cebu'),
(2, 20202020, 'Makati', 'Makati City', 'Makati'),
(3, 30303030, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(4, 40404040, 'Barangay Salong', 'Kabankalan City', 'Negros Occidental'),
(5, 50505050, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(6, 60606060, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(7, 10101, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(8, 20202, 'Barangay 9', 'Kabankalan City', 'Negros Occidental'),
(9, 30303, 'Brgy 5', 'Kabankalan City', 'Negros Occidental'),
(10, 40404, 'Barangay Salong', 'Kabankalan City', 'Negros Occidental'),
(11, 50505, 'Barangay 6', 'Kabankalan City', 'Negros Occidental');

-- --------------------------------------------------------

--
-- Table structure for table `resedential_address_tbl`
--

CREATE TABLE `resedential_address_tbl` (
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resedential_address_tbl`
--

INSERT INTO `resedential_address_tbl` (`employee_id`, `barangay`, `municipality_city`, `province`) VALUES
(10101010, 'Guadalupe', 'Cebu', 'Cebu'),
(20202020, 'Makati', 'Makati City', 'Makati'),
(30303030, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(40404040, 'Barangay Salong', 'Kabankalan City', 'Negros Occidental'),
(50505050, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(60606060, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(10101, 'Barangay 5', 'Kabankalan City', 'Negros Occidental'),
(20202, 'Barangay 9', 'Kabankalan City', 'Negros Occidental'),
(30303, 'Barangay 9', 'Kabankalan City', 'Negros Occidental'),
(40404, 'Barangay 7', 'Kabankalan City', 'Negros Occidental'),
(50505, 'Barangay 6', 'Kabankalan City', 'Negros Occidental');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_tbl`
--

CREATE TABLE `spouse_tbl` (
  `s_id` int(50) NOT NULL,
  `bussiness_id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `s_fname` varchar(255) NOT NULL,
  `s_mname` varchar(255) NOT NULL,
  `s_lname` varchar(255) NOT NULL,
  `s_occupation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_and_study_tbl`
--

CREATE TABLE `training_and_study_tbl` (
  `training_and_study_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `training_study_name` varchar(255) NOT NULL,
  `inclusive_dates` datetime NOT NULL,
  `number_of_hours` varchar(255) NOT NULL,
  `sponsoring_agency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vocational_tbl`
--

CREATE TABLE `vocational_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vocational_tbl`
--

INSERT INTO `vocational_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
(10101, 'Southland College', 'Kabankalan City', 'STEM', '2020-04-27'),
(20202, 'Southland College ', 'Kabankalan City', 'ABM', '2018-04-15'),
(30303, 'Southland College', 'Kabankalan City', 'STEM', '2021-04-25'),
(40404, 'Fellowship Baptist College', 'Kabankalan City', 'STEM', '2015-05-07'),
(50505, 'None', 'None', 'None', '0000-00-00'),
(10101010, 'None', 'None', 'None', '0000-00-00'),
(20202020, 'None', 'None', 'None', '0000-00-00'),
(30303030, 'None', 'None', 'None', '0000-00-00'),
(40404040, 'None', 'None', 'None', '0000-00-00'),
(50505050, 'None', 'None', 'None', '0000-00-00'),
(60606060, '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience_tbl`
--

CREATE TABLE `work_experience_tbl` (
  `experience_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `incluside_dates` datetime NOT NULL,
  `name_company/address` varchar(255) NOT NULL,
  `position/title` varchar(255) NOT NULL,
  `status_of_appointment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `business_address_tbl`
--
ALTER TABLE `business_address_tbl`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `children_tbl`
--
ALTER TABLE `children_tbl`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `college_tbl`
--
ALTER TABLE `college_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `elementary_tbl`
--
ALTER TABLE `elementary_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `family_background_tbl`
--
ALTER TABLE `family_background_tbl`
  ADD PRIMARY KEY (`fb_id`),
  ADD KEY `spouse_id` (`spouse_id`),
  ADD KEY `children_id` (`children_id`),
  ADD KEY `fathers_name_id` (`fathers_name_id`),
  ADD KEY `mothers_name_id` (`mothers_name_id`);

--
-- Indexes for table `fathers_name`
--
ALTER TABLE `fathers_name`
  ADD PRIMARY KEY (`father_id`);

--
-- Indexes for table `graduate_tbl`
--
ALTER TABLE `graduate_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `highschool_tbl`
--
ALTER TABLE `highschool_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leave_tbl`
--
ALTER TABLE `leave_tbl`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `membership_organization_tbl`
--
ALTER TABLE `membership_organization_tbl`
  ADD PRIMARY KEY (`membership_organization_id`);

--
-- Indexes for table `mothers_name`
--
ALTER TABLE `mothers_name`
  ADD PRIMARY KEY (`mother_id`);

--
-- Indexes for table `other_information_tbl`
--
ALTER TABLE `other_information_tbl`
  ADD PRIMARY KEY (`other_information_id`);

--
-- Indexes for table `place_of_birth_tbl`
--
ALTER TABLE `place_of_birth_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spouse_tbl`
--
ALTER TABLE `spouse_tbl`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `bussiness_id` (`bussiness_id`);

--
-- Indexes for table `training_and_study_tbl`
--
ALTER TABLE `training_and_study_tbl`
  ADD PRIMARY KEY (`training_and_study_id`);

--
-- Indexes for table `vocational_tbl`
--
ALTER TABLE `vocational_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `work_experience_tbl`
--
ALTER TABLE `work_experience_tbl`
  ADD PRIMARY KEY (`experience_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `business_address_tbl`
--
ALTER TABLE `business_address_tbl`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `children_tbl`
--
ALTER TABLE `children_tbl`
  MODIFY `c_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024989393;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `family_background_tbl`
--
ALTER TABLE `family_background_tbl`
  MODIFY `fb_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fathers_name`
--
ALTER TABLE `fathers_name`
  MODIFY `father_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `membership_organization_tbl`
--
ALTER TABLE `membership_organization_tbl`
  MODIFY `membership_organization_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mothers_name`
--
ALTER TABLE `mothers_name`
  MODIFY `mother_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `other_information_tbl`
--
ALTER TABLE `other_information_tbl`
  MODIFY `other_information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_of_birth_tbl`
--
ALTER TABLE `place_of_birth_tbl`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `spouse_tbl`
--
ALTER TABLE `spouse_tbl`
  MODIFY `s_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_and_study_tbl`
--
ALTER TABLE `training_and_study_tbl`
  MODIFY `training_and_study_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_experience_tbl`
--
ALTER TABLE `work_experience_tbl`
  MODIFY `experience_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children_tbl`
--
ALTER TABLE `children_tbl`
  ADD CONSTRAINT `children_tbl_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_tbl` (`employee_id`);

--
-- Constraints for table `family_background_tbl`
--
ALTER TABLE `family_background_tbl`
  ADD CONSTRAINT `family_background_tbl_ibfk_1` FOREIGN KEY (`spouse_id`) REFERENCES `spouse_tbl` (`s_id`),
  ADD CONSTRAINT `family_background_tbl_ibfk_2` FOREIGN KEY (`children_id`) REFERENCES `children_tbl` (`c_id`),
  ADD CONSTRAINT `family_background_tbl_ibfk_3` FOREIGN KEY (`fathers_name_id`) REFERENCES `fathers_name` (`father_id`),
  ADD CONSTRAINT `family_background_tbl_ibfk_4` FOREIGN KEY (`mothers_name_id`) REFERENCES `mothers_name` (`mother_id`);

--
-- Constraints for table `spouse_tbl`
--
ALTER TABLE `spouse_tbl`
  ADD CONSTRAINT `spouse_tbl_ibfk_1` FOREIGN KEY (`bussiness_id`) REFERENCES `business_address_tbl` (`business_id`),
  ADD CONSTRAINT `spouse_tbl_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee_tbl` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
