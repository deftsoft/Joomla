<?php
// No direct access.
defined('_JEXEC') or die;

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {

		if (task == 'event.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('details')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_calendar&view=event&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_( 'COM_CALENDAR_EVENT_DETAILS' ); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>
				
				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('date'); ?>
				<?php echo $this->form->getInput('date'); ?></li>

				<li><?php echo $this->form->getLabel('website'); ?>
				<?php echo $this->form->getInput('website'); ?></li>

				<li><?php echo $this->form->getLabel('location'); ?>
				<?php echo $this->form->getInput('location'); ?></li>

			</ul>
			<div class="clr"></div>
			<?php echo $this->form->getLabel('details'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('details'); ?>
			
			<div class="clr"></div>
			<?php echo $this->form->getLabel('contact_details'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('contact_details'); ?>
		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start','content-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

		<?php echo JHtml::_('sliders.panel',JText::_('COM_CALENDAR_EVENT_FIELDSET_TAGS'), 'tags'); ?>
		<fieldset class="panelform">
				<?php
				foreach($this->tags as $tags)
			      {
	         	 	$selected=false;
    		         if(!empty($this->Etags))
				      { 
					  
							foreach($this->Etags as $eventtags)
							 {
								if($eventtags==$tags->value)
								 {
									$selected=true;
								 }
							 }
			          
					  }
			   ?>
 			    <li><input type="checkbox" name="jform[tag_id][]" value="<?php echo $tags->value ?>" <?php if($selected):?>checked="checked" <?php endif; ?> />
			    <?php echo $tags->text; ?></li>
			   
			   <?php }  ?>
		</fieldset>
		
		<?php echo JHtml::_('sliders.panel',JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'), 'basic'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('basic') as $field): ?>
					<?php if (!$field->hidden): ?>
						<li><?php echo $field->label; ?></li>
					<?php endif; ?>
					<li><?php echo $field->input; ?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>

		<?php echo JHtml::_('sliders.end'); ?>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="jform[verified]" value="1" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>