CREATE TABLE `user`(
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(30) NOT NULL ,
PRIMARY KEY(id));

CREATE TABLE tweet(
id int NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
text VARCHAR(255), 
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES `user`(id) ON DELETE CASCADE);

CREATE TABLE comment(
id int NOT NULL AUTO_INCREMENT,
text VARCHAR(100),
user_id INT NOT NULL,
tweet_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES `user`(id) ON DELETE CASCADE,
FOREIGN KEY (tweet_id) REFERENCES tweet(id) ON DELETE CASCADE);
 

