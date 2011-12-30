<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * General Controller of HelloWorld component
 */
class CalendarController extends JController
{
        /**
         * display task
         *
         * @return void
         */
        function display($cachable = false) 
        {
	        	require_once JPATH_COMPONENT.'/helpers/calendar.php';
	        	
	        	// Load the submenu.
				CalendarHelper::addSubmenu(JRequest::getCmd('view', 'calendar'));
        		
                // set default view if not set
                JRequest::setVar('view', JRequest::getCmd('view', 'events'));
 
                // call parent behavior
                parent::display($cachable);
        }
}