<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Calendar Component
 */
class CalendarViewEvent extends JView
{
// Overwriting JView display method
        function display($tpl = null) 
        {
                // Assign data to the view
                $this->event = $this->get('Event');
				$this->eventtags = $this->get('Tags');
 
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