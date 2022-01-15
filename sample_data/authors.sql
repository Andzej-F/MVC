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
(NULL, 'Alexandre', 'Dumas'),
(NULL, 'Jules', 'Verne'),
(NULL, 'Robert Louis', 'Stevenson'),
(NULL, 'H. Rider', 'Haggard'),
(NULL, 'Walter', 'Scott'),
(NULL, 'Edgaras', 'Burroughsas'),
(NULL, 'Joseph', 'Conrad'),
(NULL, 'Gary', 'Paulsen'),
(NULL, 'Michael', 'Crichton'),
(NULL, 'Rudyard', 'Kipling'),
(NULL, 'Agatha', 'Christie'),
(NULL, 'Helen', 'Fielding'),
(NULL, 'J. K.', 'Rowling'),
(NULL, 'Gregory David', 'Roberts')

