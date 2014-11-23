-- -----------------------------------------------------
-- DATABASE plantShop
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `plantShop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
GRANT ALL ON plantShop.* TO gardener@localhost IDENTIFIED BY 'plants4home';
USE plantShop;

DROP TABLE IF EXISTS `orderPosAddition`;
DROP TABLE IF EXISTS `orderPos`;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS `customerSettings`;
DROP TABLE IF EXISTS `customerAddress`;
DROP TABLE IF EXISTS `customer`;
DROP TABLE IF EXISTS `plant_accessory`;
DROP TABLE IF EXISTS `accessoryTx`;
DROP TABLE IF EXISTS `accessory`;
DROP TABLE IF EXISTS `plantTx`;
DROP TABLE IF EXISTS `plant`;
DROP TABLE IF EXISTS `plantTypeTx`;

-- -----------------------------------------------------
-- Table `plantShop`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`order` (
  `orderId` INT NOT NULL,
  `accountName` VARCHAR(50) NOT NULL,
  `streetName` VARCHAR(50) NOT NULL,
  `zipCode` INT NOT NULL,
  `location` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY fk_order_accountName (accountName))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`customer` (
  `accountName` VARCHAR(50) NOT NULL,
  `accountPassword` VARCHAR(50) NOT NULL,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `company` VARCHAR(50) NULL,
  PRIMARY KEY (`accountName`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`plant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`plant` (
  `plantId` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `pouringFrequency` INT NOT NULL,
  `sunlight` INT NOT NULL,
  `difficulty` INT NOT NULL,
  `plantTypeId` INT NOT NULL,
  PRIMARY KEY (`plantId`),
  KEY fk_plant_plantTypeId (plantTypeId))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`accessory` (
  `accessoryId` INT NOT NULL,
  `price` DECIMAL(10,2) NULL,
  PRIMARY KEY (`accessoryId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`plant_accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`plant_accessory` (
  `plantId` INT NOT NULL,
  `accessoryId` INT NOT NULL,
  PRIMARY KEY (`plantId`, `accessoryId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`plantTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`plantTx` (
  `plantId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `plantTitle` VARCHAR(50) NOT NULL,
  `plantDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`plantId`, `language`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`customerSettings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`customerSettings` (
  `accountName` VARCHAR(50) NOT NULL,
  `settingKey` VARCHAR(10) NOT NULL,
  `settingValue` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`accountName`, `settingKey`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`customerAddress`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`customerAddress` (
  `accountName` VARCHAR(50) NOT NULL,
  `streetName` VARCHAR(50) NOT NULL,
  `zipCode` INT NOT NULL,
  `location` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`accountName`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`orderPos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`orderPos` (
  `orderPosId` INT NOT NULL,
  `orderId` INT NOT NULL,
  `plantId` INT NOT NULL,
  `quantity` INT NOT NULL,
  `unitPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`orderPosId`),
  KEY fk_orderPos_orderId (orderId),
  KEY fk_orderPos_plantId (plantId))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`orderPosAddition`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`orderPosAddition` (
  `orderPosAdditionId` INT NOT NULL,
  `orderId` INT NOT NULL,
  `orderPosId` INT NULL,
  `accessoryId` INT NOT NULL,
  `quantity` INT NOT NULL,
  `unitPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`orderPosAdditionId`),
  KEY fk_orderPosAddition_orderId (orderId),
  KEY fk_orderPosAddition_orderPosId (orderPosId),
  KEY fk_orderPosAddition_accessoryId (accessoryId))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`plantTypeTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`plantTypeTx` (
  `plantTypeId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `plantTypeTitle` VARCHAR(50) NOT NULL,
  `plantTypeDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`plantTypeId`, `language`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plantShop`.`accessoryTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantShop`.`accessoryTx` (
  `accessoryId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `accessoryTitle` VARCHAR(50) NOT NULL,
  `accessoryDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`accessoryId`, `language`))
ENGINE = InnoDB;

ALTER TABLE customerSettings
ADD CONSTRAINT fk_customerSettings_accountName FOREIGN KEY (accountName) REFERENCES customer (accountName);

ALTER TABLE customerAddress
ADD CONSTRAINT fk_customerAddress_accountName FOREIGN KEY (accountName) REFERENCES customer (accountName);

ALTER TABLE plant
ADD CONSTRAINT fk_plant_plantTypeId FOREIGN KEY (plantTypeId) REFERENCES plantTypeTx (plantTypeId);

ALTER TABLE plantTx
ADD CONSTRAINT fk_plantTx_plantId FOREIGN KEY (plantId) REFERENCES plant (plantId);

ALTER TABLE accessoryTx
ADD CONSTRAINT fk_accessoryTx_accessoryId FOREIGN KEY (accessoryId) REFERENCES accessory (accessoryId);

ALTER TABLE plant_accessory
ADD CONSTRAINT fk_plant_accessory_plantId FOREIGN KEY (plantId) REFERENCES plant (plantId),
ADD CONSTRAINT fk_plant_accessory_accessoryId FOREIGN KEY (accessoryId) REFERENCES accessory (accessoryId);

ALTER TABLE `order`
ADD CONSTRAINT fk_order_accountName FOREIGN KEY (accountName) REFERENCES customer (accountName);

ALTER TABLE orderPos
ADD CONSTRAINT fk_orderPos_orderId FOREIGN KEY (orderId) REFERENCES `order` (orderId),
ADD CONSTRAINT fk_orderPos_plantId FOREIGN KEY (plantId) REFERENCES plant (plantId);

ALTER TABLE orderPosAddition
ADD CONSTRAINT fk_orderPosAddition_orderId FOREIGN KEY (orderId) REFERENCES `order` (orderId),
ADD CONSTRAINT fk_orderPosAddition_orderPosId FOREIGN KEY (orderPosId) REFERENCES orderPos (orderPosId),
ADD CONSTRAINT fk_orderPosAddition_accessoryId FOREIGN KEY (accessoryId) REFERENCES accessory (accessoryId);
