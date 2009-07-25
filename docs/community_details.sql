CREATE TABLE `community_details` (
`community_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`name` INT NULL ,
`category_id` INT NULL ,
`community_type` INT( 1 ) NULL ,
`city` VARCHAR( 50 ) NULL ,
`province` VARCHAR( 50 ) NULL ,
`country` VARCHAR( 50 ) NULL ,
`image` VARCHAR( 255 ) NULL ,
`description` TEXT NULL ,
`community_date` DATETIME NULL
) ENGINE = MYISAM 
