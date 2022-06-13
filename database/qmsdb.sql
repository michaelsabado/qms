-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 01:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `accessid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `majorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`accessid`, `userid`, `majorid`) VALUES
(17, 13, 1),
(18, 13, 2),
(19, 13, 3),
(20, 13, 4),
(21, 13, 5),
(22, 14, 6),
(23, 14, 7),
(24, 14, 8),
(25, 14, 14),
(26, 14, 16),
(27, 15, 9),
(28, 15, 10),
(29, 15, 11),
(30, 15, 12),
(31, 15, 17),
(32, 15, 20),
(33, 16, 15),
(34, 16, 19),
(35, 16, 21),
(36, 16, 22),
(37, 13, 6),
(38, 13, 6),
(44, 16, 13);

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `counterid` int(11) NOT NULL,
  `countername` varchar(50) NOT NULL,
  `windowno` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(1) Open\r\n(2) Closed',
  `isdefault` int(11) NOT NULL COMMENT '1 = default, 2= no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`counterid`, `countername`, `windowno`, `status`, `isdefault`) VALUES
(1, 'Dep #1', 1, 1, 1),
(2, 'Dep #2', 2, 2, 1),
(17, 'Dep #3', 3, 2, 1),
(18, 'Dep #4', 4, 2, 1),
(19, 'Cashier', 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `majordescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorid`, `programid`, `majordescription`) VALUES
(1, 1, 'Educational Mangement'),
(2, 1, 'Guidance and Counseling'),
(3, 1, 'Mathematics'),
(4, 1, 'Science Education'),
(5, 2, 'Development Studies'),
(6, 3, 'Educational Management'),
(7, 3, 'Communication Arts - English'),
(8, 3, 'Communication Arts - Filipino'),
(9, 3, 'Computer Education'),
(10, 3, 'Early Childhood Education '),
(11, 3, 'Guidance Counseling'),
(12, 3, 'Mathematics'),
(13, 3, 'Science Education'),
(14, 3, 'Special Education'),
(15, 3, 'Social Studies'),
(16, 3, 'Technology and Home Economics'),
(17, 4, 'n/a'),
(18, 5, 'Public Management'),
(19, 6, 'n/a'),
(20, 7, 'n/a'),
(21, 8, 'Animal Science'),
(22, 8, 'Crop Science');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programid` int(11) NOT NULL,
  `programdescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programid`, `programdescription`) VALUES
(1, 'Doctor of Education'),
(2, 'Doctor of Philosophy'),
(3, 'Master of Arts in Education'),
(4, 'Master in Business Adminsitration'),
(5, 'Master in Development Management'),
(6, 'Master in Management Engineering'),
(7, 'Master in Public Administration'),
(8, 'Master of Science in Agriculture');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `queueid` int(11) NOT NULL,
  `identification` varchar(50) NOT NULL,
  `majorid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `counterid` int(11) NOT NULL,
  `token` varchar(10) NOT NULL,
  `status` int(11) NOT NULL COMMENT '(1) Pending\r\n(2) Served\r\n(3) Void',
  `date_created` datetime NOT NULL,
  `iscalled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`queueid`, `identification`, `majorid`, `serviceid`, `counterid`, `token`, `status`, `date_created`, `iscalled`) VALUES
(106, 'Michael Sabado', 1, 20, 1, '2648', 2, '2022-06-11 11:26:48', 2),
(107, 'Eulo Sabado', 5, 25, 1, '2657', 1, '2022-06-11 11:26:57', 2),
(108, 'Reymart De Chavez', 1, 29, 1, '3031', 1, '2022-06-11 11:30:31', 0),
(109, 'Christian Fernandez', 18, 42, 1, '3100', 1, '2022-06-11 11:31:00', 0),
(110, 'Nelia Sabado', 9, 43, 17, '5841', 1, '2022-06-11 12:58:41', 0),
(112, 'Eulo Sabado', 6, 20, 2, '1002', 1, '2022-06-12 09:35:29', 0),
(114, 'Eulo Sabado', 5, 42, 1, '1004', 1, '2022-06-12 10:28:16', 2),
(115, 'Lleanne Medallon', 19, 28, 18, '1005', 1, '2022-06-12 10:29:11', 0),
(117, 'Michelle Sabado', 2, 49, 2, '1003', 1, '2022-06-12 10:18:37', 0),
(118, '18-UR-0698', 22, 15, 1, '1001', 2, '2022-06-13 09:33:59', 2),
(121, 'Eulo Sabado', 1, 20, 1, '1002', 2, '2022-06-13 07:46:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceid` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceid`, `category`, `description`) VALUES
(10, 1, 'OTR'),
(11, 1, 'Transfer Credential'),
(12, 1, 'COG'),
(13, 1, 'CEU'),
(14, 1, 'Good Moral'),
(15, 1, 'Medium of Instruction'),
(16, 1, 'GPA'),
(17, 1, 'Graduation'),
(18, 1, 'CAV'),
(19, 1, 'Compre. Exam Result'),
(20, 1, 'Authentication of Documents'),
(21, 3, 'Title Defense'),
(22, 3, 'Proposal'),
(23, 3, 'Pre-Final Defense'),
(24, 3, 'Final Defense'),
(25, 3, 'Compre. Result'),
(26, 3, 'Graduation'),
(27, 3, 'Plagiarism'),
(28, 5, 'Requirements for Enrolment'),
(29, 5, 'Hardbound'),
(30, 5, 'Requirements for Defense'),
(31, 2, 'Requesting for Shifting Form'),
(32, 2, 'Requesting for Cross Enroll'),
(33, 4, 'Transfer Credential'),
(34, 4, 'OTR'),
(35, 4, 'COG'),
(36, 4, 'CEU'),
(37, 4, 'Good Morral'),
(38, 4, 'Medium Instruction'),
(39, 4, 'GPA'),
(40, 4, 'Graduation'),
(41, 4, 'CAV'),
(42, 2, 'Admission'),
(43, 2, 'Enrolment (Thesis Writing)'),
(44, 2, 'Enrolment (Dissertation)'),
(45, 1, 'Evaluation of Grades'),
(46, 5, 'Transfer Credential'),
(47, 1, 'Completion Form'),
(48, 4, 'Diploma'),
(49, 4, 'Abaray'),
(50, 4, 'Souvenir Program'),
(51, 2, 'Requesting for Adding'),
(52, 2, 'Requesting for Changing Form'),
(53, 2, 'Requesting for Droppping'),
(54, 6, 'Inquiry');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `tokenid` int(11) NOT NULL,
  `date` date NOT NULL,
  `token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`tokenid`, `date`, `token`) VALUES
