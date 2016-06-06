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


