CREATE TABLE IF NOT EXISTS `templog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suhu` double(15,2) DEFAULT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
