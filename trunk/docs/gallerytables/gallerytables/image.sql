CREATE TABLE `image` (
`image_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`image` TEXT NULL ,
`user_id` INT( 11 ) NULL ,
`album_id` INT( 11 ) NULL ,
`caption` VARCHAR( 200 ) NULL ,
`imagedate` DATETIME NULL
) ENGINE = MYISAM ;
