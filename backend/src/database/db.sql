CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Products (
    product_id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    inStock BOOLEAN DEFAULT TRUE,
    brand VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Product_Gallery (
    gallery_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(255) NOT NULL,
    image_url TEXT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

CREATE TABLE Currencies (
    currency_label VARCHAR(10) PRIMARY KEY,
    symbol VARCHAR(5) NOT NULL
);

CREATE TABLE Prices (
    price_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency_label VARCHAR(10) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (currency_label) REFERENCES Currencies(currency_label)
);

CREATE TABLE Attribute_Sets (
    attribute_set_id INT AUTO_INCREMENT PRIMARY KEY,
    json_id VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL
);

-- Attribute Values Table (Defines specific values within a set, e.g., '40', 'S', 'Green')
CREATE TABLE Attributes (
    attribute_id INT AUTO_INCREMENT PRIMARY KEY,
    attribute_set_id INT NOT NULL,
    json_id VARCHAR(255) NOT NULL,      -- The 'id' field from JSON items ('40', 'Small', 'Green')
    display_value VARCHAR(255) NOT NULL,
    value VARCHAR(255) NOT NULL,        -- The actual value ('40', 'S', '#44FF03')
    FOREIGN KEY (attribute_set_id) REFERENCES Attribute_Sets(attribute_set_id)
);

CREATE TABLE Product_Attributes (
    product_id VARCHAR(255) NOT NULL,
    attribute_id INT NOT NULL,
    PRIMARY KEY (product_id, attribute_id), -- Composite primary key
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (attribute_id) REFERENCES Attributes(attribute_id)
);