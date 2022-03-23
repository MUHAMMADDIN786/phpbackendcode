CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`category`) VALUES
('Technology'),
('Gaming'),
('Auto'),
('Entertainment'),
('Books');

CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `authors` (`author`) VALUES
('Daid'),
('herold'),
('ragnor'),
('here'),
('there');

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  
  `quote` varchar(255) NOT NULL,
  `authorId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY ('authorId') references authors (id),
  FOREIGN KEY ('categoryId') references categories (id)

);

INSERT INTO `quotes` (`quote`, `authorId`,`categoryId`) VALUES ('helo wolrd','1','1'),('helo wolrd','1','1'),('helo wolrd','1','1');