<?php
/**
 * @version		$Id: moduleposition.php 20196 2011-01-09 02:40:25Z ian $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
JFormHelper::loadFieldClass('text');

/**
 * Supports a modal article picker.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_content
 * @since		1.6
 */
class JFormFieldModuleId extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'ModuleId';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$attr = '';
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		$attr .= $this->element['multiple'] ? ' multiple="multiple"' : '';
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		$ordering = 'ordering';
		$db = &JFactory::getDBO();
		$query = $this->getListQuery();
		$db->setQuery( $query );
		$result = $db->loadObjectList();
		
		$this->translate($result);
		$lang = JFactory::getLanguage();
		JArrayHelper::sortObjects($result,$ordering, -1, true, $lang->getLocale());
		
		return JHtml::_('select.genericlist', $result, $this->name,
			array(
				'list.attr' => $attr,
				'list.select' => $this->value,
				'id' => $this->id
			)
		);
	}
/*
	protected function _getList($query, $limitstart=0, $limit=0)
	{
		$ordering = $this->getState('list.ordering', 'ordering');
		if (in_array($ordering, array('pages', 'name'))) {
			$this->_db->setQuery($query);
			$result = $this->_db->loadObjectList();
			$this->translate($result);
			$lang = JFactory::getLanguage();
			JArrayHelper::sortObjects($result,$ordering, $this->getState('list.direction') == 'desc' ? -1 : 1, true, $lang->getLocale());
			$total = count($result);
			$this->cache[$this->getStoreId('getTotal')] = $total;
			if ($total < $limitstart) {
				$limitstart = 0;
				$this->setState('list.start', 0);
			}
			return array_slice($result, $limitstart, $limit ? $limit : null);
		}
		else {
			if ($ordering == 'ordering') {
				$query->order('position ASC');
			}
			$query->order($this->_db->nameQuote($ordering) . ' ' . $this->getState('list.direction'));
			if ($ordering == 'position') {
				$query->order('ordering ASC');
			}
			$result = parent::_getList($query, $limitstart, $limit);
			$this->translate($result);
			return $result;
		}
	}*/

	/**
	 * Translate a list of objects
	 *
	 * @param	array The array of objects
	 * @return	array The array of translated objects
	 */
	protected function translate(&$items)
	{
		$lang = JFactory::getLanguage();
		//$client = $this->getState('filter.client_id') ? 'administrator' : 'site';
		$client = 'administrator';
		foreach($items as $item) {
			$extension = $item->module;
			$source = constant('JPATH_' . strtoupper($client)) . "/modules/$extension";
				$lang->load("$extension.sys", constant('JPATH_' . strtoupper($client)), null, false, false)
			||	$lang->load("$extension.sys", $source, null, false, false)
			||	$lang->load("$extension.sys", constant('JPATH_' . strtoupper($client)), $lang->getDefault(), false, false)
			||	$lang->load("$extension.sys", $source, $lang->getDefault(), false, false);
/*			$item->name = JText::_($item->name);
			if (is_null($item->pages)) {
				$item->pages = JText::_('JNONE');
			} else if ($item->pages < 0) {
				$item->pages = JText::_('COM_MODULES_ASSIGNED_VARIES_EXCEPT');
			} else if ($item->pages > 0) {
				$item->pages = JText::_('COM_MODULES_ASSIGNED_VARIES_ONLY');
			} else {
				$item->pages = JText::_('JALL');
			}
*/
		}
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db 	= &JFactory::getDBO();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			
				'a.id as value, a.title as text, a.module, a.ordering'

		);
		$query->from('`#__modules` AS a');

/*		// Join over the language
		$query->select('l.title AS language_title');
		$query->join('LEFT', '`#__languages` AS l ON l.lang_code = a.language');

		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');

		// Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = a.access');

		// Join over the module menus
		$query->select('MIN(mm.menuid) AS pages');
		$query->join('LEFT', '#__modules_menu AS mm ON mm.moduleid = a.id');
		$query->group('a.id');

		// Join over the extensions
		$query->select('e.name AS name');
		$query->join('LEFT', '#__extensions AS e ON e.element = a.module');
		$query->group('a.id');
*/
/*		
		// Filter by access level.
		if ($access = $this->getState('filter.access')) {
			$query->where('a.access = '.(int) $access);
		}

		// Filter by published state
		$state = $this->getState('filter.state');
*/
		$state = 1;
		if (is_numeric($state)) {
			$query->where('a.published = '.(int) $state);
		}
		else if ($state === '') {
			$query->where('(a.published IN (0, 1))');
		}
/*
		// Filter by position
		$position = $this->getState('filter.position');
		if ($position) {
			$query->where('a.position = '.$db->Quote($position));
		}

		// Filter by module
		$module = $this->getState('filter.module');
		if ($module) {
			$query->where('a.module = '.$db->Quote($module));
		}

		// Filter by client.
		$clientId = $this->getState('filter.client_id');
		if (is_numeric($clientId)) {
			$query->where('a.client_id = '.(int) $clientId);
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('('.'a.title LIKE '.$search.' OR a.note LIKE '.$search.')');
			}
		}

		// Filter on the language.
		if ($language = $this->getState('filter.language')) {
			$query->where('a.language = ' . $db->quote($language));
		}
*/
		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}
}
?>