CREATE TABLE IF NOT EXISTS `active` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_date` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`activity_id`)
