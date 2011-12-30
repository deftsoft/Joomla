<?php
// No direct access.
defined('_JEXEC') or die;

?>
<form action="<?php echo JRoute::_('index.php?option=com_calendar&task=tags.save'); ?>" method="post" name="adminForm" id="item-form">
 <div class="width-40 fltrt">
	   	<fieldset class="panelform">
		    <h1><legend>Personal Tags</legend></h1>
			<?php 
     		 foreach($this->options as $tags)
			  {
	 
	          	 	$selected=false;
    		       foreach($this->usertags as $usertags)
			        {
				 	  if($usertags->tag_id==$tags->value):
					    	$selected=true;
					  endif;
			        }
			   ?>
 			   <span><input type="checkbox" name="jform[tag_id][]" value="<?php echo $tags->value ?>" <?php if($selected):?>checked="checked" <?php endif; ?> />
			    <?php echo $tags->text; ?></span><br />
			  <?php
			    }
			  ?>
      
			
				
			
		</fieldset>
		 <input type="submit" name="submit" value="submit" />
		 <input type="hidden" name="task" value="tags.save" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
	   
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

	