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
    ('Iron Longsword', 'A dependable steel blade for everyday adventuring.', 45.00),
    ('Oak Buckler', 'Lightweight shield with iron rim for quick defense.', 22.50),
    ('Traveler''s Leather Armor', 'Flexible leather armor with reinforced stitching.', 60.00),
    ('Steel Chainmail', 'Protective chainmail shirt for the front line.', 120.00),
    ('Hunter''s Shortbow', 'Short bow ideal for close woodland shots.', 38.00),
    ('Bundle of Arrows (20)', 'Fletched arrows with iron tips.', 12.00),
    ('Lesser Healing Potion', 'Restores a small amount of health.', 15.00),
    ('Torch (Pack of 3)', 'Long-burning torches for dark tunnels.', 6.00);
