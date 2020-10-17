-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 09:23 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `post_code` int(6) UNSIGNED NOT NULL,
  `password` varchar(32) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1,
  `reset_code` varchar(20) DEFAULT NULL,
  `reset_time` timestamp NULL DEFAULT NULL,
  `remember_me` varchar(50) DEFAULT NULL,
  `fb_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile`, `designation`, `address`, `city_id`, `post_code`, `password`, `picture`, `user_type`, `reset_code`, `reset_time`, `remember_me`, `fb_id`) VALUES
(1, 'Reajuj Salehen', 'rsalehen@gmail.com', '01836307836', 'Web Developer ', '43 New Eskaton Road, Dhaka-1000', 1, 1000, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, NULL, NULL, '1326', '2117112838433655');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `class` tinyint(4) UNSIGNED NOT NULL,
  `section_id` tinyint(4) UNSIGNED NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `address` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `post_code` int(6) NOT NULL,
  `picture` varchar(4) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `marks` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `name`, `father_name`, `mother_name`, `birth_date`, `gender`, `email`, `phone`, `class`, `section_id`, `nationality`, `address`, `country`, `city`, `post_code`, `picture`, `status`, `marks`) VALUES
(2, 'Reajuj Salehen', 'fname', 'mname', '0000-00-00', 1, 'navigatorsitbd@gmail.com', '+8801836307836', 2, 4, 'Bangladeshi', 'NavigatorsIT Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Bangladesh', 'Dhaka', 1230, 'jpg', 2, 90),
(3, 'Tanjid Hoshin', 'Tara mia', 'Jahanara begum', '1980-12-08', 1, 'shokina@mail.com', '012555548555', 2, 5, 'Bangladeshi', 'Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Bangladesh', 'Dhaka', 1230, 'jpg', 2, 80),
(4, 'applicant name', 'applicant father', 'applicant mother', '1982-09-25', 2, 'applicant@mail.com', '0122458888552', 2, 4, 'Bangladeshi', '01ss sl;lk s;d skldk', 'Bangladesh', 'Dinajpur', 5208, 'jpg', 1, 40),
(6, 'new student', 'Tara mia', 'Jahanara begum', '2017-05-10', 2, 'newstudent@mail.com', '+8801836307836', 2, 5, 'Bangladeshi', 'NavigatorsIT Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Bangladesh', 'Dhaka', 1230, 'jpeg', 1, 75),
(7, 'test1', '', '', '0000-00-00', 0, '', '', 2, 4, '', '', '', '', 0, 'jpeg', 2, 80);

--
-- Triggers `admissions`
--
DELIMITER $$
CREATE TRIGGER `add_student` AFTER UPDATE ON `admissions` FOR EACH ROW IF new.status = 2 THEN
        INSERT INTO students(name,	father_name, mother_name, birth_date, gender, email, mobile, class_id, section_id, nationality, address, country, city, post_code, picture)
        VALUES(old.name, old.father_name, old.mother_name, old.birth_date, old.gender, old.email, old.phone, old.class, old.section_id, old.nationality, old.address, old.country, old.city, old.post_code, CONCAT(old.id,'_org.',old.picture));
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admission_settings`
--

CREATE TABLE `admission_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` tinyint(4) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `exam_type` varchar(50) NOT NULL,
  `exam_date` date DEFAULT NULL,
  `total_marks` tinyint(3) NOT NULL,
  `pass_marks` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admission_settings`
--

