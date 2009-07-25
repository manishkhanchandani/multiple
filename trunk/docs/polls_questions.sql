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
) ENGINE=MyISAM