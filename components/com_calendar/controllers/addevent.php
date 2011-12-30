<?php
/**
 * @version		$Id: profile.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Profile controller class for Users.
 *
 * @package Joomla.Site
 * @subpackage	com_users
 * @since		1.6
 */
class  CalendarControllerAddevent extends CalendarController
{
	/**
	 * function to save the events from the front end by the user
	 *
	 * @since	1.6
	 */

	 public  function save()  
        {  
                     
				           $app	= JFactory::getApplication();
						   $model = $this->getModel('addevent');  
						   $form	= $model->getForm();
						   $requestData = JRequest::getVar('jform', array(), 'post', 'array');
						
		
						
		// Validate the posted data.
		$form	= $model->getForm();
		 	
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}
		
		$data	= $model->validate($form, $requestData);
   
     // Check for validation errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if (JError::isError($errors[$i])) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			} 

			 // Save the data in the session.
			$app->setUserState('com_calendar.addevent.data', $requestData);

			 // Redirect back to the registration screen.
			$this->setRedirect(JRoute::_('index.php?option=com_calendar&view=addevent', false));
			return false;
		}
						
	     				
						
						   if ($model->store($data)) {  
						   $msg = JText::_( 'Event Has Saved!' );  
						   } else {  
						   $msg = JText::_( 'Error Saving data' );  
						   }  
		   
             // Check the table in so it can be edited.... we are done with it anyway  
						  $link = JRoute::_('index.php?option=com_calendar&view=addevent', false);
						  $this->setRedirect($link, $msg);  
             } 


}	
	
		