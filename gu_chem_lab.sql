-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 02:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gu_chem_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chemical`
--

CREATE TABLE `tbl_chemical` (
  `chem_id` varchar(3) NOT NULL,
  `chem_name` varchar(40) NOT NULL,
  `chem_loc` varchar(2) NOT NULL,
  `chem_quan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_chemical`
--

INSERT INTO `tbl_chemical` (`chem_id`, `chem_name`, `chem_loc`, `chem_quan`) VALUES
('102', 'H2O', '1', '0'),
('102', 'H2O', '2', '0'),
('102', 'H2O', '3', '0'),
('103', 'H2SO4', '1', '10'),
('104', 'N2', '4', '5'),
('105', 'CO2', '1', '20'),
('106', 'NaCl', '2', '15'),
('107', 'C6H12O6', '3', '25'),
('108', 'HCl', '1', '8'),
('109', 'NH3', '2', '12'),
('110', 'C2H4', '3', '18'),
('111', 'HNO3', '1', '6'),
('112', 'C6H6', '4', '30'),
('113', 'CH4', '3', '22'),
('114', 'CaCO3', '2', '17'),
('115', 'C8H18', '1', '11'),
('116', 'H2', '4', '3'),
('117', 'Fe2O3', '3', '9'),
('118', 'C7H8', '2', '14'),
('152', 'O2', '3', '40'),
('216', 'N3DR4', '3', '50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `id` varchar(6) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `faculty` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`id`, `username`, `password`, `faculty`) VALUES
('123456', 'dhruvpuri', 'dhruvpuri', 'Computer'),
('225861', 'Mahesh', 'mahesh', 'Arts'),
('225863', 'Emily', 'emily456', 'Engineering'),
('225864', 'Michael', 'michael789', 'Business'),
('225865', 'Sophia', 'sophia321', 'Social Sciences'),
('225867', 'Olivia', 'olivia654', 'Medicine'),
('225868', 'James', 'james234', 'Law'),
('225869', 'Emma', 'emma567', 'Education'),
('225870', 'Benjamin', 'benjamin012', 'Computer Science'),
('225871', 'Ava', 'ava789', 'Music'),
('225872', 'William', 'william321', 'Psychology'),
('225873', 'Mia', 'mia654', 'Communication'),
('225874', 'Alexander', 'alexander234', 'Sports Science'),
('225875', 'Samantha', 'samantha567', 'Fine Arts'),
('225876', 'Daniel', 'daniel012', 'Political Science'),
('225877', 'Charlotte', 'charlotte789', 'History'),
('225878', 'Matthew', 'matthew321', 'Economics'),
('225879', 'Harper', 'harper654', 'Biology'),
('225880', 'David', 'david234', 'Geography');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hod`
--

