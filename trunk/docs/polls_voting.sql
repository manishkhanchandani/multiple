CREATE TABLE IF NOT EXISTS `polls_voting` (
  `voting_id` int(11) NOT NULL AUTO_INCREMENT,
  `voting_user_id` int(11) DEFAULT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_num` int(11) DEFAULT NULL,
  `voting_date` datetime DEFAULT NULL,
  PRIMARY KEY (`voting_id`)
) ENGINE=MyISAM 