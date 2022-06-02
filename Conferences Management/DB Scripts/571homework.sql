-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 07:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `571homework`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_uid` varchar(45) NOT NULL,
  `account_pw` longtext NOT NULL,
  `account_fname` varchar(45) NOT NULL,
  `account_lname` varchar(45) NOT NULL,
  `account_type` varchar(45) NOT NULL,
  `account_date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_uid`, `account_pw`, `account_fname`, `account_lname`, `account_type`, `account_date_created`) VALUES
(1, 'CarolineZhou', '$2y$10$hoaxZCn7jm2aRf4BNtnssO.8aTHOIxBDtU1.dgbDb3adFIbbgzhRO', 'Caroline', 'Zhou', 'Admin', '2020-01-01'),
(2, 'NathanSehn', '$2y$10$YSe6mbg/VW4aLSPt61MG8ulkFv2kwdE2C.jD75hiLaNO3jrUnG.06', 'Nathan', 'Sehn', 'User', '2020-11-23'),
(3, 'gene', '$2y$10$ZrFnPivS4lKCdy7dDeBL3e.g4L2W/7ftwS8Jszcj40I48d3KqaAre', 'gene', 'belcher', 'Admin', '2020-11-23'),
(4, 'tina', '$2y$10$xkUgg4d5SC0gR0XI33uAiuI2/ZTH5JgDUeKlxheTf7Ls6hlDCvIHi', 'tina', 'belcher', 'User', '2020-11-23'),
(5, 'JaneDoe', '$2y$10$M5aeNzzh3VKeSHVJMqW4V.BW/rodzGuJnbyNPUoT9qA5BXgSlLTjK', 'Jane', 'Doe', 'User', '2020-11-25'),
(6, 'JohnDoe', '$2y$10$ThJ5mi2sqrxolRr./kABt.WJF0ZjO/MXTKwaF0unxO9r6Jbre3DE6', 'John', 'Doe', 'User', '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `conf_id` int(11) NOT NULL,
  `conf_name` varchar(45) DEFAULT NULL,
  `conf_host_id` int(11) NOT NULL,
  `conf_status` int(3) NOT NULL DEFAULT 0,
  `conf_date_created` datetime DEFAULT NULL,
  `conf_date_scheduled` datetime DEFAULT NULL,
  `conf_approved_id` int(11) DEFAULT NULL,
  `conf_journal_DOI` varchar(30) DEFAULT NULL,
  `conf_details` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `conf_name`, `conf_host_id`, `conf_status`, `conf_date_created`, `conf_date_scheduled`, `conf_approved_id`, `conf_journal_DOI`, `conf_details`) VALUES
(1, 'conference 1', 1, 1, '2020-01-02 00:00:00', '2020-12-12 18:00:00', 3, '102222/4', ''),
(2, 'conference 2', 1, 0, '2020-03-01 00:00:00', '2020-11-30 18:00:00', NULL, '102222/1', ''),
(3, 'conference 3', 1, 0, '2020-03-01 00:00:00', '2020-11-30 18:00:00', NULL, '102222/1', ''),
(4, 'conference 4', 2, 0, '2020-03-01 00:00:00', '2020-11-30 18:00:00', NULL, '102222/1', ''),
(5, 'conference 5', 2, 0, '2020-03-01 00:00:00', '2020-11-30 18:00:00', NULL, '102222/4', ''),
(6, 'conference 6', 5, 0, '2020-03-01 00:00:00', '2020-11-30 18:00:00', NULL, '102222/4', ''),
(12, 'assfdsadfsadfsafd', 3, 1, '2020-11-23 00:00:00', '2020-12-31 00:00:00', 3, '102222/1', 'asdfsadfafd'),
(13, 'aaaaaaaaaaaaaaaaaaaaaaaaa', 3, 0, '2020-11-23 00:00:00', '2020-12-31 00:00:00', NULL, '102222/2', 'aaaaaaaaaaaa'),
(14, 'aaaaaaaaaaaaaaaaaaaaaaaaa', 3, 0, '2020-11-23 00:00:00', '2020-12-31 00:00:00', NULL, '102222/2', 'aaaaaaaaaaaa'),
(15, 'aaaaaaaaaaaaaaaaaaaaaaaaa', 3, 0, '2020-11-23 00:00:00', '2020-12-31 00:00:00', NULL, '102222/2', 'aaaaaaaaaaaa'),
(16, 'aaaaaaaaaaaaaaaaaaaaaaaaa', 3, 0, '2020-11-23 00:00:00', '2020-12-31 00:00:00', NULL, '102222/2', 'aaaaaaaaaaaa'),
(17, 'Jane\'s conference', 5, 1, '2020-11-25 00:00:00', '2020-12-31 00:00:00', 1, '10022/1', 'Jane\'s conference'),
(18, 'Caroline\'s conference', 1, 1, '2020-11-25 00:00:00', '2020-12-29 00:00:00', 1, '10022/1', 'Featuring Jane\'s journal in this conference.'),
(19, 'Jane\'s hosted conference', 5, 1, '2020-11-25 00:00:00', '2020-12-08 00:00:00', 1, '102222/3', 'this is the details of the conference.');

-- --------------------------------------------------------

--
-- Table structure for table `conference_attendees`
--

CREATE TABLE `conference_attendees` (
  `conference_id` int(11) NOT NULL,
  `attendee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conference_attendees`
--

INSERT INTO `conference_attendees` (`conference_id`, `attendee_id`) VALUES
(17, 5),
(18, 1),
(19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `journal_DOI` varchar(30) NOT NULL,
  `journal_title` varchar(45) NOT NULL,
  `journal_publish` datetime DEFAULT NULL,
  `journal_category` varchar(255) NOT NULL,
  `journal_country` varchar(255) NOT NULL,
  `journal_email` varchar(255) NOT NULL,
  `journal_references` text NOT NULL,
  `journal_affiliation` varchar(128) NOT NULL,
  `journal_status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`journal_DOI`, `journal_title`, `journal_publish`, `journal_category`, `journal_country`, `journal_email`, `journal_references`, `journal_affiliation`, `journal_status`) VALUES
