<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filter.input');

class TablePhocaTemplateMenu extends JTable
{
	function __construct(& $db) {
		parent::__construct('#__phocatemplate_menus', 'id', $db);
	}
	
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		if (isset($array['columns']) && is_array($array['columns'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['columns']);
			$array['columns'] = (string)$registry;
		}
		return parent::bind($array, $ignore);
	}
	
	function check() {
		
		if (trim( $this->title ) == '') {
			$this->setError( JText::_( 'COM_PHOCATEMPLATE_ITEM_MUST_HAVE_TITLE') );
			return false;
		}

		if(empty($this->alias)) {
			$this->alias = $this->title;
		}
		$this->alias = PhocaTemplateHelper::getAliasName($this->alias);
		return true;
	}
}
?>