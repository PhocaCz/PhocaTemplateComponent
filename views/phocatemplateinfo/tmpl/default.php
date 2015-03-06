<?php
defined('_JEXEC') or die;
JHTML::_('behavior.tooltip');
echo '<div class="phoca-adminform">'
	.'<form action="index.php" method="post" name="adminForm">'
	.'<div style="float:right;margin:10px;">'
	. JHTML::_('image', 'administrator/components/com_phocatemplate/assets/images/logo-phoca.png', 'Phoca.cz' )
	.'</div>'
	. JHTML::_('image', 'administrator/components/com_phocatemplate/assets/images/logo.png', 'Phoca.cz')
	.'<h3>'.JText::_('COM_PHOCATEMPLATE_PHOCA_TEMPLATE').' - '. JText::_('COM_PHOCATEMPLATE_INFORMATION').'</h3>';
	//.'<h3>'. JText::_('COM_PHOCATEMPLATE_INFORMATION').'</h3>';

echo '<h3>'.  JText::_('COM_PHOCATEMPLATE_HELP').'</h3>';

echo '<p>'
.'<a href="http://www.phoca.cz/phocatemplate/" target="_blank">Phoca Template Main Site</a><br />'
.'<a href="http://www.phoca.cz/documentation/" target="_blank">Phoca Template User Manual</a><br />'
.'<a href="http://www.phoca.cz/forum/" target="_blank">Phoca Template Forum</a><br />'
.'</p>';

echo '<h3>'.  JText::_('COM_PHOCATEMPLATE_VERSION').'</h3>'
.'<p>'.  $this->tmpl['version'] .'</p>';

echo '<h3>'.  JText::_('COM_PHOCATEMPLATE_COPYRIGHT').'</h3>'
.'<p>© 2007 - '.  date("Y"). ' Jan Pavelka</p>'
.'<p><a href="http://www.phoca.cz/" target="_blank">www.phoca.cz</a></p>';

echo '<h3>'.  JText::_('COM_PHOCATEMPLATE_LICENSE').'</h3>'
.'<p><a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GPLv2</a></p>';

echo '<h3>'.  JText::_('COM_PHOCATEMPLATE_TRANSLATION').': '. JText::_('COM_PHOCATEMPLATE_TRANSLATION_LANGUAGE_TAG').'</h3>'
        .'<p>© 2007 - '.  date("Y"). ' '. JText::_('COM_PHOCATEMPLATE_TRANSLATER'). '</p>'
        .'<p>'.JText::_('COM_PHOCATEMPLATE_TRANSLATION_SUPPORT_URL').'</p>';



echo '<input type="hidden" name="task" value="" />'
.'<input type="hidden" name="option" value="com_phocatemplate" />'
.'<input type="hidden" name="controller" value="phocatemplatein" />'
.'</form>';

echo '<p>&nbsp;</p>';

echo '<div style="border-top:1px solid #eee"></div>'
.'<div id="pg-update"><a href="http://www.phoca.cz/version/index.php?phocagallery='.  $this->tmpl['version'] .'" target="_blank">'.  JText::_('COM_PHOCATEMPLATE_CHECK_FOR_UPDATE') .'</a></div>';

echo '<div style="margin-top:30px;height:39px;background: url(\''.JURI::base(true).'/components/com_phocatemplate/assets/images/line.png\') 100% 0 no-repeat;">&nbsp;</div>';

echo '</div>';