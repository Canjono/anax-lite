-- ------------------------------------------------------------------------
--
-- CREATE DATABASE oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
USE mihe16;
SET NAMES utf8;



-- ------------------------------------------------------------------------
--
-- Setup tables
--

DROP TABLE IF EXISTS `webshop_prod2cat`;
DROP TABLE IF EXISTS `webshop_prodCategory`;
DROP TABLE IF EXISTS `webshop_prod2img`;
DROP TABLE IF EXISTS `webshop_image`;
DROP TABLE IF EXISTS `webshop_orderMore`;
DROP TABLE IF EXISTS `webshop_inventory`;
DROP TABLE IF EXISTS `webshop_invenShelf`;
DROP TABLE IF EXISTS `webshop_cartRow`;
DROP TABLE IF EXISTS `webshop_cart`;
DROP TABLE IF EXISTS `webshop_orderRow`;
DROP TABLE IF EXISTS `webshop_invoiceRow`;
DROP TABLE IF EXISTS `webshop_invoice`;
DROP TABLE IF EXISTS `webshop_order`;
DROP TABLE IF EXISTS `webshop_product`;
DROP TABLE IF EXISTS `webshop_customer`;



-- ------------------------------------------------------------------------
--
-- Product and product category
--
CREATE TABLE `webshop_prodCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `webshop_product` (
	`id` INT AUTO_INCREMENT,
    `name` VARCHAR(120),
    `description` TEXT,
    `price` DECIMAL(7, 2),
    `platform` VARCHAR(20),

	PRIMARY KEY (`id`)
);

CREATE TABLE `webshop_prod2cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `webshop_product` (`id`), 
    FOREIGN KEY (`cat_id`) REFERENCES `webshop_prodCategory` (`id`) 
);

CREATE TABLE `webshop_image` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(120),

    PRIMARY KEY (`id`)
);

CREATE TABLE `webshop_prod2img` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `img_id` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `webshop_product` (`id`),
    FOREIGN KEY (`img_id`) REFERENCES `webshop_image` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Inventory and shelfs
--
CREATE TABLE `webshop_invenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);

CREATE TABLE `webshop_inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_name` CHAR(6),
    `amount` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `webshop_product` (`id`),
	FOREIGN KEY (`shelf_name`) REFERENCES `webshop_invenShelf` (`shelf`)
);




-- ------------------------------------------------------------------------
--
-- Customer
--
CREATE TABLE `webshop_customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);


-- ------------------------------------------------------------------------
--
-- Shopping cart
--
CREATE TABLE `webshop_cart` (
	`id` INT AUTO_INCREMENT,
    `customer_id` INT,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `webshop_customer` (`id`)
);

CREATE TABLE `webshop_cartRow` (
	`id` INT AUTO_INCREMENT,
    `cart_id` INT,
    `prod_id` INT,
    `amount` INT,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`cart_id`) REFERENCES `webshop_cart` (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `webshop_product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `webshop_order` (
	`id` INT AUTO_INCREMENT,
    `customer_id` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME DEFAULT NULL,
	`deleted` DATETIME DEFAULT NULL,
	`delivery` DATETIME DEFAULT NULL,
    
	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer_id`) REFERENCES `webshop_customer` (`id`)
);

