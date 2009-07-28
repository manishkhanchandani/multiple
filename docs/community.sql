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

=================================================================================


CREATE TABLE `community_message` (
`message_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`community_id` INT( 10 ) NOT NULL ,
`user_id` INT( 10 ) NOT NULL ,
`to_user_id` INT( 10 ) NOT NULL ,
`message_date` DATETIME NOT NULL ,
`message_title` VARCHAR( 100 ) NULL
) ENGINE = MYISAM ;


===========================================================================



CREATE TABLE `community_member` (
`member_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`community_id` INT NOT NULL ,
`user_id` INT NOT NULL
) ENGINE = MYISAM ;


===================================================================

CREATE TABLE `community_category` (
`category_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`category_name` VARCHAR( 100 ) NOT NULL
) ENGINE = MYISAM ;










