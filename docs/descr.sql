CREATE TABLE `confession_descr` (
`titleDescr_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`title` VARCHAR( 50 ) NULL ,
`description` VARCHAR( 200 ) NULL ,
`post_date` DATETIME NULL
) ENGINE = MYISAM ;
