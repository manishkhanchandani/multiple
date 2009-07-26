QUERY FOR TABLE -forum_category

CREATE TABLE `forum_category` (
`category_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`category_name` VARCHAR( 100 ) NOT NULL
) ENGINE = MYISAM ;




==========================================================================================
QUERY FOR TABLE -forum_post

CREATE TABLE `forum_post` (
`post_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 10 ) NULL ,
`category_id` INT( 10 ) NULL ,
`post_title` VARCHAR( 100 ) NULL ,
`post_description` VARCHAR( 100 ) NULL ,
`posted_date` DATETIME NULL ,
`community_id` INT( 10 ) NULL DEFAULT '0'
) ENGINE = MYISAM ;


==========================================================================================

QUERY FOR TABLE -forum_thread


CREATE TABLE `forum_thread` (
`thread_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`post_id` INT( 10 ) NOT NULL ,
`user_id` INT( 10 ) NOT NULL ,
`parent_id` INT( 10 ) NOT NULL ,
`thread_date` DATETIME NULL ,
`thread_title` VARCHAR( 100 ) NULL ,
`thread_description` VARCHAR( 100 ) NULL
) ENGINE = MYISAM ;
