CREATE TABLE `matri`.`matrimony_msg` (
`msg_id` INT( 11 ) NOT NULL ,
`user_id` INT( 11 ) NOT NULL ,
`msg_to_id` INT( 11 ) NOT NULL ,
`msg_title` VARCHAR( 255 ) NULL ,
`message` TEXT NULL ,
`msg_date` DATETIME NULL ,
PRIMARY KEY ( `msg_id` )
) ENGINE = MYISAM 