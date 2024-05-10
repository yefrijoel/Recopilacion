CREATE DATABASE `restaurant`;
USE `restaurant`;

-- Tabla de administrador
CREATE TABLE `administrator`(
    `id_admin` INT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL
);

-- Tabla de cooks
CREATE TABLE `cooks`(
    `id_cook` INT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL
);

-- Tabla of tables
CREATE TABLE `tables`(
    `id_table` INT PRIMARY KEY,
    `status` VARCHAR(45) NOT NULL CHECK (status IN ('FREE', 'OCCUPIED')),
    `occupancy_start_date` DATETIME,
    `occupancy_end_date` DATETIME,
    `shifts` TIME NOT NULL,
    `current_shift` INT NOT NULL,
    CHECK (`current_shift` BETWEEN 1 AND 5),
    CHECK (`shifts` LIKE '__:__ %'),
    CHECK (`shifts` LIKE '% %:%'),
    CHECK (`shifts` LIKE '% %__')
);

-- Tabla of categories
CREATE TABLE `categories`(
    `id_category` INT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL
);

-- Tabla of products
CREATE TABLE `products`(
    `id_product` INT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `id_category` INT NOT NULL,
    FOREIGN KEY (`id_category`) REFERENCES categories(`id_category`)
);

-- Tabla of shopping cart
CREATE TABLE `shopping_cart`(
    `id_cart` INT PRIMARY KEY,
    `id_table` INT NOT NULL,
    `id_product` INT NOT NULL,
    `quantity` INT NOT NULL,
    FOREIGN KEY (`id_table`) REFERENCES tables(`id_table`),
    FOREIGN KEY (`id_product`) REFERENCES products(`id_product`)
);

-- Tabla of orders
CREATE TABLE `orders`(
    `id_order` INT PRIMARY KEY,
    `id_table` INT NOT NULL,
    `order_date` DATETIME NOT NULL,
    `order_status` VARCHAR(45) NOT NULL CHECK (order_status IN ('REQUESTED', 'DELIVERED')),
    `id_cook` INT NOT NULL,
    FOREIGN KEY (`id_table`) REFERENCES tables(`id_table`),
    FOREIGN KEY (`id_cook`) REFERENCES cooks(`id_cook`)
);

-- Tabla of order details
CREATE TABLE `order_details`(
    `id_order_detail` INT PRIMARY KEY,
    `id_order` INT NOT NULL,
    `id_product` INT NOT NULL,
    `quantity` INT NOT NULL,
    FOREIGN KEY (`id_order`) REFERENCES orders(`id_order`),
    FOREIGN KEY (`id_product`) REFERENCES products(`id_product`)
);

-- Tabla of payment methods
CREATE TABLE `payment_methods`(
    `id_payment_method` INT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL
);

-- Tabla of payments
CREATE TABLE `payments`(
    `id_payment` INT PRIMARY KEY,
    `id_order` INT NOT NULL,
    `payment_date` DATETIME NOT NULL,
    `id_payment_method` INT NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`id_order`) REFERENCES orders(`id_order`),
    FOREIGN KEY (`id_payment_method`) REFERENCES payment_methods(`id_payment_method`)
);

