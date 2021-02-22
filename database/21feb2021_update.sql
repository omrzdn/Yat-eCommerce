CREATE TABLE `shop`.`categories` 
( `ID` SMALLINT NOT NULL AUTO_INCREMENT ,
 `Name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `Description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
   `Ordering` INT(11) NOT NULL , `visibility` TINYINT NOT NULL DEFAULT '0' ,
    `Allow_Comment` TINYINT NOT NULL DEFAULT '0' ,
     `Allow_Ads` TINYINT NOT NULL DEFAULT '0' ,
      PRIMARY KEY (`ID`), UNIQUE (`Name`))
       ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

ALTER TABLE `categories` CHANGE `ID` `ID` INT(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `shop`.`items` 
( `Item_ID` INT(11) NOT NULL AUTO_INCREMENT ,
 `Name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `Description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
   `Price` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `Add-Date` DATE NOT NULL ,
     `Country_Made` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
      `Image` VARCHAR(255) NOT NULL ,
       `Status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
        `Rating` SMALLINT NOT NULL ,
         `Cat_ID` INT(11) NOT NULL ,
          `Member_ID` INT(11) NOT NULL ,
           PRIMARY KEY (`Item_ID`))
            ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

ALTER TABLE items

ADD CONSTRAINT member_1

FOREIGN KEY(Member_ID)

REFERENCES users(UserID)

ON UPDATE CASCADE

ON DELETE CASCADE;


ALTER TABLE items

ADD CONSTRAINT cat_1

FOREIGN KEY(Cat_ID)

REFERENCES categories(ID)

ON UPDATE CASCADE

ON DELETE CASCADE;

CREATE TABLE `shop`.`comments` 
( `c_id` INT(11) NOT NULL AUTO_INCREMENT ,
 `comment` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `status` TINYINT NOT NULL , `comment_date` DATE NOT NULL ,
   `item_id` INT NOT NULL ,
    `user_id` INT NOT NULL ,
     PRIMARY KEY (`c_id`))
      ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

ALTER TABLE `comments` ADD CONSTRAINT items_comment
FOREIGN KEY(item_id) REFERENCES items(Item_ID)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE `comments` ADD CONSTRAINT comment_user 
FOREIGN KEY(user_id) REFERENCES users(UserID)
ON UPDATE CASCADE
ON DELETE CASCADE;