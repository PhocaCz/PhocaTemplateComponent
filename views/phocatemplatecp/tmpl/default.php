<?php defined('_JEXEC') or die('Restricted access');?>

<form action="index.php" method="post" name="adminForm">
<div class="adminform">
<div class="cpanel-left">
			<div id="cpanel">
	<?php
	$link = 'index.php?option=com_phocatemplate&view=phocatemplatemenus';
	echo PhocaTemplateCpHelper::quickIconButton( $link, 'icon-48-pt-menu.png', JText::_( 'COM_PHOCATEMPLATE_MENU_ITEMS' ) );
	
	$link = 'index.php?option=com_phocatemplate&view=phocatemplatecolumns';
	echo PhocaTemplateCpHelper::quickIconButton( $link, 'icon-48-pt-column.png', JText::_( 'COM_PHOCATEMPLATE_COLUMNS' ) );
	
	
	$link = 'index.php?option=com_phocatemplate&view=phocatemplateinfo';
	echo PhocaTemplateCpHelper::quickIconButton( $link, 'icon-48-pt-info.png', JText::_( 'COM_PHOCATEMPLATE_INFO' ) );
	?>
				<div style="clear:both">&nbsp;</div>
				<p>&nbsp;</p>
				<div style="text-align:center;padding:0;margin:0;border:0">
					<iframe style="padding:0;margin:0;border:0" src="http://www.phoca.cz/adv/phocatemplate" noresize="noresize" frameborder="0" border="0" cellspacing="0" scrolling="no" width="500" marginwidth="0" marginheight="0" height="125">
					<a href="http://www.phoca.cz/adv/phocatemplate" target="_blank">Phoca Template</a>
					</iframe> 
				</div>
			</div>
		</div>
		
		<div class="cpanel-right">
			<div style="border:1px solid #ccc;background:#fff;margin:15px;padding:15px">
			<div style="float:right;margin:10px;">
				<?php
					echo JHTML::_('image', 'administrator/components/com_phocatemplate/assets/images/logo-phoca.png', 'Phoca.cz' )
				?>
			</div>
			
			<?php
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
			?>
			<p>&nbsp;</p>
			
			
			<?php
			echo '<div style="border-top:1px solid #c2c2c2"></div>'
.'<div id="pg-update"><a href="http://www.phoca.cz/version/index.php?phocatemplate='.  $this->tmpl['version'] .'" target="_blank">'.  JText::_('COM_PHOCATEMPLATE_CHECK_FOR_UPDATE') .'</a></div>';
			?>
			</div>
		</div>
	</div>

<input type="hidden" name="option" value="com_phocatemplate" />
<input type="hidden" name="view" value="phocatemplatecp" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>