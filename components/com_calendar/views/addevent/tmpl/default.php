<?php
// No direct access.
defined('_JEXEC') or die;

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

#get the document object to get the current page title
$document=JFactory::getDocument();
#get the current page heading of the menu item if it is not empty
$page_heading= $this->escape($this->params->get('page_heading')); ?>
  <h1>
<?php 
if(!empty($page_heading))
  {echo $page_heading; }
  else{echo $document->getTitle();}
  ?>
</h1>

<form action="<?php echo JRoute::_('index.php?option=com_calendar&task=addevent.save') ?>" method="post" name="adminForm" id="item-form" class="form-validate">
    <fieldset>
        <legend><?php echo JText::_( 'COM_CALENDAR_ADDEVENT_FIELDSET_INFO' ); ?></legend>
            <?php echo $this->form->getLabel('name'); ?>
            <?php echo $this->form->getInput('name'); ?>
            
            <?php echo $this->form->getLabel('alias'); ?>
            <?php echo $this->form->getInput('alias'); ?>

            <?php echo $this->form->getLabel('date'); ?>
            <?php echo $this->form->getInput('date'); ?>

            <?php echo $this->form->getLabel('website'); ?>
            <?php echo $this->form->getInput('website'); ?>

            <?php echo $this->form->getLabel('location'); ?>
            <?php echo $this->form->getInput('location'); ?>

        </ul>
        </fieldset>
        <fieldset>
            <legend><?php echo JText::_( 'COM_CALENDAR_ADDEVENT_FIELDSET_DETAILS' ); ?></legend>
			<?php echo $this->form->getInput('details'); ?>
        </fieldset>
        <fieldset>
        	<legend><?php echo JText::_( 'COM_CALENDAR_ADDEVENT_FIELDSET_CONTACT' ); ?></legend>
				<?php echo $this->form->getInput('contact_details'); ?>
        </fieldset>
    

        <legend><?php echo JText::_( 'COM_CALENDAR_ADDEVENT_FIELDSET_TAGS' ); ?></legend>
        <?php //echo $this->form->getInput('tag_id'); ?>
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
        
 
 
 
 
		
    <input type="submit" name="submit" value="Add Event" />
    <input type="hidden" name="task" value="addevent.save" />
    <input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>