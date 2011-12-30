<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Calendar Component
 */
class CalendarViewPersonal extends JView
{
// Overwriting JView display method
        function display($tpl = null) 
        {
                // Assign data to the view
                $this->form = $this->get('Form');
				$this->events = $this->get('Events');
				$this->options=$this->get('Options');
				$this->userid=$this->get('Userid');
                $this->state=$this->get('state');  
				$this->params	= $this->state->get('parameters.menu');	
				$this->listevents=$this->get('Eventspagination');
				
                
				// Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
                // Display the view
                parent::display($tpl);
        }
}