CREATE DATABASE IF NOT EXISTS guess_country_game;

USE guess_country_game;

CREATE TABLE games_history(
    number int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    score int NOT NULL,
    date DATETIME NOT NULL,
    roundtime int NOT NULL
);