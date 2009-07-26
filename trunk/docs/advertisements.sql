-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2009 at 11:44 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `advt_id` int(11) NOT NULL AUTO_INCREMENT,
  `advt_type` enum('Image','Text') NOT NULL DEFAULT 'Text',
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `advt_date` datetime DEFAULT NULL,
  `exp_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`advt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
