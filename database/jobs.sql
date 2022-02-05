-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2022 at 05:13 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobs`
--
CREATE DATABASE IF NOT EXISTS `jobs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jobs`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `user_id` varchar(50) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`user_id`, `pwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE IF NOT EXISTS `apply` (
  `apply_id` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `job_id` int(11) NOT NULL,
  `apply_date` date NOT NULL,
  PRIMARY KEY (`apply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`apply_id`, `email_id`, `job_id`, `apply_date`) VALUES
(1, 'shikha@yahoo.com', 1, '2022-01-27'),
(2, 'dev@yahoo.com', 5, '2022-02-05'),
(3, 'dev@yahoo.com', 2, '2022-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `company_regis`
--

CREATE TABLE IF NOT EXISTS `company_regis` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `regis_date` date NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_regis`
--

INSERT INTO `company_regis` (`company_id`, `company_name`, `address`, `city`, `state`, `mobile_no`, `email_id`, `pwd`, `regis_date`) VALUES
(1, 'reliance', 'valsad', 'valsad', 'gujarat', '9876543210', 'reliance@yahoo.com', '111111', '2016-02-13'),
(2, 'VNSGU', 'surat', 'surat', 'gujarat', '9876543210', 'vnsgu@yahoo.com', '111111', '2016-02-17'),
(3, 'Infosys', 'Banglore', 'banglore', 'Tamil Nadu', '9876543210', 'infosys@yahoo.com', '111111', '2016-02-17'),
(4, 'zydus', 'Ankleshwar', 'ankleshwar', 'gujarat', '9876543210', 'zydus@yahoo.com', '111111', '2016-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE IF NOT EXISTS `job_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(80) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`cat_id`, `cat_name`) VALUES
(1, 'Professor'),
(2, 'Developer'),
(3, 'Engineer'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `job_detail`
--

CREATE TABLE IF NOT EXISTS `job_detail` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(50) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_description` varchar(300) NOT NULL,
  `salary` int(10) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_detail`
--

INSERT INTO `job_detail` (`job_id`, `job_name`, `sub_cat_id`, `city`, `company_id`, `job_description`, `salary`) VALUES
(1, 'java developer', 5, 'baroda', 1, 'java developer', 600000),
(2, 'java professor', 1, 'surat', 2, 'minimum experience 2 year ', 144000),
(3, 'Accounts ', 2, 'surat', 2, 'minimum experience 4 year', 100000),
(4, 'Organic chemistry', 3, 'valsad', 2, 'minimum experience 1 year', 90000),
(5, 'Android Devloper', 5, 'ahmdabad', 1, 'skills of java and kotlin programming language', 120000),
(6, 'manager', 12, 'mumbai', 1, 'experience of 2 year ', 140000),
(7, 'physics professor', 4, 'vapi', 2, 'minimum experience 2 year ', 120000),
(8, 'Android Devloper', 9, 'puna', 1, 'skills of java and kotlin programming language', 155000),
(9, 'php developer', 7, 'surat', 1, 'experience of 2 year ', 120000),
(10, 'java developer', 6, 'chennai', 3, 'minimum 3 year of experience', 200000),
(11, 'plsql devloper', 8, 'madurai', 3, 'minimum 3 year of experience', 140000),
(12, 'engineer', 10, 'chennai', 3, 'minimum 4 year of experience', 144000),
(13, 'engineer', 11, 'madurai', 3, 'minimum 1 year of experience', 100000),
(14, 'engineer', 11, 'madurai', 3, 'minimum 2 year of experience', 120000),
(15, 'engineer', 13, 'chennai', 3, 'minimum 3 year of experience', 155000),
(16, 'manager', 15, 'ahmdabad', 4, 'minimum 2 year experience', 140000),
(17, 'manager', 16, 'mumbai', 4, 'minimum 2 year experience', 160000),
(18, 'manager', 18, 'surat', 4, 'minimum 1 year experience', 100000),
(19, 'manager', 19, 'surat', 4, 'minimum 3 year experience', 140000);

-- --------------------------------------------------------

--
-- Table structure for table `job_sub_cat`
--

CREATE TABLE IF NOT EXISTS `job_sub_cat` (
  `sub_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat` varchar(50) NOT NULL,
  PRIMARY KEY (`sub_cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_sub_cat`
--

INSERT INTO `job_sub_cat` (`sub_cat_id`, `cat_id`, `sub_cat`) VALUES
(1, 1, 'Computer department professor'),
(2, 1, 'Commerce department professor'),
(3, 1, 'Chemistry department professor'),
(4, 1, 'Physics department professor'),
(5, 2, 'Software developer'),
(6, 2, 'Java developer'),
(7, 2, 'Php developer'),
(8, 2, 'PlSql developer'),
(9, 2, 'Android developer'),
(10, 3, 'Mechanical Engineer'),
(11, 3, 'Electrical Engineer'),
(12, 3, 'IT Engineer'),
(13, 3, 'Civil Engineer'),
(14, 3, 'Software Engineer'),
(15, 4, 'Sales Manager'),
(16, 4, 'Account Manager'),
(18, 4, 'Marketing Manager'),
(19, 4, 'Project Manager');

-- --------------------------------------------------------

--
-- Table structure for table `resume_master`
--

CREATE TABLE IF NOT EXISTS `resume_master` (
  `resume_id` int(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `resume_path` varchar(50) NOT NULL,
  PRIMARY KEY (`resume_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resume_master`
--

INSERT INTO `resume_master` (`resume_id`, `email_id`, `resume_path`) VALUES
(1, 'shikha@yahoo.com', 'bio/8147.jpg'),
(2, 'dev@yahoo.com', 'bio/1808.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_regis`
--

CREATE TABLE IF NOT EXISTS `user_regis` (
  `full_name` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `regis_date` date NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_regis`
--

INSERT INTO `user_regis` (`full_name`, `address`, `city`, `state`, `mob_no`, `email_id`, `pwd`, `regis_date`) VALUES
('dev', 'valsad', 'valsad', 'gujarat', '9876543210', 'dev@yahoo.com', '111111', '2016-02-09'),
('shikha', 'valsad', 'valsad', 'gujarat', '7894561230', 'shikha@yahoo.com', '111111', '2016-02-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
