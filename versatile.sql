CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(1, 'john', 'john@doe.com', '123456'),
	(2, 'jane', 'jane@doe.com', '123456');