('10022/1', 'Journal for Jane', '2020-11-02 00:00:00', 'Conference Paper', 'Canada', 'jane@email.com', 'Test', 'U of C', 0),
('102222/1', 'Test Journal', '0000-00-00 00:00:00', 'Review article', '', 'name@example.ca', 'Test', '0', 2),
('102222/2', 'Test Journal', '0000-00-00 00:00:00', 'Review article', '', 'nathan.sehn@ucalgary.ca', 'Test', 'U of C', 2),
('102222/3', 'Author Link Test', '2015-02-02 00:00:00', 'Journal article', 'Canada', 'name@example.ca', 'Testing Author Link', 'U of C', 2),
('102222/4', 'Author Link Test', '2015-02-03 00:00:00', 'Review article', 'Canada', 'name@example.ca', 'Testing Author Link', 'U of C', 1),
('102222/5', 'Author Link Test', '2015-02-02 00:00:00', 'Journal article', 'Canada', 'name@example.ca', 'Testing Author Link', 'U of C', 2),
('102222/6', 'Author Link Test', '2015-02-05 00:00:00', 'Systematic analysis', 'Canada', 'name@example.ca', 'Testing Author Link', 'U of C', 2),
('102222/7', 'Author Link Test', '2015-02-04 00:00:00', 'Review article', 'Canada', 'name@example.ca', 'Testing Author Link', 'U of C', 0),
('66666666666', '66666666666', '2012-12-12 00:00:00', 'Book', 'Republic of Gene', 'gene@email.com', 'Gene', 'Gene', 0);

-- --------------------------------------------------------

--
-- Table structure for table `journal_authors`
--

