CREATE DATABASE IF NOT EXISTS task;
USE task;
CREATE TABLE IF NOT EXISTS Posts(
	userID int,
    id int auto_increment PRIMARY KEY,
    title text,
    body text
);

CREATE TABLE IF NOT EXISTS Comments(
	postId int,
    id int PRIMARY KEY,
    name text,
    email text,
    body text,
    FOREIGN KEY (postId)  REFERENCES Posts (id)
);
