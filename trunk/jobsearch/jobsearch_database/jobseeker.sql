CREATE TABLE IF NOT EXISTS `jobseekers` (
  `seeker_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone_no` varchar(25) DEFAULT NULL,
  `current_location` varchar(25) NOT NULL,
  `experience_years` int(4) NOT NULL,
  `experience_months` int(4) NOT NULL,
  `job_category` varchar(25) NOT NULL,
  `specialization` varchar(30) DEFAULT NULL,
  `university` varchar(30) DEFAULT NULL,
  `role` varchar(30) NOT NULL,
  `resume_title` text,
  `summary` text,
  `resume_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seeker_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

