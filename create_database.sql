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
delimiter //
CREATE TRIGGER update_restaurant_rating 
AFTER INSERT 
    ON review FOR EACH ROW
BEGIN
    DECLARE numReviews INT;
    DECLARE totalRating INT;
    DECLARE newRating DOUBLE;
    SET numReviews = (SELECT COUNT(*) FROM review WHERE restaurant_id = NEW.restaurant_id);
    SELECT SUM(rating) FROM review WHERE restaurant_id = NEW.restaurant_id INTO totalRating;
    SET newRating = (totalRating / numReviews);
    UPDATE restaurant SET rating = newRating WHERE id = NEW.restaurant_id;
    IF newRating > 4 THEN
    	UPDATE restaurant SET featured = 1 WHERE id = NEW.restaurant_id;
    END IF;
END;//
delimiter ;
#####################################################################################################

insert into restaurant_category (category_name) values ("Thai");
insert into restaurant_category (category_name) values ("Chinese");
insert into restaurant_category (category_name) values ("Bangali");
insert into restaurant_category (category_name) values ("Italian");
insert into restaurant_category (category_name) values ("Seafood");
insert into restaurant_category (category_name) values ("Fast Food");



insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("s.saqib", 1, "saqib", "eusuf", "2", "Jhinaidoho", "no-fate", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("leukhhp_prrvd", 0, "ibraheem", "moosa", "1", "Chittagong", "google", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("KAI10", 1, "Ashik", "Kazi", "017", "Dhaka", "pass", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("adnan0944", 1, "Adnan", "Hassan", "019", "Dhaka", "guess", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("prethul", 0, "Jaiaid", "Mobin", "011", "Dhaka", "earn", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("Tariq", 1, "Tariq", "Adnan", "019", "Dhaka", "TF", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("Touhid", 1, "Touhid", "Shohan", "015", "Dhaka", "NG", "");

insert into users (user_name, user_type, first_name, last_name, contact_number, billing_address, password, remember_token) values 
("Tripto001", 0, "Tripto", "Irtiza", "017", "Mymensingh", "real", "");

insert into restaurant (name, location, owner_id, contact_number) values ("KFC", "Dhanmondi", 1, "123456");
insert into restaurant (name, location, owner_id, contact_number, img_name) values ("Gloria Jeans Coffe", "Gulshan", 3, "123456", "Gloria_Jeans_Coffee.jpg");
insert into restaurant (name, location, owner_id, contact_number, img_name) values ("The Atrium Restaurant", "Baridhara", 4, "123456", "Restaurant-Atrium-003.jpg");

insert into offered_category values((select id from restaurant_category where category_name = "Fast Food"),(select id from restaurant where name = "KFC"));

insert into review (restaurant_id, user_id, review_text, rating) values
((select id from restaurant where name = "KFC"), (select id from users where user_name = "KAI10"), "Great environment here at KFC", 5.0);

insert into review (restaurant_id, user_id, review_text, rating) values
((select id from restaurant where name = "Gloria Jeans Coffe"), (select id from users where user_name = "Tariq"), "The Coffee was great at a reasonable price.",4.0);


insert into food_menu (restaurant_id, name, img_name, price, category) values 
((select id from restaurant where name = "The Atrium Restaurant"), "Thai Soup", "thai_soup.jpg", 200, "appetizer");

insert into food_menu (restaurant_id, name, img_name, price, category) values 
((select id from restaurant where name = "The Atrium Restaurant"), "Fried Rice", "fried_rice.jpg", 300, "main course");


insert into review (restaurant_id, user_id, review_text, rating) values
((select id from restaurant where name = "The Atrium Restaurant"), (select id from users where user_name = "Touhid"), "Great fried rice.",5.0);