INSERT INTO `admission_settings` (`id`, `class_id`, `start_date`, `end_date`, `exam_type`, `exam_date`, `total_marks`, `pass_marks`) VALUES
(1, 1, '2020-09-27', '2020-09-30', 'written, viva', '2020-10-09', 127, 80),
(3, 3, '2020-10-03', '2020-11-03', 'viva', '2020-11-26', 127, 80),
(4, 2, '2020-10-06', '2020-10-17', 'written, viva', '2020-10-30', 100, 60),
(7, 5, '2020-10-03', '2020-10-24', 'viva', '2020-10-31', 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`) VALUES
(1, 'Dhaka', 1),
(2, 'Dinajpur', 1),
(3, 'Rajshahi', 1),
(4, 'Sylhet', 1),
(5, 'Mymensingh', 1),
(6, 'Karachi', 2),
(7, 'Lahore', 2),
(8, 'Islamabad', 2),
(9, 'Rawalpindi', 2),
(10, 'Peshawar', 2),
(11, 'Mumbai', 3),
(12, 'Delhi', 3),
(13, 'Kolkata', 3),
(14, 'Pune', 3),
(15, 'Beijing', 4),
(16, 'Shanghai', 4),
(17, 'Nanjing', 4),
(18, 'Wuhan', 4),
(19, 'Lagos', 5),
(20, 'Kano', 5),
(21, 'Zaria', 5),
(22, 'New York City', 6),
(23, 'Los Angeles', 6),
(24, 'Chicago', 6),
(25, 'Manhattan', 6);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'class 1'),
(2, 'class 2'),
(3, 'class 3'),
(4, 'class 4'),
(5, 'class 5');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Bangladesh'),
(2, 'Pakistan'),
(3, 'India'),
(4, 'China'),
(5, 'Nigeria'),
(6, 'United States (USA)');

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`id`, `name`) VALUES
(1, 'Principal '),
(2, 'Teacher'),
(3, 'Junior Teacher ');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` tinyint(4) UNSIGNED NOT NULL,
  `section_id` tinyint(4) UNSIGNED NOT NULL,
  `subject_id` tinyint(4) UNSIGNED NOT NULL,
  `exam_type_id` tinyint(4) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `teacher_id`, `section_id`, `subject_id`, `exam_type_id`, `date`, `time`, `duration`, `status`) VALUES
(1, 4, 4, 3, 1, '2020-10-10', '09:30:00', '45 min', 1),
(2, 5, 5, 2, 2, '2020-10-18', '10:00:00', '1.30 Hour', NULL),
(3, 4, 6, 3, 3, '2020-10-16', '09:30:00', '3 Hour', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_type`
--

CREATE TABLE `exam_type` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_type`
--

INSERT INTO `exam_type` (`id`, `name`) VALUES
(1, 'Weekly'),
(2, 'Monthly'),
(3, 'Midterm'),
(4, 'Final'),
(5, 'Quiz  ');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `post_code` int(6) UNSIGNED NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 3,
  `verify_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `name`, `email`, `mobile`, `address`, `designation`, `password`, `picture`, `city_id`, `post_code`, `user_type`, `verify_code`) VALUES
(2, 'Karim', 'karim@mail.com', '0124788745554', '43 New Eskaton Road, Dhaka - 1000', 'Public Service', 'e10adc3949ba59abbe56e057f20f883e', '2_org.jpg', 1, 1000, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `marks` int(4) NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `marks`, `exam_id`, `student_id`) VALUES
(7, 56, 1, 8),
(8, 65, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` tinyint(4) UNSIGNED NOT NULL,
  `section_id` tinyint(4) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject_id` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`id`, `teacher_id`, `section_id`, `start_time`, `end_time`, `subject_id`) VALUES
(1, 7, 4, '08:00:00', '09:00:00', 1),
(2, 4, 4, '09:00:00', '10:00:00', 3),
(3, 5, 5, '15:00:00', '16:00:00', 2),
(4, 4, 6, '10:30:00', '11:30:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `class_id` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `class_id`) VALUES
(1, 'Morning', 1),
(2, 'Evening ', 1),
(3, 'Afternoon ', 1),
(4, 'Morning', 2),
(5, 'Afternoon ', 2),
(6, 'Morning', 3),
(7, 'Afternoon ', 3),
(8, 'Morning', 4),
(9, 'Morning', 5),
(10, 'Afternoon ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `class_id` tinyint(4) UNSIGNED NOT NULL,
  `section_id` tinyint(4) UNSIGNED NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `address` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `post_code` int(6) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `guardian_id` varchar(4) DEFAULT NULL,
  `relation` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `verify_code` varchar(20) DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 4,
  `designation` varchar(32) NOT NULL DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `father_name`, `mother_name`, `birth_date`, `gender`, `email`, `mobile`, `class_id`, `section_id`, `nationality`, `address`, `country`, `city`, `post_code`, `picture`, `guardian_id`, `relation`, `password`, `verify_code`, `user_type`, `designation`) VALUES
(8, 'Reajuj Salehen', 'fname', 'mname', '0000-00-00', 1, 'navigatorsitbd@gmail.com', '+8801836307836', 2, 4, 'Bangladeshi', 'NavigatorsIT Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Bangladesh', 'Dhaka', 1230, '2_org.jpg', '2', 'Boro Abbu', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'Student'),
(10, 'test1', '', '', '0000-00-00', 0, 'test@mail.com', '', 2, 4, '', '', '', '', 0, '7_org.jpeg', '2', 'nai nao', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'Student'),
(11, 'Tanjid Hoshin', 'Tara mia', 'Jahanara begum', '1980-12-08', 1, 'shokina@mail.com', '012555548555', 2, 5, 'Bangladeshi', 'Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Bangladesh', 'Dhaka', 1230, '3_org.jpg', NULL, '', '', 'ZJbPGEndoQ4D356z02xN', 4, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Bangla'),
(2, 'English'),
(3, 'Math'),
(4, 'ICT'),
(5, 'Social Science ');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `subject_id` tinyint(4) UNSIGNED NOT NULL,
  `employee_id` varchar(25) NOT NULL,
  `joining_date` date NOT NULL,
  `password` varchar(32) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `post_code` int(6) UNSIGNED NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 2,
  `verify_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `gender`, `email`, `mobile`, `address`, `designation`, `subject_id`, `employee_id`, `joining_date`, `password`, `picture`, `city_id`, `post_code`, `user_type`, `verify_code`) VALUES
