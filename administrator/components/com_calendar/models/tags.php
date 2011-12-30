<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modellist');
 
/**
 * Calendar Model
 */
class CalendarModelTags extends JModelList
{
		/**
         * Method to get a list of options for a list input.
         *
         * @return      array           An array of JHtml options.
         */
        protected function getListQuery()
        {
                $db = JFactory::getDBO();
                $query = $db->
				getQuery(true);
                $query->select('id,name');
                $query->from('#__calendar_tags');
                $query->order('name');
                return $query;
        }
}