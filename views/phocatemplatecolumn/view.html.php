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

class PhocaTemplateCpViewPhocaTemplateColumn extends JView
{
	protected $state;
	protected $item;
	protected $form;
	protected $tmpl;
	
	public function display($tpl = null) {
		$this->state	= $this->get('State');
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');

		JHTML::stylesheet('administrator/components/com_phocatemplate/assets/phocatemplate.css' );

		if (isset($this->item->type) && (int)$this->item->type == 2 && JRequest::getVar('layout') != 'edit_module') {
			$tpl = 'module';
		} else if (isset($this->item->type) && (int)$this->item->type == 3 && JRequest::getVar('layout') != 'edit_position') {
			$tpl = 'position';
		}
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'phocatemplatecolumns.php';
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= PhocaTemplateColumnsHelper::getActions($this->state->get('filter.column_id'), $this->item->id);
		//$paramsC 	= JComponentHelper::getParams('com_phocatemplate');

		

		$text = $isNew ? JText::_( 'COM_PHOCATEMPLATE_NEW' ) : JText::_('COM_PHOCATEMPLATE_EDIT');
		JToolBarHelper::title(   JText::_( 'COM_PHOCATEMPLATE_COLUMN' ).': <small><small>[ ' . $text.' ]</small></small>' , 'column.png');

		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit')){
			JToolBarHelper::apply('phocatemplatecolumn.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('phocatemplatecolumn.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('phocatemplatecolumn.save2new', 'JTOOLBAR_SAVE_AND_NEW');
		}
	
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('phocatemplatecolumn.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('phocatemplatecolumn.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help( 'screen.phocatemplate', true );
	}
}
?>
