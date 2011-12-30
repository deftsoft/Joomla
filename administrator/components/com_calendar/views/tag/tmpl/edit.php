<?php
// No direct access.
defined('_JEXEC') or die('Restricted access');
// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
?>

<form action="<?php echo JRoute::_('index.php?option=com_calendar&view=tag&layout=edit&id='.$this->item->id); ?>" method="post" name="adminForm" id="item-form">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
        	<legend><?php echo JText::_( 'COM_CALENDAR_TAG_DETAILS' ); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>
			</ul>
		</fieldset>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>