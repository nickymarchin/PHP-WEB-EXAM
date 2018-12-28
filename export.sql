CREATE DATABASE softuni_library;

USE softuni_library;

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(255) NOT NULL,
  `born_on` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username`)
)
  ENGINE=InnoDB
;

CREATE TABLE `genres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
;

CREATE TABLE `books` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `author` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `image` TEXT NOT NULL,
  `genre_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `added_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  index `fk_books_genres` (`genre_id`),
  index `fk_books_users` (`user_id`),
  constraint `fk_books_genres` foreign key (`genre_id`) references `genres` (`id`),
  constraint `fk_books_users` foreign key (`user_id`) references `users` (`id`)
)
  ENGINE=InnoDB
;

insert into `genres` (`name`) values ('Drama');
insert into `genres` (`name`) values ('Educational');
insert into `genres` (`name`) values ('Adventure');


