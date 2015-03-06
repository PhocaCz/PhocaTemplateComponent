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
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldPhocaColumns extends JFormFieldList
{
	protected $type 		= 'PhocaColumns';

	protected function getInput() {
	
		$attr = '';
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		$attr .= $this->element['multiple'] ? ' multiple="multiple"' : '';
		//$attr .= $this->multiple ? ' multiple="multiple"' : '';
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		$db = &JFactory::getDBO();

       //build the list of categories
		$query = 'SELECT a.title AS text, a.id AS value'
		. ' FROM #__phocatemplate_columns AS a'
		. ' WHERE a.published = 1'
		. ' ORDER BY a.ordering';
		$db->setQuery( $query );
		$columns = $db->loadObjectList();
	
	/*	// TODO - check for other views than category edit
		$view 	= JRequest::getVar( 'view' );
		$catId	= -1;
		if ($view == 'phocagalleryc') {
			$id 	= $this->form->getValue('id'); // id of current category
			if ((int)$id > 0) {
				$catId = $id;
			}
		}*/
		
		//$text = '';
		//array_unshift($columns, JHTML::_('select.option', '', '- '.JText::_('COM_PHOCATEMPLATE_SELECT_COLUMNS').' -', 'value', 'text'));
		
		//return JHTML::_('select.genericlist',  $columns,  $this->name, $attr, 'value', 'text', $this->value, $this->id );
	

		
		return JHtml::_('select.genericlist', $columns, $this->name.'[]',
			array(
				'list.attr' => $attr,
				'list.select' => $this->value,
				'id' => $this->id
			)
		);
	}
}
?>