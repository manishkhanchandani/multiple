CREATE TABLE `video` (
`video_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`album_id` INT( 11 ) NULL ,
`description` TEXT NULL ,
`videotext` TEXT NULL ,
`videodate` DATETIME NULL
) ENGINE = MYISAM ;