CREATE TABLE `forum_comments` (
`comment_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`post_id` INT( 11 ) NULL ,
`commentor` INT( 11 ) NULL ,
`comment_title` VARCHAR( 200 ) NULL ,
`comment_body` TEXT NULL ,
`parent_id` INT( 11 ) NOT NULL DEFAULT '0',
`comment_date` DATETIME NULL
) ENGINE = MYISAM ;