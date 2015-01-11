-- -----------------------------------------------------
-- DATABASE plantShop
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `plantShop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
GRANT ALL ON plantShop.* TO gardener@localhost IDENTIFIED BY 'plants4home';
USE plantShop;

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
  `city` VARCHAR(50) NOT NULL,
  `country` VARCHAR(50) NOT NULL,
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
  `plantId` INT NULL,
  `accessoryId` INT NULL,
  `quantity` INT NOT NULL,
  `unitPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`orderPosId`),
  KEY fk_orderPos_orderId (orderId),
  KEY fk_orderPos_plantId (plantId),
  KEY fk_orderPos_accessoryId (accessoryId))
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
ADD CONSTRAINT fk_orderPos_plantId FOREIGN KEY (plantId) REFERENCES plant (plantId),
ADD CONSTRAINT fk_orderPos_accessoryId FOREIGN KEY (accessoryId) REFERENCES accessory (accessoryId),
ADD CONSTRAINT ck_orderPos_product CHECK((plantId IS NULL AND accessoryId IS NOT NULL) OR (plantId IS NOT NULL AND accessoryId IS NULL));

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
  ("LOGIN_REQUIRED", "de", "Bitte melden Sie sich an um mit der Bestellung fortzufahren."),
  ("LOGIN_REQUIRED", "en", "Please login to continue with your order."),
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
  ("SHOPPING_CART_NAME", "en", "Shopping Cart"),
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
  ("USER_GENDER", "de", "Geschlecht"),
  ("USER_GENDER", "en", "Gender"),
  ("USER_MALE", "de", "Männlich"),
  ("USER_MALE", "en", "Male"),
  ("USER_FEMALE", "de", "Weiblich"),
  ("USER_FEMALE", "en", "Female"),
  ("USER_PERSONAL_INFO", "de", "Persönliche Informationen"),
  ("USER_PERSONAL_INFO", "en", "Personal Information"),
  ("USER_FIRSTNAME", "de", "Vorname"),
  ("USER_FIRSTNAME", "en", "Firstname"),
  ("USER_LASTNAME", "de", "Nachname"),
  ("USER_LASTNAME", "en", "Lastname"),
  ("USER_EMAIL", "de", "E-Mail"),
  ("USER_EMAIL", "en", "E-Mail"),
  ("USER_COMPANY", "de", "Firma"),
  ("USER_COMPANY", "en", "Company"),
  ("USER_SHIPPING_ADDRESS", "de", "Lieferadresse"),
  ("USER_SHIPPING_ADDRESS", "en", "Shipping Address"),
  ("USER_STREET", "de", "Strasse & Nummer"),
  ("USER_STREET", "en", "Street & Number"),
  ("USER_CITY", "de", "Stadt"),
  ("USER_CITY", "en", "City"),
  ("USER_PLZ", "de", "Postleitzahl"),
  ("USER_PLZ", "en", "Postal code"),
  ("USER_COUNTRY", "de", "Land"),
  ("USER_COUNTRY", "en", "Country"),
  ("SIGNUP", "de", "Registrieren"),
  ("SIGNUP", "en", "Sign up"),
  ("SIGNUP_TITLE", "de", "Erstelle dein Plants 4-Home Konto"),
  ("SIGNUP_TITLE", "en", "Create your Plants 4-Home Account"),
  ("SIGNUP_PASSWORD", "de", "Passwort erstellen"),
  ("SIGNUP_PASSWORD", "en", "Create a Password"),
  ("SIGNUP_PASSWORD_CONFIRM", "de", "Passwort bestätigen"),
  ("SIGNUP_PASSWORD_CONFIRM", "en", "Confirm your Password"),
  ("ORDER_CONTINUE", "de", "weiter"),
  ("ORDER_CONTINUE", "en", "continue"),
  ("ORDER_NOTLOGGEDIN", "de", "Bitte einloggen um bestellen zu können!"),
  ("ORDER_NOTLOGGEDIN", "en", "Please login to order!"),
  ("ORDER_SAVEADDRESS", "de", "Lieferadresse für nächste Bestellung speichern"),
  ("ORDER_SAVEADDRESS", "en", "save Shipping Address for next order"),
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
  ("ORDER_DETAILS_TITLE", "de", "Momentan in Ihrem Warenkorb:"),
  ("ORDER_DETAILS_TITLE", "en", "Currently in Your Shopping Cart:"),
  ("ORDER_DETAILS_TBL_TITLE", "de", "Titel"),
  ("ORDER_DETAILS_TBL_TITLE", "en", "Title"),
  ("ORDER_DETAILS_TBL_DESC", "de", "Beschreibung"),
  ("ORDER_DETAILS_TBL_DESC", "en", "Description"),
  ("ORDER_DETAILS_TBL_PRICE", "de", "Preis"),
  ("ORDER_DETAILS_TBL_PRICE", "en", "Price"),
  ("ORDER_DETAILS_TBL_QUAN", "de", "Anzahl"),
  ("ORDER_DETAILS_TBL_QUAN", "en", "Quantity"),
  ("ORDER_DETAILS_TBL_TOT", "de", "Total"),
  ("ORDER_DETAILS_TBL_TOT", "en", "Total"),
  ("ORDER_SAVED", "de", "Vielen Dank für Ihre Bestellung! Wir haben Ihnen eine Bestellbestätigung an Ihre Emailaddresse gesendet."),
  ("ORDER_SAVED", "en", "Thank you for your order! We have sent you an order confirmation to your email address."),
  ("SEARCH_NORESULT", "de", "keine Ergebnisse gefunden"),
  ("SEARCH_NORESULT", "en", "no results found"),
  ("PLANTWIZARD", "de", "Welche Pflanze passt zu mir?"),
  ("PLANTWIZARD", "en", "What plant suits me?"),
  ("PLANTWIZARD_DESC", "de", "Beantworten Sie die folgenden Fragen, damit wir Sie bei der Suche nach der passenden Pflanze unterstützen können."),
  ("PLANTWIZARD_DESC", "en", "Answer the following questions, so we can support your search for a suitable plant."),
  ("QUESTION_1", "de", "Wie hell ist der Raum, in dem Sie die Pflanze aufstellen möchten?"),
  ("ANSWER_1_1", "de", "Der Raum ist sehr hell und verfügt über mehrere Fenster"),
  ("ANSWER_1_2", "de", "Der Raum verfügt über mehr als ein Fenster"),
  ("ANSWER_1_3", "de", "Der Raum ist eher dunkel und verfügt nur über ein Fenster"),
  ("QUESTION_2", "de", "Wie oft sind Sie Zuhause?"),
  ("ANSWER_2_1", "de", "Ich bin teilweise mehrere Wochen ausser Haus"),
  ("ANSWER_2_2", "de", "Bis auf gelegentliche Kurzaufenthalte und Ferien bin ich oft Zuhause"),
  ("ANSWER_2_3", "de", "Bis auf Ferien bin ich regelmässig Zuhause"),
  ("QUESTION_3", "de", "Wie gut kennen Sie sich aus mit der Pflege von Pflanzen?"),
  ("ANSWER_3_1", "de", "Eher wenig - leider gehen mir meine Pflanzen regelmässig ein"),
  ("ANSWER_3_2", "de", "Durchschnittlich - ich kenne mich ein wenig aus"),
  ("ANSWER_3_3", "de", "Grüner Daumen: Meine Orchideen blühen fast das ganze Jahr"),
  ("QUESTION_1", "en", "Wie hell ist der Raum, in dem Sie die Pflanze aufstellen möchten?"),
  ("ANSWER_1_1", "en", "Der Raum ist sehr hell und verfügt über mehrere Fenster"),
  ("ANSWER_1_2", "en", "Der Raum verfügt über mehr als ein Fenster"),
  ("ANSWER_1_3", "en", "Der Raum ist eher dunkel und verfügt nur über ein Fenster"),
  ("QUESTION_2", "en", "Wie oft sind Sie Zuhause?"),
  ("ANSWER_2_1", "en", "Ich bin teilweise mehrere Wochen ausser Haus"),
  ("ANSWER_2_2", "en", "Bis auf gelegentliche Kurzaufenthalte und Ferien bin ich oft Zuhause"),
  ("ANSWER_2_3", "en", "Bis auf Ferien bin ich regelmässig Zuhause"),
  ("QUESTION_3", "en", "Wie gut kennen Sie sich aus mit der Pflege von Pflanzen?"),
  ("ANSWER_3_1", "en", "Eher wenig - leider gehen mir meine Pflanzen regelmässig ein"),
  ("ANSWER_3_2", "en", "Durchschnittlich - ich kenne mich ein wenig aus"),
  ("ANSWER_3_3", "en", "Grüner Daumen: Meine Orchideen blühen fast das ganze Jahr");

