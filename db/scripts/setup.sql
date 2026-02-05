-- setup.sql
-- Creates products and cart_items tables for lab_project

USE lab_project;

DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    cost DECIMAL(8,2) NOT NULL
);

CREATE TABLE cart_items (
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_cart_items_products
        FOREIGN KEY (product_id)
        REFERENCES products(product_id)
        ON DELETE CASCADE
);

INSERT INTO products (name, description, cost) VALUES
    ('PLACEHOLDER_PRODUCT_1', 'PLACEHOLDER_DESCRIPTION_1', 0.00),
    ('PLACEHOLDER_PRODUCT_2', 'PLACEHOLDER_DESCRIPTION_2', 0.00),
    ('PLACEHOLDER_PRODUCT_3', 'PLACEHOLDER_DESCRIPTION_3', 0.00),
    ('PLACEHOLDER_PRODUCT_4', 'PLACEHOLDER_DESCRIPTION_4', 0.00),
    ('PLACEHOLDER_PRODUCT_5', 'PLACEHOLDER_DESCRIPTION_5', 0.00);
