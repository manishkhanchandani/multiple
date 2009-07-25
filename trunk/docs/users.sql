CREATE TABLE `users` (
`user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`email` VARCHAR( 150 ) NULL ,
`password` VARCHAR( 50 ) NULL ,
`name` VARCHAR( 50 ) NULL ,
`created_dt` DATETIME NULL ,
`last_login_dt` DATETIME NULL ,
`role` ENUM( 'Admin', 'Member' ) NOT NULL DEFAULT 'Member',
`status` INT( 4 ) NOT NULL DEFAULT '1'
) ENGINE = MYISAM 