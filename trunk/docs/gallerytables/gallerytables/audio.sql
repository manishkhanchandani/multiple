CREATE TABLE `audio` (
`audio_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`album_id` INT( 11 ) NULL ,
`user_id` INT( 11 ) NULL ,
`album` VARCHAR( 200 ) NULL ,
`albumdate` DATETIME NULL ,
`description` TEXT NULL
) ENGINE = MYISAM ;