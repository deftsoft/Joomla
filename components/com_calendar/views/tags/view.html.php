<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Event View
 */
class CalendarViewTags extends JView
{
        /**
         * display method of Event view
         * @return void
         */
        public function display($tpl = null) 
        {
               // get the Data and assign it
                $this->form = $this->get('Form');
                $this->item = $this->get('Item');
				$this->options=$this->get('Options');
				$this->usertags=$this->get('Usertags');
				
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
 
                // Set the toolbar
                //$this->addToolBar();
 
                // Display the template
                parent::display($tpl);
        }
 


}