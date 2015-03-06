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
jimport('joomla.application.component.controller');
// Submenu view
$view	= JRequest::getVar( 'view', '', '', 'string', JREQUEST_ALLOWRAW );

$l['cp']	= 'COM_PHOCATEMPLATE_CONTROL_PANEL';
$l['m']		= 'COM_PHOCATEMPLATE_MENU_ITEMS';
$l['c']		= 'COM_PHOCATEMPLATE_COLUMNS';
$l['in']	= 'COM_PHOCATEMPLATE_INFO';

if ($view == '' || $view == 'phocatemplatecp') {
	JSubMenuHelper::addEntry(JText::_($l['cp']), 'index.php?option=com_phocatemplate');
	JSubMenuHelper::addEntry(JText::_($l['m']), 'index.php?option=com_phocatemplate&view=phocatemplatemenus');
	JSubMenuHelper::addEntry(JText::_($l['c']), 'index.php?option=com_phocatemplate&view=phocatemplatecolumns');
	JSubMenuHelper::addEntry(JText::_($l['in']), 'index.php?option=com_phocatemplate&view=phocatemplateinfo');
}

if ($view == 'phocatemplatecolumns') {
	JSubMenuHelper::addEntry(JText::_($l['cp']), 'index.php?option=com_phocatemplate');
	JSubMenuHelper::addEntry(JText::_($l['m']), 'index.php?option=com_phocatemplate&view=phocatemplatemenus');
	JSubMenuHelper::addEntry(JText::_($l['c']), 'index.php?option=com_phocatemplate&view=phocatemplatecolumns', true );
	JSubMenuHelper::addEntry(JText::_($l['in']), 'index.php?option=com_phocatemplate&view=phocatemplateinfo');
}

if ($view == 'phocatemplatemenus') {
	JSubMenuHelper::addEntry(JText::_($l['cp']), 'index.php?option=com_phocatemplate');
	JSubMenuHelper::addEntry(JText::_($l['m']), 'index.php?option=com_phocatemplate&view=phocatemplatemenus', true);
	JSubMenuHelper::addEntry(JText::_($l['c']), 'index.php?option=com_phocatemplate&view=phocatemplatecolumns' );
	JSubMenuHelper::addEntry(JText::_($l['in']), 'index.php?option=com_phocatemplate&view=phocatemplateinfo');
}

if ($view == 'phocatemplateinfo') {
	JSubMenuHelper::addEntry(JText::_($l['cp']), 'index.php?option=com_phocatemplate');
	JSubMenuHelper::addEntry(JText::_($l['m']), 'index.php?option=com_phocatemplate&view=phocatemplatemenus');
	JSubMenuHelper::addEntry(JText::_($l['c']), 'index.php?option=com_phocatemplate&view=phocatemplatecolumns' );
	JSubMenuHelper::addEntry(JText::_($l['in']), 'index.php?option=com_phocatemplate&view=phocatemplateinfo', true);
}

class PhocaTemplatecpController extends JController
{
	function display() {
		parent::display();
	}
}
?>
