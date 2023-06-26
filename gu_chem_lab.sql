-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 06:10 AM
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
('1', 'Acetaminophen', '1', '50'),
('102', 'Nutomns', '2', '12'),
('2', 'Ibuprofen', '2', '100'),
('3', 'Aspirin', '3', '75'),
('4', 'Omeprazole', '4', '30'),
('5', 'Amoxicillin', '1', '60'),
('6', 'Lisinopril', '2', '25');

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
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hod`
--

INSERT INTO `tbl_hod` (`id`, `username`, `password`, `department`) VALUES
(1, 'HODChemistry', 'securepwd456', 'Chemistry'),
(2, 'HODPhysics', 'physics123', 'Physics'),
(3, 'HODBiology', 'biohod', 'Biology'),
(4, 'HODMathematics', 'mathhod', 'Mathematics'),
(5, 'HODComputerScience', 'compscience', 'Computer Science'),
(6, 'HODEnglish', 'englishhod', 'English'),
(7, 'HODHistory', 'historyhod', 'History'),
(8, 'HODEconomics', 'economicshod', 'Economics'),
(9, 'HODGeography', 'geographyhod', 'Geography'),
(10, 'HODArt', 'arthod', 'Art');

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
('102', 'john', 'john123', '4'),
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
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `request_chem_name` varchar(40) NOT NULL,
  `request_chem_id` varchar(4) NOT NULL,
  `request_chem_quan` varchar(3) NOT NULL,
  `status` varchar(2) NOT NULL,
  `location` varchar(20) NOT NULL,
  `request_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `request_chem_name`, `request_chem_id`, `request_chem_quan`, `status`, `location`, `request_by`) VALUES
(1, 'Chemical A', '101', '5', '1', 'Lab 1', 'Student'),
(2, 'Chemical B', '102', '3', '0', 'Lab 2', 'Faculty'),
(3, 'Chemical C', '103', '2', '-1', 'Lab 3', 'Student'),
(4, 'Chemical D', '104', '1', '1', 'Lab 4', 'Student'),
(5, 'Chemical E', '105', '4', '0', 'Lab 1', 'Faculty'),
(6, 'Chemical F', '106', '2', '-1', 'Lab 2', 'Faculty'),
(7, 'Chemical G', '107', '3', '1', 'Lab 3', 'Student'),
(8, 'Chemical H', '108', '1', '0', 'Lab 4', 'Faculty'),
(9, 'Chemical I', '109', '2', '1', 'Lab 1', 'Student'),
(10, 'Chemical J', '110', '3', '-1', 'Lab 2', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `std_year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `username`, `password`, `std_year`) VALUES
('220215260414', 'JaneSmith', 'jane', '2022'),
('220215260415', 'EmilyJones', 'emily', '2023'),
('220215260416', 'MichaelBrown', 'michael', '2022'),
('220215260417', 'SarahDavis', 'sarah', '2023'),
('220215260418', 'DavidLee', 'david', '2022'),
('220215260419', 'EmmaWilson', 'emma', '2023'),
('220215260420', 'DanielMiller', 'daniel', '2022'),
('220215260421', 'OliviaAnderson', 'olivia', '2023'),
('220215260422', 'JamesTaylor', 'james', '2022'),
('220215260423', 'SophiaMartinez', 'sophia', '2023'),
('220215260424', 'WilliamHernandez', 'william', '2022'),
('220215260425', 'AvaGarcia', 'ava', '2023'),
('220215260426', 'AlexanderLopez', 'alexander', '2022'),
('220215260427', 'MiaGonzalez', 'mia', '2023'),
('220215260428', 'EthanPerez', 'ethan', '2022'),
('220215260429', 'CharlotteRodriguez', 'charlotte', '2023'),
('220215260430', 'LiamRivera', 'liam', '2022'),
('220215260431', 'AmeliaTorres', 'amelia', '2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chemical`
--
ALTER TABLE `tbl_chemical`
  ADD PRIMARY KEY (`chem_id`);

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
-- AUTO_INCREMENT for table `tbl_hod`
--
ALTER TABLE `tbl_hod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
