# EECS_647_Database45_Project
mysql -h mysql.eecs.ku.edu -u dawsonfrick84 -p

CREATE TABLE Users
(
username VARCHAR(255) PRIMARY KEY NOT NULL UNIQUE,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
permissions BOOLEAN
);

CREATE TABLE Orders
(
order_id INT PRIMARY KEY,
user VARCHAR(255) NOT NULL,
total DOUBLE,
shipping DOUBLE,
address VARCHAR(255) NOT NULL,
payment VARCHAR(255) NOT NULL
);

CREATE TABLE Purchases
(
order_id INT,
item_id INT,
quantity INT
);


CREATE TABLE Reviews
(
post_id INT PRIMARY KEY AUTO_INCREMENT,
rating DOUBLE,
total_reviews INT,
content TEXT,
item_id INT
);

CREATE TABLE Items
(
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255),
  name VARCHAR(255) NOT NULL,
  stock INT,
  price DOUBLE,
  rating DOUBLE,
  picture TEXT,
  description TEXT,
  ISBN VARCHAR(255)
);


SELECT * FROM Users;

INSERT INTO Items (username, name, stock, price, rating, picture, description) VALUES ('admin', 'Dixon Ticonderoga Pencils', 35, 10, 5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS-ZuI-EhlXn7RiuunPezDwoyHbk2OkMN-f7fxCQXX0lzziIMdstQYT3nUg707ra2BeX6BeqUJb&usqp=CAc', 'Pre-sharpened number 2 pencils');

INSERT INTO Items (username, name, stock, price, rating, picture, description) VALUES ('admin', 'iClicker', 100, 66.50, 3.5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTayuuBOYe16LPaohPE_EXqeZ_LEKBkdGRgN_Ykb1VxIo-uQp8ua3yrrJgQYNufHrocHkNAfQ&usqp=CAc', 'Used student remotes');

INSERT INTO Items (username, name, stock, price, rating, picture, description, ISBN) VALUES ('admin', 'Database Systems: The Complete Book', 125, 29.99, 2.5, 'https://images-na.ssl-images-amazon.com/images/I/51JtltOJPVL._SX353_BO1,204,203,200_.jpg', '2nd Edition, by Hector Garcia-Molina, Jeff Ullman, and Jennifer Widom, Prentice Hall, 2008.', '9780131873254');
