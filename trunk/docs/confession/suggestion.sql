CREATE TABLE `confession_titleSuggestion` (
`titleSuggestion_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`titleDescr_id` INT( 11 ) NULL ,
`suggestion` VARCHAR( 200 ) NULL ,
`post_date` DATETIME NULL ,
`accept` INT( 2 ) NULL
) ENGINE = MYISAM ;
