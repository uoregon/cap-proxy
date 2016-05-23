# Dump of table alerts
# ------------------------------------------------------------

CREATE TABLE `alerts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text,
  `body` text,
  `received_user` varchar(40) DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;