(1, '2022-06-12', 1005),
(2, '2022-06-13', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `isEnabled` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `upload_time`, `isEnabled`) VALUES
(4, 'anc1.jpg', '2022-05-03 11:32:46', 1),
(16, 'drone-shot.mp4', '2022-05-03 13:07:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `usertype` int(11) NOT NULL COMMENT '(1) Admin\r\n(2) Staff',
  `counterid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `firstname`, `middlename`, `lastname`, `username`, `password`, `usertype`, `counterid`) VALUES
(1, 'Lance', 'Dela', 'Cruz', 'admin', '12345678', 1, NULL),
(13, 'Melebeth', '', 'Aclera', 'melebeth', 'melebeth', 2, 1),
(14, 'Denverly', '', 'Cacho', 'denverly', 'denverly', 2, 2),
(15, 'John Carlo', '', 'De Vera', 'johncarlo', 'johncarlo', 2, 17),
(16, 'Trisha Marie', '', 'Enriquez', 'trishamarie', 'trishamarie', 2, 18),
(17, 'Cashiers', '', 'Cashier', 'cashier', 'cashier', 2, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`accessid`),
  ADD KEY `majorid` (`majorid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`counterid`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorid`),
  ADD KEY `programid` (`programid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programid`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`queueid`),
  ADD KEY `queue_ibfk_1` (`counterid`),
  ADD KEY `queue_ibfk_2` (`serviceid`),
  ADD KEY `majorid` (`majorid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceid`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `counterid` (`counterid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `accessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `counterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `majorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `programid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`majorid`) REFERENCES `major` (`majorid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`programid`) REFERENCES `program` (`programid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_ibfk_1` FOREIGN KEY (`counterid`) REFERENCES `counter` (`counterid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `queue_ibfk_2` FOREIGN KEY (`serviceid`) REFERENCES `service` (`serviceid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `queue_ibfk_3` FOREIGN KEY (`majorid`) REFERENCES `major` (`majorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`counterid`) REFERENCES `counter` (`counterid`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