CREATE TABLE `webshop_orderRow` (
	`id` INT AUTO_INCREMENT,
    `order_id` INT,
    `product_id` INT,
	`amount` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order_id`) REFERENCES `webshop_order` (`id`),
	FOREIGN KEY (`product_id`) REFERENCES `webshop_product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Invoice
--
CREATE TABLE `webshop_invoice` (
	`id` INT AUTO_INCREMENT,
    `order_id` INT,
    `customer_id` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
	PRIMARY KEY (`id`),
	FOREIGN KEY (`order_id`) REFERENCES `webshop_order` (`id`),
	FOREIGN KEY (`customer_id`) REFERENCES `webshop_customer` (`id`)
);

CREATE TABLE `webshop_invoiceRow` (
	`id` INT AUTO_INCREMENT,
    `invoice_id` INT,
    `product_id` INT,
	`amount` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`invoice_id`) REFERENCES `webshop_invoice` (`id`),
	FOREIGN KEY (`product_id`) REFERENCES `webshop_product` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Order more
--
CREATE TABLE `webshop_orderMore`
(
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `webshop_product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- By some stuff to get it up and running,
-- the first truck has arrived and you need to
-- insert the details into you database.
--

-- ------------------------------------------------------------------------
INSERT INTO webshop_prodCategory (category)
VALUES
    ("Action"),
    ("Adventure"),
    ("Racing")
;

INSERT INTO webshop_product (name, price, platform)
VALUES
    ("Uncharted 4", 300, "Playstation 4"),
    ("Zelda: Breath of the Wild", 500, "Nintendo Switch"),
    ("Gears of War 4", 400, "Xbox One"),
    ("Call of Duty: Infinite Warfare", 600, "Xbox One"),
    ("Metal Gear Solid 5: Phantom Pain", 400, "Playstation 4"),
    ("Mario Kart 8", 400, "Nintendo Switch")
;

INSERT INTO webshop_prod2cat (prod_id, cat_id)
VALUES
    (1, 2),
    (2, 2),
    (3, 1),
    (4, 1),
    (5, 1),
    (6, 3)
;

SELECT
    P.id,
    P.name,
    GROUP_CONCAT(category) AS category
FROM webshop_product AS P
    INNER JOIN webshop_prod2cat AS P2C
        ON P.id = P2C.prod_id
    INNER JOIN webshop_prodCategory AS PC
        ON PC.id = P2C.cat_id
GROUP BY P.id
ORDER BY P.name
;

INSERT INTO webshop_image (name)
VALUES
    ("uncharted.jpg"),
    ("zelda.jpg"),
    ("gears_of_war.jpg"),
    ("cod.jpg"),
    ("metal_gear.jpg"),
    ("mario_kart.jpeg")
;

INSERT INTO webshop_prod2img (prod_id, img_id)
VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6)
;

INSERT INTO webshop_customer (firstName, lastName)
VALUES
	("Johan", "Andersson"),
    ("Fredrik", "Åkare"),
    ("Cecilia", "Lind")
;

INSERT INTO webshop_cart (customer_id)
VALUES
	(1),
    (2),
    (3)
;

-- ------------------------------------------------------------------------
--
-- The truck has arrived, put the stuff into shelfs and update the database
--
INSERT INTO webshop_invenShelf (shelf, description)
VALUES
    ("AAA101", "House A, aisle A, part A, shelf 101"),
    ("AAA102", "House A, aisle A, part A, shelf 102")
;

INSERT INTO webshop_inventory (prod_id, shelf_name, amount)
VALUES
    (1, "AAA101", 100),
    (2, "AAA102", 100),
    (3, "AAA101", 100),
    (4, "AAA102", 100),
    (5, "AAA101", 100),
    (6, "AAA102", 100)
;

-- SELECT * FROM webshop_invenShelf;

--
-- View webshop_Vinventory
--
DROP VIEW IF EXISTS webshop_Vinventory;
CREATE VIEW webshop_Vinventory AS
SELECT
    S.shelf,
    S.description AS location,
    I.amount,
    P.name,
    P.id
FROM webshop_inventory AS I
    LEFT OUTER JOIN webshop_invenShelf AS S
        ON I.shelf_name = S.shelf
    LEFT OUTER JOIN webshop_product AS P
        ON I.prod_id = P.id
ORDER BY P.name
;

SELECT * FROM webshop_Vinventory;

--
-- View webshop_Vproduct
--
DROP VIEW IF EXISTS webshop_Vproduct;
CREATE VIEW webshop_Vproduct AS
SELECT
    P.id,
    P.name,
    P.description,
    P.price,
    P.platform,
    GROUP_CONCAT(Img.name) AS image,
    S.shelf,
    S.description AS location,
    Inv.amount,
    GROUP_CONCAT(category) AS category
    
FROM webshop_product AS P
    LEFT OUTER JOIN webshop_prod2img AS P2I
        ON P.id = P2I.prod_id
	LEFT OUTER JOIN webshop_image AS Img
		ON P2I.img_id = Img.id
	LEFT OUTER JOIN webshop_inventory AS Inv
		ON P.id = Inv.prod_id
	LEFT OUTER JOIN webshop_invenShelf AS S
		ON Inv.shelf_name = S.shelf
	LEFT OUTER JOIN webshop_prod2cat AS P2C
		ON P.id = P2C.prod_id
	LEFT OUTER JOIN webshop_prodCategory AS C
		ON P2C.cat_id = C.id
GROUP BY P.id
ORDER BY P.name
;

SELECT * FROM webshop_Vproduct;
SELECT * FROM webshop_product;
SELECT * FROM webshop_image;
SELECT * FROM webshop_prod2img;

--
-- Procedure updateProd
--
DROP PROCEDURE IF EXISTS updateProd;

DELIMITER //

CREATE PROCEDURE updateProd(
    the_id INT,
    prod_name VARCHAR(120),
    prod_description TEXT,
    prod_price INT,
    prod_platform VARCHAR(20),
    prod_img VARCHAR(120),
    prod_shelf VARCHAR(120),
    prod_amount INT,
    prod_category VARCHAR(120)
)
BEGIN
    START TRANSACTION;

    UPDATE webshop_product
    SET
        name = prod_name,
        description = prod_description,
        price = prod_price,
        platform = prod_platform
    WHERE
        id = the_id;

    UPDATE webshop_inventory
    SET
        shelf_name = prod_shelf,
        amount = prod_amount
    WHERE
        prod_id = the_id;

    UPDATE webshop_prod2cat
    SET
        cat_id = (SELECT id FROM webshop_prodCategory WHERE category = prod_category)
    WHERE
        prod_id = the_id;

    UPDATE webshop_prod2img
    SET
        img_id = (SELECT id FROM webshop_image WHERE name = prod_img)
    WHERE
        prod_id = the_id;

    COMMIT;
END
//

DELIMITER ;

SELECT * FROM webshop_Vproduct;

--
-- Procedure addProd
--
DROP PROCEDURE IF EXISTS addProd;

DELIMITER //

CREATE PROCEDURE addProd(
    prod_name VARCHAR(120),
    prod_amount INT,
    prod_shelf CHAR(6)
)
BEGIN
    START TRANSACTION;
	INSERT INTO webshop_product (name)
	VALUES
		(prod_name)
	;
	
    INSERT INTO webshop_inventory (prod_id, amount, shelf_name)
    VALUES (
		(SELECT MAX(id) FROM webshop_product),
        prod_amount,
        prod_shelf
    );

	SELECT MAX(id) AS id FROM webshop_product;
    COMMIT;
END
//

DELIMITER ;

--
-- Procedure addProd
--
DROP PROCEDURE IF EXISTS deleteProd;

DELIMITER //

CREATE PROCEDURE deleteProd(
    prodId INT
)
BEGIN
    START TRANSACTION;

	DELETE FROM webshop_prod2cat
	WHERE
		prod_id = prodId;
	
    DELETE FROM webshop_prod2img
    WHERE
		prod_id = prodId;

	DELETE FROM webshop_inventory
    WHERE
		prod_id = prodId;

	DELETE FROM webshop_product
    WHERE
		id = prodId;

	

    COMMIT;
END
//

DELIMITER ;

SELECT * FROM webshop_Vproduct;
SELECT * FROM webshop_product;


--
-- View webshop_Vcart
--
DROP VIEW IF EXISTS webshop_Vcart;
CREATE VIEW webshop_Vcart AS
SELECT
    C.cart_id AS Cart,
    C.id AS CartRow,
    P.name AS Product,
    C.amount AS Amount,
    (P.price * C.amount) AS Price
FROM webshop_cartRow AS C
    LEFT OUTER JOIN webshop_product AS P
        ON C.prod_id = P.id
ORDER BY Cart
;

--
-- Procedure addToCart
--
DROP PROCEDURE IF EXISTS addToCart;

DELIMITER //

CREATE PROCEDURE addToCart(
    cust_id INT,
    prodId INT,
    add_amount INT
)
BEGIN
	DECLARE inStock INT;
    START TRANSACTION;
    
	SET inStock = (SELECT amount FROM webshop_inventory WHERE prod_id = prodId);

	IF add_amount > inStock THEN
		ROLLBACK;
        SELECT "Not enough in stock to add that many items";

	ELSE
    
		INSERT INTO webshop_cartRow (cart_id, prod_id, amount)
		VALUES (
			(SELECT id FROM webshop_cart WHERE customer_id = cust_id),
			prodId,
			add_amount
		)
		;

		COMMIT;
	END IF;
END
//

DELIMITER ;

SELECT * FROM webshop_Vcart;

SELECT * FROM webshop_product;

--
-- Procedure removeFromCart
--
DROP PROCEDURE IF EXISTS removeFromCart;

DELIMITER //

CREATE PROCEDURE removeFromCart(
    cartRow_id INT,
    rm_amount INT
)
BEGIN
	DECLARE cart_amount INT;
    START TRANSACTION;
	
    SET cart_amount = (SELECT amount FROM webshop_cartRow WHERE id = cartRow_id);
    IF rm_amount >= cart_amount THEN
		DELETE FROM webshop_cartRow
		WHERE 
			id = cartRow_id
		;
	ELSE
		UPDATE webshop_cartRow
        SET
			amount = amount - rm_amount
		WHERE
			id = cartRow_id
		;
	
    END IF;

    COMMIT;
END
//

DELIMITER ;

SELECT * FROM webshop_Vcart;

--
-- Function for checking if there's enough items in stock
--
DELIMITER //

DROP FUNCTION IF EXISTS enoughInStock //
CREATE FUNCTION enoughInStock(
    product_id INT,
    takeAmount INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE inStockBefore INT;
    DECLARE inStockAfter INT;
    SET inStockBefore = (SELECT amount FROM webshop_inventory WHERE prod_id = product_id);
    SET inStockAfter = inStockBefore - takeAmount;
    IF inStockAfter < 0 THEN
        RETURN false;
    END IF;
    RETURN true;
END
//

DELIMITER ;

--
-- Function for checking if customer has any items in cart
--
DELIMITER //

DROP FUNCTION IF EXISTS hasItemsInCart //
CREATE FUNCTION hasItemsInCart(
    cartId INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE items INT;
    SET items = (SELECT COUNT(*) FROM webshop_cartRow WHERE cart_id = cartId);
    IF items > 0 THEN
        RETURN true;
    END IF;
    RETURN false;
END
//

DELIMITER ;

--
-- Function for checking if customer has any items in cart
--
DELIMITER //

DROP FUNCTION IF EXISTS hasItemsInOrder //
CREATE FUNCTION hasItemsInOrder(
    orderId INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE items INT;
    SET items = (SELECT COUNT(*) FROM webshop_orderRow WHERE order_id = orderId);
    IF items > 0 THEN
        RETURN true;
    END IF;
    RETURN false;
END
//

DELIMITER ;

--
-- Procedure createOrder
--
DROP PROCEDURE IF EXISTS createOrder;

DELIMITER //

CREATE PROCEDURE createOrder(
    cartId INT
)
BEGIN
    DECLARE orderId INT;
    START TRANSACTION;

    INSERT INTO webshop_order (customer_id)
    VALUES (
        (SELECT customer_id FROM webshop_cart WHERE id = cartId)
    );

    SET orderId = (SELECT MAX(id) FROM webshop_order);

    WHILE hasItemsInCart(cartId) DO
        SELECT id, prod_id, amount INTO @cartRowId, @product_id, @product_amount
            FROM webshop_cartRow WHERE cart_id = cartId LIMIT 1;

        INSERT INTO webshop_orderRow (order_id, product_id, amount)
        VALUES (
            orderId,
            @product_id,
            @product_amount
        );

        DELETE FROM webshop_cartRow WHERE id = @cartRowId;
        UPDATE webshop_inventory
		SET
			amount = amount - @product_amount
		WHERE 
			prod_id = @product_id;
        
    END WHILE;
    COMMIT;
END
//

DELIMITER ;

--
-- Procedure createOrder
--
DROP PROCEDURE IF EXISTS removeOrder;

DELIMITER //

CREATE PROCEDURE removeOrder(
    orderId INT
)
BEGIN
	DECLARE rows INT;
    DECLARE counter INT;
    START TRANSACTION;
	
    SET rows = (SELECT COUNT(*) FROM webshop_orderRow WHERE order_id = orderId);
    SET counter = 0;
    WHILE counter < rows DO
        SELECT product_id, amount INTO @product_id, @product_amount
            FROM webshop_orderRow WHERE order_id = orderId LIMIT 1 OFFSET counter;

        UPDATE webshop_inventory
		SET
			amount = amount + @product_amount
		WHERE 
			prod_id = @product_id;
            
		SET counter = counter + 1;
        
    END WHILE;
    UPDATE webshop_order
	SET
		deleted = NOW()
	WHERE
		id = orderId
	;

    COMMIT;
END
//

DELIMITER ;

--
-- Trigger LogOrderMore
--
DROP TRIGGER IF EXISTS LogOrderMore;

DELIMITER //

CREATE TRIGGER LogOrderMore
AFTER UPDATE
ON webshop_inventory FOR EACH ROW
	IF New.amount <= 5 AND Old.amount > 5 THEN
		INSERT INTO webshop_orderMore (prod_id)
		VALUES (
            New.prod_id
        );
    ELSEIF New.amount > 5 AND Old.amount <= 5 THEN
		DELETE FROM webshop_orderMore
		WHERE
			prod_id = New.prod_id;
	END IF
//

DELIMITER ;
SHOW TRIGGERS;
--
-- Order information
--
DROP VIEW IF EXISTS webshop_Vorder;
CREATE VIEW webshop_Vorder AS
SELECT
	O.id AS OrderNumber,
    C.id AS CustomerNumber,
    O.created AS OrderDate,
    O.delivery AS DeliveryDate,
    C.firstName,
    C.lastName
FROM webshop_order AS O
	INNER JOIN webshop_customer AS C
		ON O.customer_id = C.id
WHERE
	O.deleted IS NULL OR O.deleted > NOW()
;

SELECT * FROM webshop_Vorder;

--
-- Order details
--
DROP VIEW IF EXISTS webshop_VorderDetails;
CREATE VIEW webshop_VorderDetails AS
SELECT
    O.id AS OrderNumber,
    R.id AS OrderRow,
    P.name AS Name,
    R.amount AS Amount
FROM webshop_order AS O
	INNER JOIN webshop_orderRow AS R
		ON O.id = R.order_id
	INNER JOIN webshop_product AS P
		ON R.product_id = P.id
WHERE
	O.deleted IS NULL OR O.deleted > NOW()
ORDER BY OrderRow
;

SELECT * FROM webshop_VorderDetails;

--
-- Order Plocklist
--
DROP VIEW IF EXISTS webshop_VplockList;
CREATE VIEW webshop_VplockList AS 
SELECT
    O.id AS OrderNumber,
    R.id AS OrderRow,
    P.name AS Name,
    R.amount AS Amount,
    S.shelf AS Shelf,
    S.description AS ShelfLocation,
    I.amount AS ItemsAvailable
FROM webshop_order AS O
	INNER JOIN webshop_orderRow AS R
		ON O.id = R.order_id
	INNER JOIN webshop_product AS P
		ON R.product_id = P.id
	INNER JOIN webshop_inventory AS I
		ON P.id = I.prod_id
	INNER JOIN webshop_invenShelf AS S
		ON I.shelf_name = S.shelf
WHERE
	O.deleted IS NULL OR O.deleted > NOW()
ORDER BY OrderRow
;

--
-- Order more view
--
DROP VIEW IF EXISTS webshop_VorderMore;
CREATE VIEW webshop_VorderMore AS 
SELECT
    O.id AS Id,
    P.id AS `Product Id`,
    P.name AS Name,
    P.platform AS Platform,
    I.amount AS `Amount available`
FROM webshop_orderMore AS O
	INNER JOIN webshop_product AS P
		ON O.prod_id = P.id
	INNER JOIN webshop_inventory AS I
		ON O.prod_id = I.prod_id
ORDER BY Id
;

--
-- Show views
--
-- SELECT * FROM webshop_VplockList;
-- SELECT * FROM webshop_Vinventory;
-- SELECT * FROM webshop_VorderDetails;
-- SELECT * FROM webshop_Vorder;
-- SELECT * FROM webshop_Vcart;
-- SELECT * FROM webshop_VorderMore;

--
-- Show tables
--
-- SELECT * FROM webshop_cart;
-- SELECT * FROM webshop_cartRow;
-- SELECT * FROM webshop_order;
-- SELECT * FROM webshop_orderRow;
-- SELECT * FROM webshop_orderMore;
-- SELECT * FROM webshop_product;

--
-- Use procedures
--
-- CALL deleteProd(1);
-- CALL addToCart(1, 3, 95);
-- CALL addToCart(1, 2, 2);
-- CALL addToCart(1, 5, 3);
-- CALL addToCart(2, 3, 3);
-- CALL addToCart(2, 6, 8);
-- CALL createOrder(1);
-- CALL removeOrder(1);
-- CALL removeOrder(2);
-- CALL removeFromCart(1, 2);
