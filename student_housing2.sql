-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 10:55 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_housing2`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `apartment_id` char(5) NOT NULL,
  `current_number_of_students` int(11) NOT NULL,
  `max_number_of_students` int(11) NOT NULL,
  `apartment_info` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`apartment_id`, `current_number_of_students`, `max_number_of_students`, `apartment_info`) VALUES
('AP015', 1, 5, '3 غرف و دورتين مياه '),
('AP016', 1, 4, 'غرفتين  و دورتين مياه '),
('AP017', 0, 4, '3 غرف و دورتين مياه '),
('AP018', 0, 6, '3 غرف و دورتين مياه '),
('AP019', 0, 3, 'غرفتين و دورتين مياه '),
('AP021', 0, 4, 'غرفتين ودورتين مياه ومطبخ ');

--
-- Triggers `apartment`
--
DELIMITER $$
CREATE TRIGGER `tg_apartment_insert` BEFORE INSERT ON `apartment` FOR EACH ROW BEGIN
  INSERT INTO apartment_seq VALUES (NULL);
  SET NEW.apartment_id = CONCAT('AP', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `apartment_seq`
--

CREATE TABLE `apartment_seq` (
  `apartment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartment_seq`
--

INSERT INTO `apartment_seq` (`apartment_id`) VALUES
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` char(10) NOT NULL,
  `booking_date` date NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `price` float NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `canceled` tinyint(1) NOT NULL,
  `student_id` char(7) NOT NULL,
  `apartment_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `start_date`, `expire_date`, `price`, `paid`, `canceled`, `student_id`, `apartment_id`) VALUES
('BO00000142', '2017-05-24', '2017-06-01', '2017-10-01', 500, 1, 1, '3310533', 'AP016'),
('BO00000143', '2017-05-24', '2017-06-01', '2017-10-01', 500, 1, 0, '3310533', 'AP015'),
('BO00000144', '2017-05-24', '2017-06-01', '2017-10-01', 500, 1, 0, '3300016', 'AP016');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `tg_booking_insert` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
  INSERT INTO booking_seq VALUES (NULL);
  SET NEW.booking_id = CONCAT('BO', LPAD(LAST_INSERT_ID(), 8, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_seq`
--

