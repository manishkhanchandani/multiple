CREATE TABLE `matri`.`matrimony` (
`profile_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`name` VARCHAR( 255 ) NULL ,
`gender` ENUM( 'Male', 'Female' ) NULL ,
`bday` INT( 2 ) NULL ,
`bmonth` INT( 2 ) NULL ,
`byear` INT( 4 ) NULL ,
`marital_status` INT( 2 ) NULL ,
`religion` VARCHAR( 200 ) NULL ,
`mothertongue` VARCHAR( 200 ) NULL ,
`country` VARCHAR( 200 ) NULL ,
`contactno` VARCHAR( 50 ) NULL ,
`highestdegree` VARCHAR( 50 ) NULL ,
`workarea` VARCHAR( 50 ) NULL DEFAULT '',
`annual_income` VARCHAR( 50 ) NULL DEFAULT ''
) ENGINE = MYISAM 