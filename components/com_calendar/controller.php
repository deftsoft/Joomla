<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * Calendar Component Controller
 */
class CalendarController extends JController
{
	public function display()
	{
		// Set the default view name and format from the Request.
		$vName = JRequest::getWord('view', 'events');
		JRequest::setVar('view', $vName);
		return parent::display();
	}
}