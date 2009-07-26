CREATE TABLE `community` (
`community_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`community_name` VARCHAR( 50 ) NULL ,
`category_id` INT( 10 ) NULL ,
`city` VARCHAR( 100 ) NULL ,
`state` VARCHAR( 100 ) NULL ,
`postal_code` INT( 100 ) NULL ,
`country` VARCHAR( 100 ) NULL ,
`image` VARCHAR( 100 ) NULL ,
`description` VARCHAR( 100 ) NULL
) ENGINE = MYISAM ;


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










