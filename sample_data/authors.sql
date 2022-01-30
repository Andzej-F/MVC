-- 
-- Table structure
-- 

CREATE TABLE `authors` (
  `author_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '',
  `surname` varchar(64) DEFAULT '',
  PRIMARY KEY (`author_id`)
) DEFAULT CHARSET=utf8mb4;

-- 
-- Sample data for table `authors`
-- 

INSERT INTO `authors` (`author_id`, `name`, `surname`) VALUES 
(1, 'Alexandre', 'Dumas'),
(2, 'Jules', 'Verne'),
(3, 'Robert Louis', 'Stevenson'),
(4, 'H. Rider', 'Haggard'),
(5, 'Walter', 'Scott'),
(6, 'Edgaras', 'Burroughsas'),
(7, 'Joseph', 'Conrad'),
(8, 'Gary', 'Paulsen'),
(9, 'Michael', 'Crichton'),
(10, 'Rudyard', 'Kipling'),
(11, 'Agatha', 'Christie'),
(12, 'Helen', 'Fielding'),
(13, 'J. K.', 'Rowling'),
(14, 'Gregory David', 'Roberts')