<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Events View
 */
class CalendarViewTags extends JView
{		
        /**
         * Events view display method
         * @return void
         */
        function display($tpl = null) 
        {
                // Assign data to the view
                $this->events = $this->get('Items');
                $this->pagination = $this->get('Pagination');
 
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
                JToolBarHelper::title(JText::_('COM_CALENDAR_TAGS_TITLE'));
                JToolBarHelper::deleteListX('', 'tags.delete');
                JToolBarHelper::editListX('tag.edit');
                JToolBarHelper::addNewX('tag.add');
        }
}