-- -----------------------------------------------------
-- customer
-- -----------------------------------------------------
INSERT INTO customer
  (accountName, accountPassword, firstName, lastName, gender, company)
VALUES
  ('peter.mueller@p3n.ch', 'pm', 'Peter', 'Müller', 'm', NULL),
  ('grant.plant@p3n.ch', 'gp', 'Grant', 'Plant', 'm', NULL);
-- -----------------------------------------------------
-- customerAddress
-- -----------------------------------------------------
INSERT INTO customerAddress
  (accountName, streetName, zipCode, city, country)
VALUES
  ('peter.mueller@p3n.ch', 'Poststrasse 3', 3000, 'Bern', 'Switzerland'),
  ('grant.plant@p3n.ch', 'Gartenstrasse 33', 3001, 'Bern', 'Switzerland');
-- -----------------------------------------------------
-- customer
-- -----------------------------------------------------
INSERT INTO admin
  (accountName, accountPassword)
VALUES
  ('admin@p3n.ch', 'admin');
-- -----------------------------------------------------
-- plantTypeTx
-- -----------------------------------------------------
INSERT INTO plantTypeTx
  (plantTypeId, language, plantTypeTitle, plantTypeDescription)
VALUES
  (1, 'de', 'Wohnzimmer', 'Pflanzen für das Wohnzimmer'),
  (1, 'en', 'Living Room', 'plants for the living room'),
  (2, 'de', 'Badezimmer', 'Pflanzen für das Badezimmer.'),
  (2, 'en', 'Bathroom', 'plants for the bathroom'),
  (3, 'de', 'Schlafzimmer', 'Pflanzen für das Schlafzimmer.'),
  (3, 'en', 'Bedroom', 'plants for the bedroom'),
  (4, 'de', 'Garten', 'Pflanzen für den Garten.'),
  (4, 'en', 'Garden', 'plants for the garden'),
  (5, 'de', 'Treppenhaus', 'Pflanzen für das Treppenhaus.'),
  (5, 'en', 'Stairwell', 'plants for the stairwell');