CREATE TABLE `tbl_hod` (
  `id` varchar(3) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hod`
--

INSERT INTO `tbl_hod` (`id`, `username`, `password`, `department`) VALUES
('098', 'HODBiology', 'biohod', 'Biology'),
('145', 'HODComputerScience', 'compscience', 'Computer Science'),
('256', 'HODPhysics', 'physics123', 'Physics'),
('4', 'HODMathematics', 'mathhod', 'Mathematics'),
('425', 'HODChemistry', 'securepwd456', 'Chemistry'),
('426', 'HODHistory', 'historyhod', 'History'),
('526', 'HODArt', 'arthod', 'Art'),
('6', 'HODEnglish', 'englishhod', 'English'),
('745', 'HODEconomics', 'economicshod', 'Economics'),
('9', 'HODGeography', 'geographyhod', 'Geography');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_head`
--

CREATE TABLE `tbl_lab_head` (
  `id` varchar(5) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lab_no` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lab_head`
--

INSERT INTO `tbl_lab_head` (`id`, `username`, `password`, `lab_no`) VALUES
('102', 'john', 'john123', '2'),
('103', 'emma', 'emma123', '3'),
('104', 'alex', 'alex123', '4'),
('105', 'sara', 'sara123', '1'),
('106', 'michael', 'michael123', '2'),
('107', 'lisa', 'lisa123', '3'),
('108', 'peter', 'peter123', '4'),
('109', 'sam', 'sam123', '1'),
('110', 'julia', 'julia123', '2'),
('111', 'ryan', 'ryan123', '3'),
('112', 'olivia', 'olivia123', '4'),
('113', 'david', 'david123', '1'),
('114', 'amy', 'amy123', '2'),
('115', 'nathan', 'nathan123', '3'),
('116', 'lily', 'lily123', '4'),
('117', 'mason', 'mason123', '1'),
('118', 'grace', 'grace123', '2'),
('119', 'jackson', 'jackson123', '3'),
('120', 'ava', 'ava123', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab_request`
--

CREATE TABLE `tbl_lab_request` (
  `id` int(11) NOT NULL,
  `chem_id` varchar(3) NOT NULL,
  `lab_id` varchar(1) NOT NULL,
  `request_lab_id` varchar(1) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '0',
  `approved_quan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lab_request`
--

INSERT INTO `tbl_lab_request` (`id`, `chem_id`, `lab_id`, `request_lab_id`, `status`, `approved_quan`) VALUES
(2, '102', '2', '1', '1', '25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `chem_id` varchar(3) NOT NULL,
  `requested_by` varchar(12) NOT NULL,
  `lab_head_status` varchar(2) NOT NULL,
  `hod_status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `chem_id`, `requested_by`, `lab_head_status`, `hod_status`) VALUES
(11, '102', '220215260414', '1', '0'),
(14, '106', '220215260417', '1', '0'),
(15, '108', '220215260418', '0', '0'),
(16, '110', '220215260419', '1', '-1'),
(17, '111', '220215260420', '0', '1'),
(18, '113', '220215260421', '1', '0'),
(19, '115', '220215260422', '0', '0'),
(20, '117', '220215260423', '1', '-1'),
(21, '118', '220215260424', '1', '1'),
(22, '152', '220215260425', '0', '0'),
(23, '216', '220215260426', '1', '0'),
(24, '102', '220283116010', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `std_year` varchar(1) NOT NULL,
  `lab` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `username`, `password`, `std_year`, `lab`) VALUES
('220215260414', 'JaneSmith', 'jane', '2', '1'),
('220215260415', 'EmilyJones', 'emily', '2', '2'),
('220215260416', 'MichaelBrown', 'michael', '2', '2'),
('220215260417', 'SarahDavis', 'sarah', '2', '1'),
('220215260418', 'DavidLee', 'david', '2', '3'),
('220215260419', 'EmmaWilson', 'emma', '2', '2'),
('220215260420', 'DanielMiller', 'daniel', '2', '2'),
('220215260421', 'OliviaAnderson', 'olivia', '2', '1'),
('220215260422', 'JamesTaylor', 'james', '2', '2'),
('220215260423', 'SophiaMartinez', 'sophia', '2', '4'),
('220215260424', 'WilliamHernandez', 'william', '2', '1'),
('220215260425', 'AvaGarcia', 'ava', '2', '1'),
('220215260426', 'AlexanderLopez', 'alexander', '2', '2'),
('220215260427', 'MiaGonzalez', 'mia', '2', '4'),
('220215260428', 'EthanPerez', 'ethan', '2', '4'),
('220215260429', 'CharlotteRodriguez', 'charlotte', '2', '3'),
('220215260430', 'LiamRivera', 'liam', '2', '3'),
('220215260431', 'AmeliaTorres', 'amelia', '2', '3'),
('220283116010', 'dhruvpuri', 'dhruvpuri', '2', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chemical`
--
ALTER TABLE `tbl_chemical`
  ADD PRIMARY KEY (`chem_id`,`chem_loc`) USING BTREE;

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hod`
--
ALTER TABLE `tbl_hod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lab_head`
--
ALTER TABLE `tbl_lab_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lab_request`
--
ALTER TABLE `tbl_lab_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_lab_request`
--
ALTER TABLE `tbl_lab_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
