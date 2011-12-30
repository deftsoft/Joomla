<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Event View
 */
class CalendarViewEvent extends JView
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
				$this->tags = $this->get('Tags');
				$this->Etags = $this->get('Etags');
 
                // Check for errors.
                if (count($errors = $this->get('Errors'))) 
                {
                        JError::raiseError(500, implode('<br />', $errors));
                        return false;
                }
 
                // Set the toolbar
                $this->addToolBar();
 
                // Display the template
                parent::display($tpl);
        }
 
        /**
         * Setting the toolbar
         */
        protected function addToolBar() 
        {
                JRequest::setVar('hidemainmenu', true);
                $isNew = ($this->item->id == 0);
                JToolBarHelper::title($isNew ? JText::_('COM_CALENDAR_EVENT_TITLE_NEW') : JText::_('COM_CALENDAR_EVENT_TITLE_EDIT'));
                JToolBarHelper::apply('event.apply','JTOOLBAR_APPLY');
				JToolBarHelper::save('event.save','JTOOLBAR_SAVE');
                JToolBarHelper::cancel('event.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        }
}