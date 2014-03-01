-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2014 at 02:04 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uict_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(50) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semister` int(1) NOT NULL,  
  `start_date` varchar(20) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `communication`
--

CREATE TABLE IF NOT EXISTS `communication` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `links` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `expenditure`
--

CREATE TABLE IF NOT EXISTS `expenditure` (
  `id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `destination` text NOT NULL,
  `description` text NOT NULL,
  `amount` int(50) NOT NULL,
  `recorded_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `master_name` (
  `reg_no` varchar(50) NOT NULL,
   date_added DATETIME,
   date_modified DATETIME,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `YOS` int(1) NOT NULL,
  `skills` text NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  PRIMARY KEY (`reg_no`),
  KEY `reg_no` (`reg_no`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `program_name` varchar(200) NOT NULL,
  `college` varchar(200) NOT NULL,
  PRIMARY KEY (`program_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` varchar(200) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_detail`
--

CREATE TABLE IF NOT EXISTS `project_detail` (
  `project_id` varchar(50) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  PRIMARY KEY (`project_id`,`reg_no`),
  KEY `reg_no` (`reg_no`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `serialno` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`serialno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `revenue`
--

CREATE TABLE IF NOT EXISTS `revenue` (
  `id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `source` text NOT NULL,
  `description` text NOT NULL,
  `income` varchar(50) NOT NULL,
  `recorded by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`reg_id`),
  KEY `reg_no` (`reg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Table structure for table `personal_notes`
--

CREATE TABLE personal_notes (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
reg_no char(20) NOT NULL,
date_added DATETIME,
date_modified DATETIME,
note TEXT
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `calender_events`
--

CREATE TABLE calendar_events (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
event_title VARCHAR (25),
event_shortdesc VARCHAR (255),
event_start DATETIME
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE address (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
reg_no char(20) NOT NULL,
date_added DATETIME,
date_modified DATETIME,
address VARCHAR (255),
city VARCHAR (30),
state CHAR (2),
zipcode VARCHAR (10),
type ENUM ('home', 'work', 'other')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE telephone (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
reg_no char(20) NOT NULL,
date_added DATETIME,
date_modified DATETIME,
tel_number VARCHAR (25),
type ENUM ('home', 'work', 'other')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE fax (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
reg_no char(20) NOT NULL,
date_added DATETIME,
date_modified DATETIME,
fax_number VARCHAR (25),
type ENUM ('home', 'work', 'other')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE email (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
reg_no char(20) NOT NULL,
date_added DATETIME,
date_modified DATETIME,
email VARCHAR (150),
type ENUM ('home', 'work', 'other')
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `forum_topics`
--

CREATE TABLE forum_topics (
            topic_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            topic_title VARCHAR (150),
            topic_create_time DATETIME,
            topic_owner VARCHAR (150)
            )ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `forum_posts`
--

CREATE TABLE forum_posts (
          post_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
          topic_id INT NOT NULL,
          post_text TEXT,
          post_create_time DATETIME,
          post_owner VARCHAR (150)
                )ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--


--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `member` (`reg_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
