<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modellist');
 
/**
 * Calendar Model
 */
class CalendarModelEvents extends JModelList
{
		/**
         * Method to get a list of options for a list input.
         *
         * @return  array   An array of JHtml options.
         */
        protected function getListQuery()
        {
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('id,name,alias,location,date,details,verified');
				$query->from('#__calendar_events order by name');
                return $query;
        }
    
	 /*
	 *function to update the status for the events
	 *
	 */
        function EditEventStatus()
	     {
	            $db = JFactory::getDBO();
				JTable::addIncludePath('components'.DS.'com_calendar'.DS.'tables');
				$row =JTable::getInstance($type = 'Event', $prefix = 'CalendarTable', $config = array());
				$data = JRequest::get('get');
				#set the id to update the respective record
				 $id=$data['id'];
				 if($data['status']=='verify')
				  {$svalue=0;}
				  else
				  {$svalue=1;}
				 echo $svalue;
				 #set the query to update the status of the event
				  $query="UPDATE #__calendar_events SET verified='".$svalue."' WHERE id='".$id."'";
				 $db->setQuery($query);
				 if(!$db->query()){ return false; } 
				 else{
				 return true;
				 }
     	 }
	
}