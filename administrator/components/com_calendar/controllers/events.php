<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Events Controller
 */
class CalendarControllerEvents extends JControllerAdmin
{
        /**
         * Proxy for getModel.
         * @since       1.6
         */
        public function getModel($name = 'Event', $prefix = 'CalendarModel') 
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
        
		
		
		/*function to update the events status*/
		
		public function EditEventStatus()
		{
		        $model = $this->getModel('events');  
                if($model->EditEventStatus()) {  
			    $msg = JText::_( 'Status has been updated!');  
                } else {  
                $msg = JText::_('Error Updating data');  
                }  
         // Check the table in so it can be edited.... we are done with it anyway  
               $link = 'index.php?option=com_calendar&view=events';  
               $this->setRedirect($link, $msg);
        } 

}
