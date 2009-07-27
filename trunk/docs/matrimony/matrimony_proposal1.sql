CREATE TABLE `matri`.`matrimony_proposal` (
`proposal_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NOT NULL ,
`proposed_to_id` INT( 11 ) NOT NULL ,
`proposal_date` DATETIME NULL
) ENGINE = MYISAM 