(3, 'Hasan', 1, 'hasan@gmail.com', '1255664654', 'Road # 01, Sector # 10. Uttara, Dhaka 1230', 'teacher', 4, '1sd234k3', '2020-09-28', 'e10adc3949ba59abbe56e057f20f883e', '3_org.jpeg', 1, 2350, 2, ''),
(4, 'Mazed', 1, 'mazed@gmail.com', '0125235456', 'Road # 05, Sector # 15. Dhaka 1220', 'Teacher', 3, '345dd455', '2020-10-24', 'e10adc3949ba59abbe56e057f20f883e', '4_org.jpg', 1, 2201, 2, ''),
(5, 'Asad', 1, 'asad@gmail.com', '0545588858545', 'Road # 05, Sector # 15. Dhaka 1220', 'Teacher', 2, '2125sj78744', '2020-07-30', 'e10adc3949ba59abbe56e057f20f883e', '5_org.jpg', 9, 2305, 2, ''),
(7, 'Reajuj Salehen', 1, 'rsalehen@gmail.com', '232343434', 'NavigatorsIT Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Teacher', 1, '345dd455', '2020-10-16', '', '', 9, 1255, 2, 'lHIucf4MktW9sSQon7N0'),
(10, 'Reajuj Salehen', 3, 'wdpf.master@gmail.com', '01544446544', 'NavigatorsIT Sarker Market(2nd floor) Road # 01, Sector # 10. Uttara, Dhaka 1230', 'Teacher', 5, '01554sd21', '2020-01-28', '', '', 23, 3655, 2, 'LpgOTGuz97538BwUYjkI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fb_id` (`fb_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section_id`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `admission_settings`
--
ALTER TABLE `admission_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_type_id` (`exam_type_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `exam_type`
--
ALTER TABLE `exam_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admission_settings`
--
ALTER TABLE `admission_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_type`
--
ALTER TABLE `exam_type`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `admissions_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admissions_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admission_settings`
--
ALTER TABLE `admission_settings`
  ADD CONSTRAINT `admission_settings_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`exam_type_id`) REFERENCES `exam_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guardians`
--
ALTER TABLE `guardians`
  ADD CONSTRAINT `guardians_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routine`
--
ALTER TABLE `routine`
  ADD CONSTRAINT `routine_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routine_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routine_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