CREATE TABLE `booking_seq` (
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_seq`
--

INSERT INTO `booking_seq` (`booking_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` char(10) NOT NULL,
  `complaint_text` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `student_id` char(7) NOT NULL,
  `reply` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `complaint_text`, `status`, `student_id`, `reply`) VALUES
('CO00000018', 'تجربة ارسال شكوى 1', 1, '3310533', 'تم الرد 3'),
('CO00000019', 'تجربة ارسال شكوى 2', 1, '3310533', 'تم الرد 2');

--
-- Triggers `complaint`
--
DELIMITER $$
CREATE TRIGGER `tg_complaint_insert` BEFORE INSERT ON `complaint` FOR EACH ROW BEGIN
  INSERT INTO complaint_seq VALUES (NULL);
  SET NEW.complaint_id = CONCAT('CO', LPAD(LAST_INSERT_ID(), 8, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_seq`
--

CREATE TABLE `complaint_seq` (
  `complaint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint_seq`
--

INSERT INTO `complaint_seq` (`complaint_id`) VALUES
(17),
(18),
(19);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `user_id` char(7) NOT NULL,
  `manager_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`user_id`, `manager_id`) VALUES
('1000000', '3333333');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate` int(11) DEFAULT NULL,
  `student_id` char(7) NOT NULL,
  `apartment_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate`, `student_id`, `apartment_id`) VALUES
(5, '3300016', 'AP016'),
(4, '3310533', 'AP015');

-- --------------------------------------------------------

--
-- Table structure for table `request_change_apartment`
--

CREATE TABLE `request_change_apartment` (
  `request_id` char(10) NOT NULL,
  `student_id` char(7) NOT NULL,
  `booking_id` varchar(10) NOT NULL,
  `status` varchar(15) DEFAULT NULL,
  `done` tinyint(1) NOT NULL,
  `apartment_requested` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_change_apartment`
--

INSERT INTO `request_change_apartment` (`request_id`, `student_id`, `booking_id`, `status`, `done`, `apartment_requested`) VALUES
('RC00000021', '3310533', 'BO00000142', 'موافق عليه', 1, 'AP016');

--
-- Triggers `request_change_apartment`
--
DELIMITER $$
CREATE TRIGGER `tg_request_change_apartment_insert` BEFORE INSERT ON `request_change_apartment` FOR EACH ROW BEGIN
  INSERT INTO request_change_apartment_seq VALUES (NULL);
  SET NEW.request_id = CONCAT('RC', LPAD(LAST_INSERT_ID(), 8, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `request_change_apartment_seq`
--

CREATE TABLE `request_change_apartment_seq` (
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_change_apartment_seq`
--

INSERT INTO `request_change_apartment_seq` (`request_id`) VALUES
(18),
(19),
(20),
(21);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` char(7) NOT NULL,
  `student_id` char(7) NOT NULL,
  `apartment_id` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `student_id`, `apartment_id`) VALUES
('US00015', '3300016', NULL),
('US00019', '3310533', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_housing_info`
--

CREATE TABLE `student_housing_info` (
  `PRICE_OF_ONE_TERM` float NOT NULL,
  `PRICE_OF_TWO_TERM` float NOT NULL,
  `PRICE_OF_THREE_TERM` float NOT NULL,
  `TIME_OF_STARTING_BOOKINGS` date NOT NULL,
  `TIME_OF_ENDING_BOOKINGS` date NOT NULL,
  `START_DATE_OF_NEW_BOOKING` date NOT NULL,
  `NUMBER_OF_DAYS_BEFORE_CANCEL_BOOKING` int(11) NOT NULL,
  `TIME_OF_FIRST_TERM` int(11) NOT NULL,
  `TIME_OF_SECOND_TERM` int(11) NOT NULL,
  `TIME_OF_SUMMER_TERM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_housing_info`
--

INSERT INTO `student_housing_info` (`PRICE_OF_ONE_TERM`, `PRICE_OF_TWO_TERM`, `PRICE_OF_THREE_TERM`, `TIME_OF_STARTING_BOOKINGS`, `TIME_OF_ENDING_BOOKINGS`, `START_DATE_OF_NEW_BOOKING`, `NUMBER_OF_DAYS_BEFORE_CANCEL_BOOKING`, `TIME_OF_FIRST_TERM`, `TIME_OF_SECOND_TERM`, `TIME_OF_SUMMER_TERM`) VALUES
(500, 1000, 1500, '2017-04-12', '2017-08-17', '2017-06-01', 4, 4, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(7) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `date_of_birth`, `phone_number`) VALUES
('1000000', 'saeed', 'ahmad', 'aljohani', 'saeed@ahmad.com', 'bb08a8697d3f8bda67c55689107ebad3', '1991-02-01', '0000000005'),
('US00015', 'aaa', 'aaa', 'aaa', 'a@b.com', '45f28aec7c3a9ecfe86938f25d5c4603', '1991-01-02', '0000000038'),
('US00019', 'sultan', 'ahmad', 'saleh', 'ssss@hotmail.com', 'bb08a8697d3f8bda67c55689107ebad3', '1994-06-15', '0565555555');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `tg_user_insert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
  INSERT INTO user_seq VALUES (NULL);
  SET NEW.user_id = CONCAT('US', LPAD(LAST_INSERT_ID(), 5, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_seq`
--

CREATE TABLE `user_seq` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_seq`
--

INSERT INTO `user_seq` (`user_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(15),
(16),
(17),
(18),
(19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`apartment_id`);

--
-- Indexes for table `apartment_seq`
--
ALTER TABLE `apartment_seq`
  ADD PRIMARY KEY (`apartment_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_seq`
--
ALTER TABLE `booking_seq`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `complaint_seq`
--
ALTER TABLE `complaint_seq`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`student_id`,`apartment_id`);

--
-- Indexes for table `request_change_apartment`
--
ALTER TABLE `request_change_apartment`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_change_apartment_seq`
--
ALTER TABLE `request_change_apartment_seq`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `user_seq`
--
ALTER TABLE `user_seq`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartment_seq`
--
ALTER TABLE `apartment_seq`
  MODIFY `apartment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `booking_seq`
--
ALTER TABLE `booking_seq`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `complaint_seq`
--
ALTER TABLE `complaint_seq`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `request_change_apartment_seq`
--
ALTER TABLE `request_change_apartment_seq`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_seq`
--
ALTER TABLE `user_seq`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
