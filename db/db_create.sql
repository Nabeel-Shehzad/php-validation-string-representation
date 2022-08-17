USE cs3620;
CREATE TABLE `cs3620`.`test` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `col_number` INT NULL,
  `col_string` VARCHAR(255) NULL,
  `col_dttm` DATETIME,
  `col_password` VARCHAR(255) NULL,
  PRIMARY KEY (`ID`));
TRUNCATE `cs3620`.`test`;
GRANT SELECT,DELETE,INSERT,UPDATE ON cs3620.* TO 'cs3620'@'%';

