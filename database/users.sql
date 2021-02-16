CREATE DATABASE `shop`;
USE `shop`;
CREATE TABLE `users` (
 `UserID` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify User' ,
 `Username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Username To Login' ,
 `Password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Password To Login' ,
 `Email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
 `FullName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
 `GroupID` INT(11) NOT NULL DEFAULT '0' COMMENT 'Identify User Group' ,
 `TrustStatus` INT(11) NOT NULL DEFAULT '0' COMMENT 'Seller Rank' ,
 `RegStatus` INT(11) NOT NULL DEFAULT '0' COMMENT 'User Approval' ,
 PRIMARY KEY (`UserID`)
 ) ENGINE = InnoDB;
