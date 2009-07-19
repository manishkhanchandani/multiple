CREATE TABLE `users` (
`user_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`email` VARCHAR( 150 ) NULL ,
`password` VARCHAR( 50 ) NULL ,
`name` VARCHAR( 50 ) NULL ,
`created` DATETIME NULL ,
`role` ENUM( 'Admin', 'Member' ) NOT NULL DEFAULT 'Member'
) ENGINE = MYISAM 