DROP TABLE IF EXISTS `#__phocatemplate_columns`;
CREATE TABLE `#__phocatemplate_columns` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `type` tinyint(1) NOT NULL default '0',
  `username` varchar(100) NOT NULL default '',
  `content` text,
  `width` int(6) NOT NULL default '0',
  `moduleid` int(11) NOT NULL default '0',
  `position` varchar(50) DEFAULT NULL,
  `displaytitle` tinyint(1) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text,
  `language` char(7) NOT NULL Default '',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`)
) ENGINE=MyISAM CHARACTER SET `utf8`;

DROP TABLE IF EXISTS `#__phocatemplate_menus`;
CREATE TABLE `#__phocatemplate_menus` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `displaytitle` tinyint(1) NOT NULL default '0',
  `description` text,
  `columns` text,
  `menuid` int(11) unsigned NOT NULL default '0',
  `width` int(6) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  `language` char(7) NOT NULL Default '',
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM CHARACTER SET `utf8`;