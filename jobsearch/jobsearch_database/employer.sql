CREATE TABLE IF NOT EXISTS `employer` (
  `employer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `copany_address` text NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `company_email` varchar(150) NOT NULL,
  `company_city` varchar(25) NOT NULL,
  `company_state` varchar(25) NOT NULL,
  `company_country` varchar(25) NOT NULL,
  `company_zip` varchar(10) NOT NULL,
  PRIMARY KEY (`employer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

