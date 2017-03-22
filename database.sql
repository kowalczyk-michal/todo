CREATE TABLE `todo` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255),
  `description` text,
  `completed` int(1) NOT NULL DEFAULT '0',
  `completed_date` datetime DEFAULT NULL,
  PRIMARY KEY  (`id`)
);