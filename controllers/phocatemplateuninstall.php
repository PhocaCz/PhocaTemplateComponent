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

class PhocaTemplateCpControllerPhocaTemplateuninstall extends PhocaTemplateCpController
{
	function __construct()
	{
		parent::__construct();
		$this->registerTask( 'remove'  , 'remove' );
		$this->registerTask( 'keep'  , 'keep' );		
	}
	function remove(){}
	
	function keep(){}
}
?>