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
jimport( 'joomla.application.component.view' );
 
class PhocaTemplateCpViewPhocaTemplateColumns extends JView
{
	protected $items;
	protected $pagination;
	protected $state;
	
	function display($tpl = null) {
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		JHTML::stylesheet('administrator/components/com_phocatemplate/assets/phocatemplate.css' );
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
		
	}

	
	function addToolbar() {
	
		require_once JPATH_COMPONENT.'/helpers/phocatemplatecolumns.php';
	
		$state	= $this->get('State');
		$canDo	= PhocaTemplateColumnsHelper::getActions($state->get('filter.column_id'));
	
		JToolBarHelper::title( JText::_( 'COM_PHOCATEMPLATE_COLUMNS' ), 'column.png' );
	
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew( 'phocatemplatecolumn.add','COM_PHOCATEMPLATE_HTML_CONTENT' );
			JToolBarHelper::addNew( 'phocatemplatecolumn.addmodule','COM_PHOCATEMPLATE_MODULE_CONTENT' );
			JToolBarHelper::addNew( 'phocatemplatecolumn.addposition','COM_PHOCATEMPLATE_MODULE_POSITION' );
		}
	
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('phocatemplatecolumn.edit','JTOOLBAR_EDIT');
		}
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			JToolBarHelper::custom('phocatemplatecolumns.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			JToolBarHelper::custom('phocatemplatecolumns.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
		}
	
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList( 'COM_PHOCATEMPLATE_WARNING_DELETE_ITEMS' , 'phocatemplatecolumns.delete', 'COM_PHOCATEMPLATE_DELETE');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.phocatemplate', true );
	}
}
?>