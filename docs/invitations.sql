CREATE TABLE `invitations` (
`invite_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) NULL ,
`invited_to_id` INT( 11 ) NULL ,
`invitation_date` DATETIME NULL
) ENGINE = MYISAM 