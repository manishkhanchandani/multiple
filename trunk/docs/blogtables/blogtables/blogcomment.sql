CREATE TABLE `blog_comment` (
`comment_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT NULL ,
`post_id` INT NULL ,
`commentdate` DATETIME NULL ,
`description` TEXT NULL
) ENGINE = MYISAM ;
