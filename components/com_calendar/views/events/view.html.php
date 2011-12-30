<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Calendar Component
 */
class CalendarViewEvents extends JView
{
// Overwriting JView display method
        function display($tpl = null) 
        {
                // Assign data to the view
                  
				  $this->events = $this->get('Events');
                  $this->listevents = $this->get('Eventspagination');
				  $this->state=$this->get('state');
	              $this->params	= $this->state->get('parameters.menu');		
				        if (count($errors = $this->get('Errors'))) 
                        {
                           JError::raiseError(500, implode('<br />', $errors));
                           return false;
                        }
                // Display the view
                 parent::display($tpl);
        }
}