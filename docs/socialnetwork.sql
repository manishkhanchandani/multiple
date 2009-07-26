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

-- --------------------------------------------------------

--
-- Table structure for table `blogs_category`
--

CREATE TABLE IF NOT EXISTS `blogs_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogs_post`
--

CREATE TABLE IF NOT EXISTS `blogs_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `postdate` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `community_categories`
--

CREATE TABLE IF NOT EXISTS `community_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `community_details`
--

CREATE TABLE IF NOT EXISTS `community_details` (
  `community_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `community_type` int(1) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `community_date` datetime DEFAULT NULL,
  PRIMARY KEY (`community_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `commentor` int(11) DEFAULT NULL,
  `comment_title` varchar(200) DEFAULT NULL,
  `comment_body` text,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `comment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `invited_to_id` int(11) DEFAULT NULL,
  `invitation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`invite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `polls_questions`
--

CREATE TABLE IF NOT EXISTS `polls_questions` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poll_question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text,
  `option4` text,
  `option5` text,
  `option6` text,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `polls_voting`
--

CREATE TABLE IF NOT EXISTS `polls_voting` (
  `voting_id` int(11) NOT NULL AUTO_INCREMENT,
  `voting_user_id` int(11) DEFAULT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_num` int(11) DEFAULT NULL,
  `voting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`voting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile1`
--

CREATE TABLE IF NOT EXISTS `profile1` (
  `user_id` int(11) NOT NULL,
  `gender` enum('Male','Female','Couple') DEFAULT NULL,
  `bDay` int(2) DEFAULT NULL,
  `bMonth` int(2) DEFAULT NULL,
  `bYear` int(4) DEFAULT NULL,
  `marital_status` int(2) DEFAULT NULL,
  `religion` int(4) DEFAULT NULL,
  `caste` int(4) DEFAULT NULL,
  `height` int(4) DEFAULT NULL,
  `build` int(4) DEFAULT NULL,
  `looks` int(4) DEFAULT NULL,
  `eyecolor` int(4) DEFAULT NULL,
  `haircolor` int(4) DEFAULT NULL,
  `bestfeature` int(4) DEFAULT NULL,
  `income` int(2) DEFAULT NULL,
  `educationLevel` int(4) DEFAULT NULL,
  `profession` int(4) DEFAULT NULL,
  `country_id` int(4) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zipcode_id` int(11) NOT NULL,
  `smoking` int(1) DEFAULT NULL,
  `drinking` int(1) DEFAULT NULL,
  `food` int(1) DEFAULT NULL,
  `friends` int(1) DEFAULT NULL,
  `activity_partners` int(1) DEFAULT NULL,
  `business_networking` int(1) DEFAULT NULL,
  `dating` int(1) DEFAULT NULL,
  `dating_type` int(1) DEFAULT NULL,
  `living` int(1) DEFAULT NULL,
  `pets` int(1) NOT NULL DEFAULT '0',
  `sexual_orientation` int(1) DEFAULT NULL,
  `children` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile2`
--

CREATE TABLE IF NOT EXISTS `profile2` (
  `user_id` int(11) NOT NULL,
  `aboutme` text,
  `myfamily` text,
  `image` text,
  `highschool` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `im_yahoo` varchar(255) DEFAULT NULL,
  `im_msn` varchar(255) DEFAULT NULL,
  `im_gmail` varchar(255) DEFAULT NULL,
  `im_jabber` varchar(255) DEFAULT NULL,
  `im_other` varchar(255) DEFAULT NULL,
  `homephone` varchar(50) DEFAULT NULL,
  `cellphone` varchar(50) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `headline` varchar(200) DEFAULT NULL,
  `firstthing` varchar(255) DEFAULT NULL,
  `firstdate` text,
  `pastrelation` text,
  `fivethings` text,
  `bedroomthings` text,
  `idealmatch` text,
  `occupation` varchar(200) DEFAULT NULL,
  `industry` int(4) DEFAULT NULL,
  `company_webpage` varchar(255) DEFAULT NULL,
  `company_title` varchar(200) DEFAULT NULL,
  `job_description` text,
  `workphone` varchar(50) DEFAULT NULL,
  `work_email` varchar(150) DEFAULT NULL,
  `career_skills` text,
  `career_interests` text,
  `hometown` varchar(100) DEFAULT NULL,
  `webpage` varchar(255) DEFAULT NULL,
  `sports` text,
  `activities` text,
  `books` text,
  `music` text,
  `tvshows` text,
  `movies` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `last_login_dt` datetime DEFAULT NULL,
  `role` enum('Admin','Member') NOT NULL DEFAULT 'Member',
  `status` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
