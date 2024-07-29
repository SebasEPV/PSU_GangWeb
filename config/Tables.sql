CREATE DATABASE psuGangWeb;
USE psuGangWeb;


CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR (25) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    email VARCHAR (50) NOT NULL,
    permissions BOOL NOT NULL
);

CREATE TABLE tiers(
    tier_id INT AUTO_INCREMENT PRIMARY KEY, 
    tier_name VARCHAR(50) NOT NULL UNIQUE,
    tier_description VARCHAR(200) NOT NULL
);

CREATE TABLE brands(
    brand_id INT AUTO_INCREMENT PRIMARY KEY, 
    brand_name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE categories(
    category_id INT AUTO_INCREMENT PRIMARY KEY, 
    category_name VARCHAR(50) NOT NULL UNIQUE,
    category_description VARCHAR (200) NOT NULL
);

CREATE TABLE products(
    product_id INT AUTO_INCREMENT PRIMARY KEY, 
    product_name VARCHAR(50) NOT NULL UNIQUE,
    product_description VARCHAR(200) NOT NULL,
    product_price FLOAT NOT NULL,
    fk_brand_id INT,
    CONSTRAINT fk_brand_id FOREIGN KEY (fk_brand_id) REFERENCES brands(brand_id),
    fk_tier_id INT,
    CONSTRAINT fk_tier_id FOREIGN KEY (fk_tier_id) REFERENCES tiers(tier_id)
);

CREATE TABLE reviews(
    review_id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR (40) NOT NULL,
    content VARCHAR(200) NOT NULL,
    date_review DATETIME DEFAULT NOW(),
    fk_product_id INT,
    CONSTRAINT fk_product_id FOREIGN KEY (fk_product_id) REFERENCES products(product_id),
    fk_tier_id INT,
    CONSTRAINT fk_tier_id_reviews FOREIGN KEY (fk_tier_id) REFERENCES tiers(tier_id),
	fk_author_id INT,
    CONSTRAINT fk_author_id_reviews FOREIGN KEY (fk_author_id) REFERENCES users(user_id)
);

CREATE TABLE product_categories(
    fk_product_id INT,
    fk_category_id INT,
    CONSTRAINT fk_product_id_product_categories FOREIGN KEY (fk_product_id) REFERENCES products(product_id),
    CONSTRAINT fk_category_id_product_categories FOREIGN KEY (fk_category_id) REFERENCES categories(category_id)
);

CREATE TABLE comments (
	comments_id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    fk_user_id INT,
	CONSTRAINT fk_user_id_comments FOREIGN KEY (fk_user_id) REFERENCES users(user_id),
    fk_review_id INT,
	CONSTRAINT fk_review_id_comments FOREIGN KEY (fk_review_id) REFERENCES reviews(review_id)
);

CREATE TABLE restablecerContraseña(
	id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(30) NOT NULL,
    token VARCHAR(100) NOT NULL,
    expire_Date DATETIME NOT NULL
);

CREATE VIEW consultReviews AS
SELECT review_id, product_name, username, tier_name, date_review, title, content
FROM products p INNER JOIN reviews r
ON fk_product_id = product_id INNER JOIN
users u ON user_id = fk_author_id INNER JOIN tiers t ON
tier_id = r.fk_tier_id;

CREATE VIEW consultProducts AS
SELECT product_id, product_name, brand_name, category_name, product_price, product_description
FROM products p INNER JOIN reviews r
ON r.fk_product_id = product_id INNER JOIN
users u ON user_id = fk_author_id INNER JOIN product_categories pt ON
pt.fk_product_id = product_id INNER JOIN categories ON category_id =
fk_category_id INNER JOIN brands ON brand_id =
fk_brand_id;

DROP DATABASE psugangweb;
