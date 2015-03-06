<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Phoca Template
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class PhocaTemplateCpControllerPhocaTemplateinstall extends PhocaTemplateCpController
{
	function __construct() {
		parent::__construct();
		$this->registerTask( 'install'  , 'install' );
		$this->registerTask( 'upgrade'  , 'upgrade' );		
	}

	
	
	function install() {		
		
		$db			= &JFactory::getDBO();
		$dbPref 	= $db->getPrefix();
		$msgSQL 	= '';
		$msgFile	= '';
		$msgError	= '';
		
		
		
		$query =' DROP TABLE IF EXISTS `'.$dbPref.'phocatemplate_columns`;';
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		
		$query ='CREATE TABLE `'.$dbPref.'phocatemplate_columns` ('."\n";
		$query.='  `id` int(11) unsigned NOT NULL auto_increment,'."\n";
		$query.='  `title` varchar(200) NOT NULL default \'\','."\n";
		$query.='  `alias` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `type` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `width` int(6) NOT NULL default \'0\','."\n";
		$query.='  `content` text,'."\n";
		$query.='  `moduleid` int(11) NOT NULL default \'0\','."\n";
		$query.='  `position` varchar(50) DEFAULT NULL,'."\n";
		$query.='  `displaytitle` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `published` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `checked_out` int(11) NOT NULL default \'0\','."\n";
		$query.='  `checked_out_time` datetime NOT NULL default \'0000-00-00 00:00:00\','."\n";
		$query.='  `ordering` int(11) NOT NULL default \'0\','."\n";
		$query.='  `params` text,'."\n";
		$query.='  `language` char(7) NOT NULL Default \'\','."\n";
		$query.='  PRIMARY KEY  (`id`),'."\n";
		$query.='  KEY `published` (`published`)'."\n";
		$query.=') ENGINE=MyISAM CHARACTER SET `utf8`;';
		
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		$query=' DROP TABLE IF EXISTS `'.$dbPref.'phocatemplate_menus`;'."\n";
		
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		$query ='CREATE TABLE `'.$dbPref.'phocatemplate_menus` ('."\n";
		$query.='  `id` int(11) NOT NULL auto_increment,'."\n";
		$query.='  `title` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `alias` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `image` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `width` int(6) NOT NULL default \'0\','."\n";
		$query.='  `displaytitle` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `description` text,'."\n";
		$query.='  `columns` text,'."\n";
		$query.='  `menuid` int(11) NOT NULL default \'0\','."\n";
		$query.='  `published` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `checked_out` int(11) unsigned NOT NULL default \'0\','."\n";
		$query.='  `checked_out_time` datetime NOT NULL default \'0000-00-00 00:00:00\','."\n";
		$query.='  `ordering` int(11) NOT NULL default \'0\','."\n";
		$query.='  `access` tinyint(3) unsigned NOT NULL default \'0\','."\n";
		$query.='  `params` text,'."\n";
		$query.='  `language` char(7) NOT NULL Default \'\','."\n";
		$query.='  PRIMARY KEY  (`id`),'."\n";
		$query.='  KEY `cat_idx` (`published`,`access`),'."\n";
		$query.='  KEY `idx_access` (`access`),'."\n";
		$query.='  KEY `idx_checkout` (`checked_out`)'."\n";
		$query.=') ENGINE=MyISAM CHARACTER SET `utf8`;';
		
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		
		// Error
		if ($msgSQL !='') {
			$msgError .= '<br />' . $msgSQL;
		}
		
		if ($msgError !='') {
			$msg = JText::_( 'Phoca Template not successfully installed' ) . ': <br />' . $msg_sql;
		} else {
			$msg = JText::_( 'Phoca Template successfully installed' );
		}
		
		$link = 'index.php?option=com_phocatemplate';
		$this->setRedirect($link, $msg);
	}
	
	function upgrade()
	{
		$db			= &JFactory::getDBO();
		$dbPref 	= $db->getPrefix();
		$msgSQL 	= '';
		$msgFile	= '';
		$msgError	= '';
		
		
		$query ='CREATE TABLE `'.$dbPref.'phocatemplate_columns` ('."\n";
		$query.='  `id` int(11) unsigned NOT NULL auto_increment,'."\n";
		$query.='  `title` varchar(200) NOT NULL default \'\','."\n";
		$query.='  `alias` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `type` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `width` int(6) NOT NULL default \'0\','."\n";
		$query.='  `content` text,'."\n";
		$query.='  `moduleid` int(11) NOT NULL default \'0\','."\n";
		$query.='  `position` varchar(50) DEFAULT NULL,'."\n";
		$query.='  `displaytitle` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `published` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `checked_out` int(11) NOT NULL default \'0\','."\n";
		$query.='  `checked_out_time` datetime NOT NULL default \'0000-00-00 00:00:00\','."\n";
		$query.='  `ordering` int(11) NOT NULL default \'0\','."\n";
		$query.='  `params` text,'."\n";
		$query.='  `language` char(7) NOT NULL Default \'\','."\n";
		$query.='  PRIMARY KEY  (`id`),'."\n";
		$query.='  KEY `published` (`published`)'."\n";
		$query.=') ENGINE=MyISAM CHARACTER SET `utf8`;';
		
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		
		$query ='CREATE TABLE `'.$dbPref.'phocatemplate_menus` ('."\n";
		$query.='  `id` int(11) NOT NULL auto_increment,'."\n";
		$query.='  `title` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `alias` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `image` varchar(255) NOT NULL default \'\','."\n";
		$query.='  `width` int(6) NOT NULL default \'0\','."\n";
		$query.='  `displaytitle` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `description` text,'."\n";
		$query.='  `columns` text,'."\n";
		$query.='  `menuid` int(11) NOT NULL default \'0\','."\n";
		$query.='  `published` tinyint(1) NOT NULL default \'0\','."\n";
		$query.='  `checked_out` int(11) unsigned NOT NULL default \'0\','."\n";
		$query.='  `checked_out_time` datetime NOT NULL default \'0000-00-00 00:00:00\','."\n";
		$query.='  `ordering` int(11) NOT NULL default \'0\','."\n";
		$query.='  `access` tinyint(3) unsigned NOT NULL default \'0\','."\n";
		$query.='  `params` text,'."\n";
		$query.='  `language` char(7) NOT NULL Default \'\','."\n";
		$query.='  PRIMARY KEY  (`id`),'."\n";
		$query.='  KEY `cat_idx` (`published`,`access`),'."\n";
		$query.='  KEY `idx_access` (`access`),'."\n";
		$query.='  KEY `idx_checkout` (`checked_out`)'."\n";
		$query.=') ENGINE=MyISAM CHARACTER SET `utf8`;';
		
		$db->setQuery( $query );
		if (!$result = $db->query()){$msgSQL .= $db->stderr() . '<br />';}
		
		
		// Error
		if ($msgSQL !='') {
			$msgError .= '<br />' . $msgSQL;
		}
		
		if ($msgError !='') {
			$msg = JText::_( 'Phoca Template not successfully upgraded' ) . ': <br />' . $msg_sql;
		} else {
			$msg = JText::_( 'Phoca Template successfully upgraded' );
		}
	
		$link = 'index.php?option=com_phocatemplate';
		$this->setRedirect($link, $msg);
	}
}