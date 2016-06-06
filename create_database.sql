DROP DATABASE IF EXISTS orr_test;
CREATE DATABASE orr_test;
USE orr_test;

DROP TABLE IF EXISTS offered_category;
DROP TABLE IF EXISTS restaurant_category;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS reserved_table;
DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS restaurant_table;
DROP TABLE IF EXISTS restaurant;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id                  INT             AUTO_INCREMENT,
    email               VARCHAR(20)     UNIQUE,
    user_name           VARCHAR(20)     UNIQUE,
    user_type           TINYINT(1)          NOT NULL,
    first_name          VARCHAR(50),
    last_name           VARCHAR(50),
    contact_number      VARCHAR(11)     NOT NULL,
    billing_address     VARCHAR(100),
    password            CHAR(60), -- this depends on how laravel handles login logout etc
    remember_token      CHAR(100),
    PRIMARY KEY (id) 
);

CREATE TABLE restaurant (
    id                  INT             AUTO_INCREMENT,
    name                VARCHAR(50)     NOT NULL,
    location            VARCHAR(100)    NOT NULL,
    owner_id            INT             NOT NULL,
    email               VARCHAR(50),
    contact_number      VARCHAR(11)     NOT NULL,
    rating              DOUBLE, -- This is a derived attribute created from all the reviews of a restaurant 
    website             VARCHAR(30),
    img_name            VARCHAR(100),
    parking_available   BOOLEAN,
    description         VARCHAR(500),
    featured            BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (id),
    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE food_menu (
    id          INT             AUTO_INCREMENT,
    restaurant_id       INT,
    name            VARCHAR(20)     NOT NULL,
    img_name        VARCHAR(100),
    price           DOUBLE,
    category        VARCHAR(20),
    PRIMARY KEY (id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);


CREATE TABLE restaurant_table (
    id          INT         AUTO_INCREMENT,
    restaurant_id       INT,
    capacity            INT             NOT NULL,
    booking_fee         DOUBLE          NOT NULL,
    PRIMARY KEY (id, restaurant_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);

CREATE TABLE reservation (
    id      INT             AUTO_INCREMENT PRIMARY KEY,
    user_id             INT             NOT NULL,
    reservation_fee     DOUBLE, -- This is a derived attribute found from booking_fee of the tables
    reservation_date    DATE            NOT NULL,
    reservation_time_slot VARCHAR(10)   NOT NULL, -- ONLY ALLOW SOME TIME SLOTS (SAY IN 30 MINUTES INTERVAL)  AS WE SHOWED IN UI, THIS WILL SIMPLIFY A LOT OF THINGS
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- for many to many relation between reservation and table
CREATE TABLE reservation_table (
    reservation_id      INT,
    table_number INT,
    restaurant_id       INT,
    PRIMARY KEY (reservation_id, table_number, restaurant_id),
    FOREIGN KEY (reservation_id) REFERENCES reservation(id) ON DELETE CASCADE,
    FOREIGN KEY (table_number) REFERENCES restaurant_table(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant_table(restaurant_id) ON DELETE CASCADE
);

CREATE TABLE restaurant_category (
    id                   INT             AUTO_INCREMENT PRIMARY KEY,
    category_name       VARCHAR(20)     NOT NULL
);

CREATE TABLE offered_category (
    category_id         INT,
    restaurant_id       INT,
    PRIMARY KEY (category_id, restaurant_id),
    FOREIGN KEY (category_id) REFERENCES restaurant_category(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
);

CREATE TABLE review (
    id                  INT         PRIMARY KEY AUTO_INCREMENT,
    restaurant_id       INT         NOT NULL,
    user_id             INT,
    review_text         VARCHAR(300),
    rating              INT,
    created_at          TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);


#####################################################################################################