-- -----------------------------------------------------
-- plant
-- -----------------------------------------------------
INSERT INTO plant
  (price, pouringFrequency, sunlight, difficulty, pictureName, plantTypeId)
VALUES
  (10.5, 3, 3, 2, 'plant1.jpg', 1),
  (50.0, 2, 4, 3, 'plant2.jpg', 1),
  (30.6, 3, 2, 2, 'plant3.jpg', 2),
  (40.8, 1, 2, 3, 'plant4.jpg', 2),
  (50.95, 4, 3, 2, 'plant5.jpg', 3),
  (60.0, 5, 4, 3, 'plant6.jpg', 4),
  (20.6, 2, 2, 1, 'plant7.jpg', 5),
  (90.5, 3, 3, 4, 'plant8.jpg', 3),
  (89.4, 3, 3, 2, 'plant9.jpg', 1);
-- -----------------------------------------------------
-- plantTx
-- -----------------------------------------------------
INSERT INTO plantTx
(plantId, language, plantTitle, plantDescription)
VALUES
  (1, 'de', 'pflanze 1', 'pflanze1 beschreibung'),
  (1, 'en', 'plant 1', 'plant1 description'),
  (2, 'de', 'pflanze 2', 'pflanze2 beschreibung'),
  (2, 'en', 'plant 2', 'plant2 description'),
  (3, 'de', 'pflanze 3', 'pflanze3 beschreibung'),
  (3, 'en', 'plant 3', 'plant3 description'),
  (4, 'de', 'pflanze 4', 'pflanze4 beschreibung'),
  (4, 'en', 'plant 4', 'plant4 description'),
  (5, 'de', 'pflanze 5', 'pflanze5 beschreibung'),
  (5, 'en', 'plant 5', 'plant5 description'),
  (6, 'de', 'pflanze 6', 'pflanze6 beschreibung'),
  (6, 'en', 'plant 6', 'plant6 description'),
  (7, 'de', 'pflanze 7', 'pflanze7 beschreibung'),
  (7, 'en', 'plant 7', 'plant7 description'),
  (8, 'de', 'pflanze 8', 'pflanze8 beschreibung'),
  (8, 'en', 'plant 8', 'plant8 description'),
  (9, 'de', 'pflanze 9', 'pflanze9 beschreibung'),
  (9, 'en', 'plant 9', 'plant9 description');
  
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
(2, 3),
(3, 2),
(3, 3),
(4, 2),
(5, 1),
(5, 2),
(5, 3),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 3);
