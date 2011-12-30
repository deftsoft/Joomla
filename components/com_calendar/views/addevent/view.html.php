<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Event View
 */
class CalendarViewAddevent extends JView
{
        /**
         * display method of Event view
         * @return void
         */
        public function display($tpl = null) 
        {
                // get the Data and assign it
                $this->form  = $this->get('Form');
                $this->item  = $this->get('Item');
				$this->tags  = $this->get('Tags');
				$this->Etags = $this->get('Etags');
				$this->state =$this->get('state');
	            $this->params = $this->state->get('parameters.menu');	
                 // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
 
            
                          
                parent::display($tpl);
        }
 
        /**
         * Setting the toolbar
         */
        
}