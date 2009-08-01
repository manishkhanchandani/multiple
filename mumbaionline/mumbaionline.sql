/*
SQLyog Community Edition- MySQL GUI v6.15
MySQL - 5.0.67 : Database - socialnetwork09
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `socialnetwork09`;

USE `socialnetwork09`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `activity` */

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `activity_date` int(11) default NULL,
  `description` text,
  PRIMARY KEY  (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `activity` */

/*Table structure for table `advertisements` */

DROP TABLE IF EXISTS `advertisements`;

CREATE TABLE `advertisements` (
  `advt_id` int(11) NOT NULL auto_increment,
  `advt_type` enum('Image','Text') NOT NULL default 'Text',
  `title` varchar(200) default NULL,
  `description` text,
  `image` varchar(255) default NULL,
  `advt_date` datetime default NULL,
  `exp_date` int(11) default NULL,
  PRIMARY KEY  (`advt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `advertisements` */

/*Table structure for table `album` */

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `album` text NOT NULL,
  PRIMARY KEY  (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `album` */

/*Table structure for table `audio` */

DROP TABLE IF EXISTS `audio`;

CREATE TABLE `audio` (
  `audio_id` int(11) NOT NULL auto_increment,
  `album_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `album` varchar(200) default NULL,
  `albumdate` datetime default NULL,
  `description` text,
  PRIMARY KEY  (`audio_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `audio` */

/*Table structure for table `blog_category` */

DROP TABLE IF EXISTS `blog_category`;

CREATE TABLE `blog_category` (
  `category_id` int(10) NOT NULL auto_increment,
  `category` text,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `blog_category` */

/*Table structure for table `blog_comment` */

DROP TABLE IF EXISTS `blog_comment`;

CREATE TABLE `blog_comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `post_id` int(11) default NULL,
  `commentdate` datetime default NULL,
  `description` text,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `blog_comment` */

/*Table structure for table `blog_post` */

DROP TABLE IF EXISTS `blog_post`;

CREATE TABLE `blog_post` (
  `post_id` int(10) NOT NULL auto_increment,
  `user_id` int(10) default NULL,
  `category_id` int(10) default NULL,
  `postdate` datetime default NULL,
  `title` text,
  `description` text,
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `blog_post` */

/*Table structure for table `community` */

DROP TABLE IF EXISTS `community`;

CREATE TABLE `community` (
  `community_id` int(10) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `community_name` varchar(50) default NULL,
  `category_id` int(10) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `postal_code` int(100) default NULL,
  `country` varchar(100) default NULL,
  `image` varchar(100) default NULL,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`community_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `community` */

/*Table structure for table `community_category` */

DROP TABLE IF EXISTS `community_category`;

CREATE TABLE `community_category` (
  `category_id` int(10) NOT NULL auto_increment,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `community_category` */

/*Table structure for table `community_member` */

DROP TABLE IF EXISTS `community_member`;

CREATE TABLE `community_member` (
  `member_id` int(10) NOT NULL auto_increment,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `community_member` */

/*Table structure for table `community_message` */

DROP TABLE IF EXISTS `community_message`;

CREATE TABLE `community_message` (
  `message_id` int(10) NOT NULL auto_increment,
  `community_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `to_user_id` int(10) NOT NULL,
  `message_date` datetime NOT NULL,
  `message_title` varchar(100) default NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `community_message` */

/*Table structure for table `confession_category` */

DROP TABLE IF EXISTS `confession_category`;

CREATE TABLE `confession_category` (
  `category_id` int(11) NOT NULL auto_increment,
  `category` varchar(100) default NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `confession_category` */

insert  into `confession_category`(`category_id`,`category`) values (1,'Sex'),(2,'Love'),(3,'Hate'),(4,'Girl/Boyfriend'),(5,'Husband/Wife'),(6,'Religion'),(7,'Home and Family'),(8,'Revenge'),(9,'Disgusting'),(10,'Weird'),(11,'Other'),(12,'Funny');

/*Table structure for table `confession_descr` */

DROP TABLE IF EXISTS `confession_descr`;

CREATE TABLE `confession_descr` (
  `titleDescr_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `title` varchar(50) default NULL,
  `description` varchar(200) default NULL,
  `post_date` datetime default NULL,
  `category_id` int(11) default NULL,
  PRIMARY KEY  (`titleDescr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `confession_descr` */

/*Table structure for table `confession_titleSuggestion` */

DROP TABLE IF EXISTS `confession_titleSuggestion`;

CREATE TABLE `confession_titleSuggestion` (
  `titleSuggestion_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `titleDescr_id` int(11) default NULL,
  `suggestion` varchar(200) default NULL,
  `post_date` datetime default NULL,
  `accept` int(2) default NULL,
  PRIMARY KEY  (`titleSuggestion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `confession_titleSuggestion` */

/*Table structure for table `event_details` */

DROP TABLE IF EXISTS `event_details`;

CREATE TABLE `event_details` (
  `event_id` int(50) NOT NULL auto_increment,
  `event_title` varchar(50) default NULL,
  `event_description` mediumtext,
  `event_creator` varchar(20) default NULL,
  `created_on` datetime default NULL,
  `community_id` int(50) default NULL,
  PRIMARY KEY  (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `event_details` */

/*Table structure for table `forum_category` */

DROP TABLE IF EXISTS `forum_category`;

CREATE TABLE `forum_category` (
  `category_id` int(10) NOT NULL auto_increment,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum_category` */

/*Table structure for table `forum_comments` */

DROP TABLE IF EXISTS `forum_comments`;

CREATE TABLE `forum_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `post_id` int(11) default NULL,
  `commentor` int(11) default NULL,
  `comment_title` varchar(200) default NULL,
  `comment_body` text,
  `parent_id` int(11) NOT NULL default '0',
  `comment_date` datetime default NULL,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum_comments` */

/*Table structure for table `forum_post` */

DROP TABLE IF EXISTS `forum_post`;

CREATE TABLE `forum_post` (
  `post_id` int(10) NOT NULL auto_increment,
  `user_id` int(10) default NULL,
  `category_id` int(10) default NULL,
  `post_title` varchar(100) default NULL,
  `post_description` varchar(100) default NULL,
  `posted_date` datetime default NULL,
  `community_id` int(10) default '0',
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum_post` */

/*Table structure for table `forum_thread` */

DROP TABLE IF EXISTS `forum_thread`;

CREATE TABLE `forum_thread` (
  `thread_id` int(10) NOT NULL auto_increment,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `thread_date` datetime default NULL,
  `thread_title` varchar(100) default NULL,
  `thread_description` varchar(100) default NULL,
  PRIMARY KEY  (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum_thread` */

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `fid` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `friends` */

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL auto_increment,
  `image` text,
  `user_id` int(11) default NULL,
  `album_id` int(11) default NULL,
  `caption` varchar(200) default NULL,
  `imagedate` datetime default NULL,
  PRIMARY KEY  (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `image` */

/*Table structure for table `invitations` */

DROP TABLE IF EXISTS `invitations`;

CREATE TABLE `invitations` (
  `invite_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `invited_to_id` int(11) default NULL,
  `invitation_date` datetime default NULL,
  PRIMARY KEY  (`invite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `invitations` */

/*Table structure for table `lifereminder_PersonalInformation` */

DROP TABLE IF EXISTS `lifereminder_PersonalInformation`;

CREATE TABLE `lifereminder_PersonalInformation` (
  `personal_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `dob` date default NULL,
  `identification` varchar(100) default NULL,
  `bloodgrp` varchar(15) default NULL,
  `allergy` varchar(100) default NULL,
  `diasbilities` varchar(150) default NULL,
  `disease` varchar(150) default NULL,
  PRIMARY KEY  (`personal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lifereminder_PersonalInformation` */

insert  into `lifereminder_PersonalInformation`(`personal_id`,`user_id`,`dob`,`identification`,`bloodgrp`,`allergy`,`diasbilities`,`disease`) values (1,1,'1985-03-12','mole on chick','A+','no','no','no');

/*Table structure for table `lifereminder_friend` */

DROP TABLE IF EXISTS `lifereminder_friend`;

CREATE TABLE `lifereminder_friend` (
  `friendid` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  `category` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  PRIMARY KEY  (`friendid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lifereminder_friend` */

insert  into `lifereminder_friend`(`friendid`,`user_id`,`name`,`category`,`email`) values (1,1,'rahhi','Friend','rakhisawant@xoriant.com');

/*Table structure for table `lifereminder_reminder` */

DROP TABLE IF EXISTS `lifereminder_reminder`;

CREATE TABLE `lifereminder_reminder` (
  `reminder_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `account` varchar(50) default NULL,
  `accountno` varchar(25) default NULL,
  `description` varchar(200) default NULL,
  `contact` varchar(50) default NULL,
  `place` varchar(30) default NULL,
  `file` varchar(40) default NULL,
  `friendid` int(11) default NULL,
  PRIMARY KEY  (`reminder_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lifereminder_reminder` */

insert  into `lifereminder_reminder`(`reminder_id`,`user_id`,`account`,`accountno`,`description`,`contact`,`place`,`file`,`friendid`) values (1,1,'Message','','djffjkdfdf k','rakhi','canada','1_1249108530_Rescued document.txt',1);

/*Table structure for table `lifereminder_wishes` */

DROP TABLE IF EXISTS `lifereminder_wishes`;

CREATE TABLE `lifereminder_wishes` (
  `wishes_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `donations` varchar(50) default NULL,
  `description` varchar(200) default NULL,
  `institution` varchar(50) default NULL,
  `friendid` int(11) default NULL,
  PRIMARY KEY  (`wishes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `lifereminder_wishes` */

/*Table structure for table `polls_questions` */

DROP TABLE IF EXISTS `polls_questions`;

CREATE TABLE `polls_questions` (
  `poll_id` int(11) NOT NULL auto_increment,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text,
  `option4` text,
  `option5` text,
  `creation_date` datetime default NULL,
  `expiry_date` datetime default NULL,
  PRIMARY KEY  (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `polls_questions` */

/*Table structure for table `polls_voting` */

DROP TABLE IF EXISTS `polls_voting`;

CREATE TABLE `polls_voting` (
  `voting_id` int(11) NOT NULL auto_increment,
  `voting_user_id` int(11) default NULL,
  `poll_id` int(11) default NULL,
  `option_num` int(11) default NULL,
  `voting_date` datetime default NULL,
  PRIMARY KEY  (`voting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `polls_voting` */

/*Table structure for table `profile1` */

DROP TABLE IF EXISTS `profile1`;

CREATE TABLE `profile1` (
  `user_id` int(11) NOT NULL,
  `gender` enum('Male','Female','Couple') default NULL,
  `bDay` int(2) default NULL,
  `bMonth` int(2) default NULL,
  `bYear` int(4) default NULL,
  `marital_status` int(2) default NULL,
  `religion` int(4) default NULL,
  `caste` int(4) default NULL,
  `height` int(4) default NULL,
  `build` int(4) default NULL,
  `looks` int(4) default NULL,
  `eyecolor` int(4) default NULL,
  `haircolor` int(4) default NULL,
  `bestfeature` int(4) default NULL,
  `income` int(2) default NULL,
  `educationLevel` int(4) default NULL,
  `profession` int(4) default NULL,
  `country` varchar(50) default NULL,
  `province` varchar(25) default NULL,
  `city` varchar(25) default NULL,
  `zipcode` varchar(11) NOT NULL,
  `smoking` int(1) default NULL,
  `drinking` int(1) default NULL,
  `food` int(1) default NULL,
  `friends` int(1) default NULL,
  `activity_partners` int(1) default NULL,
  `business_networking` int(1) default NULL,
  `dating` int(1) default NULL,
  `dating_type` int(1) default NULL,
  `living` int(1) default NULL,
  `pets` int(1) NOT NULL default '0',
  `sexual_orientation` int(1) default NULL,
  `children` int(1) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `profile1` */

insert  into `profile1`(`user_id`,`gender`,`bDay`,`bMonth`,`bYear`,`marital_status`,`religion`,`caste`,`height`,`build`,`looks`,`eyecolor`,`haircolor`,`bestfeature`,`income`,`educationLevel`,`profession`,`country`,`province`,`city`,`zipcode`,`smoking`,`drinking`,`food`,`friends`,`activity_partners`,`business_networking`,`dating`,`dating_type`,`living`,`pets`,`sexual_orientation`,`children`) values (1,'Male',5,6,1974,5,8,NULL,69,1,2,1,2,1,NULL,6,NULL,'India','Maharashtra','mumbai','400078',1,1,NULL,1,0,1,0,3,7,4,1,2),(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(4,NULL,11,3,1988,1,0,NULL,53,0,0,0,0,0,NULL,NULL,NULL,'India','Maharashtra','Mumbai','400071',0,0,NULL,1,0,0,0,1,1,0,0,0);

/*Table structure for table `profile2` */

DROP TABLE IF EXISTS `profile2`;

CREATE TABLE `profile2` (
  `user_id` int(11) NOT NULL,
  `aboutme` text,
  `myfamily` text,
  `image` text,
  `highschool` varchar(255) default NULL,
  `college` varchar(255) default NULL,
  `company` varchar(255) default NULL,
  `im_yahoo` varchar(255) default NULL,
  `im_msn` varchar(255) default NULL,
  `im_gmail` varchar(255) default NULL,
  `im_jabber` varchar(255) default NULL,
  `im_other` varchar(255) default NULL,
  `homephone` varchar(50) default NULL,
  `cellphone` varchar(50) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `headline` varchar(200) default NULL,
  `firstthing` varchar(255) default NULL,
  `firstdate` text,
  `pastrelation` text,
  `fivethings` text,
  `bedroomthings` text,
  `idealmatch` text,
  `occupation` varchar(200) default NULL,
  `industry` int(4) default NULL,
  `company_webpage` varchar(255) default NULL,
  `company_title` varchar(200) default NULL,
  `job_description` text,
  `workphone` varchar(50) default NULL,
  `work_email` varchar(150) default NULL,
  `career_skills` text,
  `career_interests` text,
  `hometown` varchar(100) default NULL,
  `webpage` varchar(255) default NULL,
  `sports` text,
  `activities` text,
  `books` text,
  `music` text,
  `tvshows` text,
  `movies` text,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `profile2` */

insert  into `profile2`(`user_id`,`aboutme`,`myfamily`,`image`,`highschool`,`college`,`company`,`im_yahoo`,`im_msn`,`im_gmail`,`im_jabber`,`im_other`,`homephone`,`cellphone`,`address1`,`address2`,`headline`,`firstthing`,`firstdate`,`pastrelation`,`fivethings`,`bedroomthings`,`idealmatch`,`occupation`,`industry`,`company_webpage`,`company_title`,`job_description`,`workphone`,`work_email`,`career_skills`,`career_interests`,`hometown`,`webpage`,`sports`,`activities`,`books`,`music`,`tvshows`,`movies`) values (1,'myself','my family','1-naveen_1998.jpg','New Era High School','Allagapa University','Xoriant Solutions Pvt. Ltd.','naveenkhanchandani@yahoo.com','','naveenkhanchandani@gmail.com','','','02225666057','9323532886','D 305, 306, Jalaram park, sonapur','lbs marg, bhandup(w),','headline','firstthing','first','past','five','bedroom','ideal match','software',9,'http://xoriant.com','title','job','333','manish.khanchandani@xoriant.com','career','career interest','mumbai','http://www.mumbaionline.org.in','sports','activities','books','music','tv shows','movies'),(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'The King','','4-Spiderman.jpg','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','Charming','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','');

/*Table structure for table `rsvp` */

DROP TABLE IF EXISTS `rsvp`;

CREATE TABLE `rsvp` (
  `id` int(50) NOT NULL auto_increment,
  `event_id` int(50) default NULL,
  `replier_id` int(50) default NULL,
  `reply` enum('yes','no','may be') default 'yes',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `rsvp` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(150) default NULL,
  `password` varchar(50) default NULL,
  `name` varchar(50) default NULL,
  `created_dt` datetime default NULL,
  `last_login_dt` datetime default NULL,
  `role` enum('Admin','Member') NOT NULL default 'Member',
  `status` int(4) NOT NULL default '1',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`email`,`password`,`name`,`created_dt`,`last_login_dt`,`role`,`status`) values (1,'naveenkhanchandani@gmail.com','passwords','Naveen Khanchandani','2009-07-26 20:18:53','2009-08-01 10:45:06','Member',1),(2,'farmfrenzygirla@ua-news.net','WnZNmVY663','Farmfrenzygirl','2009-07-27 11:31:17',NULL,'Member',1),(3,'karanrulz4ever@gmail.com','spring','Karan','2009-08-01 00:08:36','2009-08-01 00:09:26','Member',1),(4,'worldofhsegoy','dyknights','Yogesh','2009-08-01 00:32:13','2009-08-01 00:35:13','Member',1);

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `album_id` int(11) default NULL,
  `description` text,
  `videotext` text,
  `videodate` datetime default NULL,
  PRIMARY KEY  (`video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `video` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
