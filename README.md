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
order_id INT PRIMARY KEY AUTO_INCREMENT,
user VARCHAR(255) NOT NULL,
total INT,
shipping INT,
address VARCHAR(255) NOT NULL,
payment VARCHAR(255) NOT NULL
);


CREATE TABLE Reviews
(
post_id INT PRIMARY KEY AUTO_INCREMENT,
rating DOUBLE,
content TEXT
);

CREATE TABLE Items
(
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  stock DOUBLE,
  price DOUBLE,
  rating DOUBLE,
  description TEXT
);

SELECT Users.username, Orders.user
FROM Users
INNER JOIN Orders
ON Orders.user=Users.username
ORDER BY Users.username;

SELECT * FROM Users;
