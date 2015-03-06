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
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'phocatemplatecolumn.cancel' || document.formvalidator.isValid(document.id('phocatemplatecolumn-form'))) {
			Joomla.submitform(task, document.getElementById('phocatemplatecolumn-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php JRoute::_('index.php?option=com_phocatemplate'); ?>" method="post" name="adminForm" id="phocatemplatecolumn-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->items->id) ? JText::_('COM_PHOCATEMPLATE_NEW_COLUMN') : JText::sprintf('COM_PHOCATEMPLATE_EDIT_COLUMN', $this->items->id); ?></legend>
		
		<ul class="adminformlist">
			<?php 
			$formArray = array ('title', 'width', 'ordering');
			foreach ($formArray as $value) {
				echo '<li>'.$this->form->getLabel($value) . $this->form->getInput($value).'</li>' . "\n";
			} ?>
		</ul>
			<?php echo $this->form->getLabel('content'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('content'); ?>
	</fieldset>
</div>

<div class="width-40 fltrt">
	<?php echo JHtml::_('sliders.start','phocatemplatecolumnx-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

	<?php echo JHtml::_('sliders.panel',JText::_('COM_PHOCATEMPLATE_GROUP_LABEL_PUBLISHING_DETAILS'), 'publishing-details'); ?>
		<fieldset class="adminform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field) {
				echo '<li>';
				if (!$field->hidden) {
					echo $field->label;
				}
				echo $field->input;
				echo '</li>';
				
			} 
			?>
			</ul>
		</fieldset>
	
	
	<?php //echo $this->loadTemplate('metadata'); ?>
		
	<?php echo JHtml::_('sliders.end'); ?>
</div>

<div class="clr"></div>

<input type="hidden" name="jform[type]" id="jform_type" value="1" />
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>