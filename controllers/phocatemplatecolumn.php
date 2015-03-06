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
defined('_JEXEC') or die();
jimport('joomla.application.component.controllerform');


class PhocaTemplateCpControllerPhocaTemplateColumn extends JControllerForm
{

	protected	$option 		= 'com_phocatemplate';
	
	function __construct($config=array()) {
		
		parent::__construct($config);
		
		$task = JRequest::getVar('task');
		
		if ((string)$task == 'addmodule') {
			JRequest::setVar('task','add');
			JRequest::setVar('layout','edit_module');
		} else if ((string)$task == 'addposition') {
			JRequest::setVar('task','add');
			JRequest::setVar('layout','edit_position');
		}
	}
	
	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}


	protected function allowEdit($data = array(), $key = 'id')
	{
		return parent::allowEdit($data, $key);
	}
}
?>