CREATE TABLE `journal_authors` (
  `authors_id` int(11) NOT NULL,
  `journal_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_authors`
--

INSERT INTO `journal_authors` (`authors_id`, `journal_id`) VALUES
(1, '102222/1'),
(1, '102222/2'),
(1, '102222/3'),
(2, '102222/4'),
(2, '102222/5'),
(2, '102222/6'),
(2, '102222/7'),
(3, '66666666666'),
(5, '10022/1');

-- --------------------------------------------------------

--
-- Table structure for table `journal_documents`
--

CREATE TABLE `journal_documents` (
  `journal_DOI` varchar(30) NOT NULL,
  `journal_document` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_documents`
--

INSERT INTO `journal_documents` (`journal_DOI`, `journal_document`) VALUES
('. $journal_DOI . ', ''),
('. $journal_DOI . ', 0x4172726179),
('. $journal_DOI . ', 0x443a58414d5050096d70706870313730392e746d70),
('. <?$journal_DOI ?>. ', 0x443a58414d5050096d70706870384442442e746d70),
('<?$journal_DOI ?>', 0x443a58414d5050096d70706870353541312e746d70),
('102222/1', 0x443a58414d5050096d70706870384342422e746d70),
('102222/2', 0x2e2f75706c6f616465645f66696c65732f5465737420446f63756d656e742e646f6378);

-- --------------------------------------------------------

--
-- Table structure for table `journal_reviews`
--

CREATE TABLE `journal_reviews` (
  `journal_DOI` varchar(30) NOT NULL,
  `journal_Sreview` int(5) NOT NULL,
  `journal_Wreview` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_reviews`
--

INSERT INTO `journal_reviews` (`journal_DOI`, `journal_Sreview`, `journal_Wreview`) VALUES
('102222/4', 1, 'review content: great paper!'),
('10022/1', 1, 'Good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_uid` (`account_uid`),
  ADD UNIQUE KEY `account_id_UNIQUE` (`account_id`);

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`conf_id`),
  ADD UNIQUE KEY `conf_id_UNIQUE` (`conf_id`),
  ADD KEY `conf_host_idx` (`conf_host_id`,`conf_approved_id`),
  ADD KEY `approved_id_idx` (`conf_approved_id`),
  ADD KEY `conf_journal_id` (`conf_journal_DOI`);

--
-- Indexes for table `conference_attendees`
--
ALTER TABLE `conference_attendees`
  ADD PRIMARY KEY (`conference_id`,`attendee_id`),
  ADD KEY `attendee_idx` (`attendee_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`journal_DOI`),
  ADD UNIQUE KEY `journal_id_UNIQUE` (`journal_DOI`);

--
-- Indexes for table `journal_authors`
--
ALTER TABLE `journal_authors`
  ADD PRIMARY KEY (`authors_id`,`journal_id`),
  ADD KEY `journals_idx` (`journal_id`);

--
-- Indexes for table `journal_reviews`
--
ALTER TABLE `journal_reviews`
  ADD KEY `journal_DOI` (`journal_DOI`),
  ADD KEY `journal_Sreview` (`journal_Sreview`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conference`
--
ALTER TABLE `conference`
  MODIFY `conf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `approved_id` FOREIGN KEY (`conf_approved_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `conf_journal_id` FOREIGN KEY (`conf_journal_DOI`) REFERENCES `journal` (`journal_DOI`),
  ADD CONSTRAINT `host_id` FOREIGN KEY (`conf_host_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `conference_attendees`
--
ALTER TABLE `conference_attendees`
  ADD CONSTRAINT `attendee` FOREIGN KEY (`attendee_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `conference` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`conf_id`);

--
-- Constraints for table `journal_authors`
--
ALTER TABLE `journal_authors`
  ADD CONSTRAINT `authors` FOREIGN KEY (`authors_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `journal` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`journal_DOI`);

--
-- Constraints for table `journal_reviews`
--
ALTER TABLE `journal_reviews`
  ADD CONSTRAINT `journal_DOI` FOREIGN KEY (`journal_DOI`) REFERENCES `journal` (`journal_DOI`),
  ADD CONSTRAINT `journal_Sreview` FOREIGN KEY (`journal_Sreview`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
