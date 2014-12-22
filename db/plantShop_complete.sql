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
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `plant_accessory`;
DROP TABLE IF EXISTS `accessoryTx`;
DROP TABLE IF EXISTS `accessory`;
DROP TABLE IF EXISTS `plantTx`;
DROP TABLE IF EXISTS `plant`;
DROP TABLE IF EXISTS `plantTypeTx`;
DROP TABLE IF EXISTS `messages`;

-- -----------------------------------------------------
-- Table `order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `order` (
  `orderId` INT NOT NULL AUTO_INCREMENT,
  `status` INT NOT NULL DEFAULT 1,
  `accountName` VARCHAR(50) NOT NULL,
  `streetName` VARCHAR(50) NOT NULL,
  `zipCode` INT NOT NULL,
  `location` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY fk_order_accountName (accountName))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customer` (
  `accountName` VARCHAR(50) NOT NULL,
  `accountPassword` VARCHAR(50) NOT NULL,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `company` VARCHAR(50) NULL,
  PRIMARY KEY (`accountName`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `accountName` VARCHAR(50) NOT NULL,
  `accountPassword` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`accountName`))
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `plant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plant` (
  `plantId` INT NOT NULL AUTO_INCREMENT,
  `price` DECIMAL(10,2) NOT NULL,
  `pouringFrequency` INT NOT NULL,
  `sunlight` INT NOT NULL,
  `difficulty` INT NOT NULL,
  `pictureName` VARCHAR(20) NOT NULL,
  `plantTypeId` INT NOT NULL,
  PRIMARY KEY (`plantId`),
  KEY fk_plant_plantTypeId (plantTypeId))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accessory` (
  `accessoryId` INT NOT NULL AUTO_INCREMENT,
  `price` DECIMAL(10,2) NULL,
  `pictureName` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`accessoryId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `plant_accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plant_accessory` (
  `plantId` INT NOT NULL,
  `accessoryId` INT NOT NULL,
  PRIMARY KEY (`plantId`, `accessoryId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `plantTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantTx` (
  `plantId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `plantTitle` VARCHAR(50) NOT NULL,
  `plantDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`plantId`, `language`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `customerSettings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customerSettings` (
  `accountName` VARCHAR(50) NOT NULL,
  `settingKey` VARCHAR(10) NOT NULL,
  `settingValue` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`accountName`, `settingKey`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `customerAddress`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `customerAddress` (
  `accountName` VARCHAR(50) NOT NULL,
  `streetName` VARCHAR(50) NOT NULL,
  `zipCode` INT NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `country` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`accountName`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `orderPos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `orderPos` (
  `orderPosId` INT NOT NULL AUTO_INCREMENT,
  `orderId` INT NOT NULL,
  `plantId` INT NOT NULL,
  `quantity` INT NOT NULL,
  `unitPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`orderPosId`),
  KEY fk_orderPos_orderId (orderId),
  KEY fk_orderPos_plantId (plantId))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `orderPosAddition`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `orderPosAddition` (
  `orderPosAdditionId` INT NOT NULL AUTO_INCREMENT,
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
-- Table `plantTypeTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `plantTypeTx` (
  `plantTypeId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `plantTypeTitle` VARCHAR(50) NOT NULL,
  `plantTypeDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`plantTypeId`, `language`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accessoryTx`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accessoryTx` (
  `accessoryId` INT NOT NULL,
  `language` CHAR(2) NOT NULL,
  `accessoryTitle` VARCHAR(50) NOT NULL,
  `accessoryDescription` VARCHAR(250) NULL,
  PRIMARY KEY (`accessoryId`, `language`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `messageKey` VARCHAR(30) NOT NULL,
  `language` CHAR(2) NOT NULL,
  `message` TEXT NOT NULL,
  PRIMARY KEY (`messageKey`, `language`))
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

-- -----------------------------------------------------
-- insert data
-- -----------------------------------------------------

-- -----------------------------------------------------
-- messages
-- -----------------------------------------------------
INSERT INTO messages (messageKey, language, message) VALUES
  ("OUR_PROMISE", "de", "Pflanzen für ihr Zuhause - geliefert zu Ihnen nach Hause"),
  ("OUR_PROMISE", "en", "Plants for your home - delivered to your home"),
  ("LOGIN_HELLO", "de", "Willkommen"),
  ("LOGIN_HELLO", "en", "Welcome"),
  ("LOGIN_FORM_USERNAME", "de", "Benutzername"),
  ("LOGIN_FORM_USERNAME", "en", "Username"),
  ("LOGIN_FORM_PASSWORD", "de", "Passwort"),
  ("LOGIN_FORM_PASSWORD", "en", "Password"),
  ("LOGIN_FORM_LOGIN", "de", "Einloggen"),
  ("LOGIN_FORM_LOGIN", "en", "Login"),
  ("LOGIN_ERROR_HINT", "de", "Fehler"),
  ("LOGIN_ERROR_HINT", "en", "Error"),
  ("LOGIN_ERROR_TEXT", "de", "Ungültiger Benutzername und/oder Password!"),
  ("LOGIN_ERROR_TEXT", "en", "Invalid credentials!"),
  ("NAVIGATION_HOME", "de", "Startseite"),
  ("NAVIGATION_HOME", "en", "Home"),
  ("NAVIGATION_ROOM_LIVING", "de", "Wohnzimmer"),
  ("NAVIGATION_ROOM_LIVING", "en", "Living Room"),
  ("NAVIGATION_ROOM_BATH", "de", "Badezimmer"),
  ("NAVIGATION_ROOM_BATH", "en", "Bathroom"),
  ("NAVIGATION_ROOM_BED", "de", "Schlafzimmer"),
  ("NAVIGATION_ROOM_BED", "en", "Bedroom"),
  ("NAVIGATION_GARDEN", "de", "Garten"),
  ("NAVIGATION_GARDEN", "en", "Garden"),
  ("NAVIGATION_STAIRWELL", "de", "Treppe"),
  ("NAVIGATION_STAIRWELL", "en", "Stairwell"),
  ("NAVIGATION_POTS", "de", "Topf"),
  ("NAVIGATION_POTS", "en", "Pots"),
  ("NAVIGATION_FERTILIZERS", "de", "Dünger"),
  ("NAVIGATION_FERTILIZERS", "en", "Fertilizers"),
  ("NAVIGATION_ACCESSORIES", "de", "Zubehör"),
  ("NAVIGATION_ACCESSORIES", "en", "Accessories"),
  ("SHOPPING_CART_NAME", "de", "Warenkorb"),
  ("SHOPPING_CART_NAME", "en", "Shopping-Cart"),
  ("SHOPPING_CART_NO_ITEMS", "de", "Worenkorb ist leer"),
  ("SHOPPING_CART_NO_ITEMS", "en", "No items"),
  ("SHOPPING_CART_ORDER", "de", "Jetzt bestellen"),
  ("SHOPPING_CART_ORDER", "en", "Order now"),
  ("PRODUCT_SHOW_DETAILS", "de", "Details anzeigen"),
  ("PRODUCT_SHOW_DETAILS", "en", "Show details"),
  ("DETAILS_ACCESSORY", "de", "Zubehör"),
  ("DETAILS_ACCESSORY", "en", "Accessories"),
  ("DETAILS_ADD_TO_CART", "de", "in den Warenkorb"),
  ("DETAILS_ADD_TO_CART", "en", "Add to cart"),
  ("ORDER_NOTLOGGEDIN", "de", "Bitte einloggen um bestellen zu können!"),
  ("ORDER_NOTLOGGEDIN", "en", "Please login to order!"),
  ("ORDER_PERSONAL_INFO", "de", "Bitte persönliche Informationen eingeben"),
  ("ORDER_PERSONAL_INFO", "en", "Enter your personal information"),
  ("ORDER_FIRSTNAME", "de", "Vorname"),
  ("ORDER_FIRSTNAME", "en", "Firstname"),
  ("ORDER_LASTNAME", "de", "Nachname"),
  ("ORDER_LASTNAME", "en", "Lastname"),
  ("ORDER_EMAIL", "de", "E-Mail"),
  ("ORDER_EMAIL", "en", "E-Mail"),
  ("ORDER_SHIPPING_ADDRESS", "de", "Lieferadresse"),
  ("ORDER_SHIPPING_ADDRESS", "en", "Shipping Address"),
  ("ORDER_STREET", "de", "Strasse & Nummer"),
  ("ORDER_STREET", "en", "Street & Number"),
  ("ORDER_CITY", "de", "Stadt"),
  ("ORDER_CITY", "en", "City"),
  ("ORDER_PLZ", "de", "Postleitzahl"),
  ("ORDER_PLZ", "en", "Postal code"),
  ("ORDER_COUNTRY", "de", "Land"),
  ("ORDER_COUNTRY", "en", "Country"),
  ("ORDER_COMMENT", "de", "Kommentar"),
  ("ORDER_COMMENT", "en", "Comment"),
  ("ORDER_CONFIRM", "de", "Bestellung betätigen"),
  ("ORDER_CONFIRM", "en", "Confirm order"),
  ("ORDER_SHIPPING", "de", "Lieferung"),
  ("ORDER_SHIPPING", "en", "Shipping"),
  ("ORDER_DELIVERY_EXPRESS", "de", "Express-Lieferung"),
  ("ORDER_DELIVERY_EXPRESS", "en", "Express delivery"),
  ("ORDER_DELIVERY_NORMAL", "de", "Standard Lieferung"),
  ("ORDER_DELIVERY_NORMAL", "en", "Standard delivery"),
  ("ORDER_SAVED", "de", "Vielen Dank, wir haben ihre Bestellung erhalten!"),
  ("ORDER_SAVED", "en", "DE: We received your order. Thank you very much!");
-- -----------------------------------------------------
-- customer
-- -----------------------------------------------------
INSERT INTO customer
  (accountName, accountPassword, firstName, lastName, gender, company)
VALUES
  ('peter.mueller@fakemail.com', 'pm', 'Peter', 'Müller', 'm', NULL),
  ('grant.plant@fakemail.com', 'gp', 'Grant', 'Plant', 'm', NULL);
-- -----------------------------------------------------
-- customerAddress
-- -----------------------------------------------------
INSERT INTO customerAddress
  (accountName, streetName, zipCode, city, country)
VALUES
  ('peter.mueller@fakemail.com', 'Poststrasse 3', 3000, 'Bern', 'Switzerland'),
  ('grant.plant@fakemail.com', 'Gartenstrasse 33', 3001, 'Bern', 'Switzerland');
-- -----------------------------------------------------
-- customer
-- -----------------------------------------------------
INSERT INTO admin
  (accountName, accountPassword)
VALUES
  ('admin@fakemail.com', 'admin');
-- -----------------------------------------------------
-- plantTypeTx
-- -----------------------------------------------------
INSERT INTO plantTypeTx
  (plantTypeId, language, plantTypeTitle, plantTypeDescription)
VALUES
  (1, 'de', 'Wohnzimmer', 'Zimmerpflanze blabla'),
  (1, 'en', 'living room', 'plants blabla');
-- -----------------------------------------------------
-- plant
-- -----------------------------------------------------
INSERT INTO plant
  (price, pouringFrequency, sunlight, difficulty, pictureName, plantTypeId)
VALUES
  (10.5, 3, 3, 2, 'plant1.jpg', 1),
  (50.5, 2, 4, 3, 'plant2.jpg', 1);
-- -----------------------------------------------------
-- plantTx
-- -----------------------------------------------------
INSERT INTO plantTx
(plantId, language, plantTitle, plantDescription)
VALUES
  (1, 'de', 'pflanze 1', 'pflanze1 beschreibung'),
  (1, 'en', 'plant 1', 'plant1 description'),
  (2, 'de', 'pflanze 2', 'pflanze2 beschreibung'),
  (2, 'en', 'plant 2', 'plant2 description');
  
-- -----------------------------------------------------
-- accessory
-- -----------------------------------------------------
INSERT INTO accessory
(price, pictureName)
VALUES
 (25.30, 'accessory1.jpg'),
 (33.30, 'accessory2.jpg'),
 (13.30, 'accessory3.jpg');

-- -----------------------------------------------------
-- accessoryTx
-- -----------------------------------------------------
INSERT INTO accessoryTx
(accessoryId, language, accessoryTitle, accessoryDescription)
VALUES
  (1, 'de', 'Zubehör 1', 'Zubehör 1 Beschreibung'),
  (1, 'en', 'accessory 1', 'accessory 1 description'),
  (2, 'de', 'Zubehör 2', 'Zubehör 1 Beschreibung'),
  (2, 'en', 'accessory 2', 'accessory 2 description'),
  (3, 'de', 'Zubehör 3', 'Zubehör 3 Beschreibung'),
  (3, 'en', 'accessory 3', 'accessory 3 description');
  
-- -----------------------------------------------------
-- plant_accessory
-- -----------------------------------------------------
INSERT INTO plant_accessory
(plantId, accessoryId)
VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3);
