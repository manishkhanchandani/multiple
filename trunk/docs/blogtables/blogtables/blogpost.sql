CREATE TABLE `blog_post` (
`post_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 10 ) NULL ,
`category_id` INT( 10 ) NULL ,
`postdate` DATETIME NULL ,
`Title` TEXT NULL ,
`Description` TEXT NULL
) ENGINE = MYISAM ;