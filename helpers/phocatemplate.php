<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */ 
jimport('joomla.application.component.controller');

class PhocaTemplateHelper
{
	/**
	 * Method to get Phoca Version
	 * @return string Version of Phoca Gallery
	 */
	function getPhocaVersion()
	{
		$folder = JPATH_ADMINISTRATOR .DS. 'components'.DS.'com_phocatemplate';
		if (JFolder::exists($folder)) {
			$xmlFilesInDir = JFolder::files($folder, '.xml$');
		} else {
			$folder = JPATH_SITE .DS. 'components'.DS.'com_phocatemplate';
			if (JFolder::exists($folder)) {
				$xmlFilesInDir = JFolder::files($folder, '.xml$');
			} else {
				$xmlFilesInDir = null;
			}
		}

		$xml_items = '';
		if (count($xmlFilesInDir))
		{
			foreach ($xmlFilesInDir as $xmlfile)
			{
				if ($data = JApplicationHelper::parseXMLInstallFile($folder.DS.$xmlfile)) {
					foreach($data as $key => $value) {
						$xml_items[$key] = $value;
					}
				}
			}
		}
		
		if (isset($xml_items['version']) && $xml_items['version'] != '' ) {
			return $xml_items['version'];
		} else {
			return '';
		}
	}
	
	function getAliasName($name) {
		
		$name = JFilterOutput::stringURLSafe($name);
		
		if(trim(str_replace('-','',$name)) == '') {
			$datenow	= &JFactory::getDate();
			$name 		= $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
		}
		return $name;
	}
	
	/*
	 * Template Helpers
	 */
	 
	function getSubmenuOutput($id) {
	
		$output = array();
		$o = '';
		if ((int)$id > 0) {
			$db = &JFactory::getDBO();

		   //build the list of categories
			$query = 'SELECT a.*'
			. ' FROM #__phocatemplate_menus AS a'
			. ' WHERE a.published = 1'
			. ' AND a.menuid ='.(int)$id
			. ' ORDER BY a.ordering';
			$db->setQuery( $query );
			
			if (!$db->query()) {
				$this->setError($db->getErrorMsg());
				return false;
			}
			$item = $db->loadObject();
			
			if (isset($item->description)) {
				$output['desc'] = $item->description;
			}
			
			if (isset($item->width)) {
				$output['width'] = $item->width;
			}
			
			
			if (isset($item->columns) && $item->columns != '') {
				$registry = new JRegistry;
				$registry->loadJSON($item->columns);
				$item->columns = $registry->toArray();
				if (!empty($item->columns)) {
					$columnsString = implode (',', $item->columns);
					$query = 'SELECT a.id, a.type, a.content, a.position, a.moduleid, a.width'
					. ' FROM #__phocatemplate_columns AS a'
					. ' WHERE a.published = 1'
					. ' AND a.id IN('.$columnsString.')'
					. ' ORDER BY a.ordering';
					$db->setQuery( $query );
					if (!$db->query()) {
						$this->setError($db->getErrorMsg());
						return false;
					}
					$columns = $db->loadObjectList();
					
					if (!empty($columns)) {
						foreach ($columns as $key => $value) {
						
							switch ((int)$value->type) {
								
								case 3:
									if ($value->position != '') {
										$outputM = self::loadModulePosition($value->position);
										if ($outputM != '') {
											$style = 'style="float:left;"';
											if ((int)$value->width > 0) {
												$style = 'style="float:left;width: '.$value->width.'px"';
											}
											
											$outputM = self::filterSubMenu($outputM);
											
											$o .= '<div class="customsubmenucolumn" '.$style.' >';
											$o .= $outputM;
											$o .= '</div>';
										}
									}
								break;
								
								case 2:
									if ((int)$value->moduleid > 0) {
										$outputMI = self::loadModuleId($value->moduleid);
										
										if ($outputMI != '') {
											$style = 'style="float:left;"';
											if ((int)$value->width > 0) {
												$style = 'style="float:left;width: '.$value->width.'px"';
											}
											$outputMI = self::filterSubMenu($outputMI);
						
											$o .= '<div class="customsubmenucolumn" '.$style.' >';
											$o .= $outputMI;
											$o .= '</div>';
										}
									}
								break;
								
								
								case 1:
									if ($value->content != '') {
										$style = 'style="float:left;"';
										if ((int)$value->width > 0) {
											$style = 'style="float:left;width: '.$value->width.'px"';
										}
										$outputC = $value->content;
										$outputC = self::filterSubMenu($outputC);
										
										$o .= '<div class="customsubmenucolumn" '.$style.' >';
										$o .= $outputC;
										$o .= '</div>';
									}
									
								break;
							
							
							}
						}
					}	
				}	
			}
		}
		
		$output['o'] = $o;
		return $output;
	}
	
	
	/*
	 * Load Module Position
	 */
	
	public function loadModulePosition($position, $style = 'none') {
		$moduleOutput 	= '';
		$document		= JFactory::getDocument();
		$renderer		= $document->loadRenderer('module');
		$modules		= JModuleHelper::getModules($position);
		$params			= array('style' => $style);
		ob_start();
		foreach ($modules as $module) {
			echo $renderer->render($module, $params);
		}
		$moduleOutput = ob_get_clean();
		return $moduleOutput;
	}
	
	public function loadModuleID($id, $style = 'none') {
		
		$moduleOutput 	= '';
		if ((int)$id > 0) {
			$db = &JFactory::getDBO();
			$query = 'SELECT a.module, a.title'
					. ' FROM #__modules AS a'
					. ' WHERE a.published = 1'
					. ' AND a.id ='.(int)$id
					. ' ORDER BY a.ordering';
						
			$db->setQuery( $query );
			if (!$db->query()) {
				$this->setError($db->getErrorMsg());
				return false;
			}
			$module = $db->loadObject();

			if (isset($module->module) && isset($module->title) && $module->module != '' && $module->title != '') {
				$document		= JFactory::getDocument();
				$renderer		= $document->loadRenderer('module');
				
				//determine if this is a custom module
				$file				= $module->module;
				$custom				= substr($file, 0, 4) == 'mod_' ?  0 : 1;
				// Custom module name is given by the title field, otherwise strip off "com_"
				$module->name		= $custom ? $module->title : substr($file, 4);
				
				$moduleI		= JModuleHelper::getModule($module->name, $module->title);
				$params			= array('style' => $style);
				ob_start();
				echo $renderer->render($moduleI, $params);
				$moduleOutput = ob_get_clean();
			}
		}
		return $moduleOutput;
	}
	
	function filterSubMenu ($string) {
	
		$string = str_replace('<ul', '<div class="customsubmenuul" ',$string);
		$string = str_replace('<li', '<div class="customsubmenuli" ',$string);
		$string = str_replace('</ul>', '</div>',$string);
		$string = str_replace('</li>', '</div>',$string);
	
		return $string;
	}
}
?>