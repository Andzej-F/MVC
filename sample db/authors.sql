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
-- Sample data
-- 

INSERT INTO `authors` (`author_id`, `name`, `surname`)
VALUES (NULL, 'Alexandre', 'Dumas'), 
(NULL, 'Walter', 'Scott'),
(NULL, 'Edgar Rice', 'Burroughs'),
(NULL, 'Rudyard', 'Kipling'), (NULL, 'Yann', 'Martel')