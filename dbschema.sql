--
-- Table structure for table `feedItems`
--

CREATE TABLE IF NOT EXISTS `feedItems` (
  `pkID` int(11) NOT NULL AUTO_INCREMENT,
  `fkSourceID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pkID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13383 ;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `pkSourceID` int(11) NOT NULL AUTO_INCREMENT,
  `rssFeedURL` varchar(255) NOT NULL DEFAULT '',
  `lastCheck` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blogTitle` varchar(255) NOT NULL DEFAULT '',
  `blogLink` varchar(250) NOT NULL DEFAULT '',
  `imageURL` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`pkSourceID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;