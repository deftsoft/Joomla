<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * Calendar Model
 */
class CalendarModelEvent extends JModelItem
{
		/**
         * Method to get a list of options for a list input.
         *
         * @return      array           An array of JHtml options.
         */
        function getEvent()
        {
			$id = JRequest::getInt('id');
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$query->select('id,name,date,tag_id,details,website,location,contact_details,verified');
			$query->from('#__calendar_events');
			$query->where('id = ' . $id);
			$db->setQuery($query);
			$event = $db->loadAssoc();
			return $event;
			
        }
   
      /*
	  *fucntion will use to get the respective tags for the event at front end
	  *function getTags
	  */
     function getTags()
	  {
				$id = JRequest::getInt('id');
				$db = JFactory::getDBO();
				
				$query = $db->getQuery(true);
				$query->select('tag_id');
				$query->from('#__calendar_events');
				$query->where('id = ' . $id);
				$db->setQuery($query);  
				$tag_id=$db->loadAssoc(); 
				
				$t_id=$tag_id['tag_id'];
				$t_arr=explode(",",$t_id);
				foreach($t_arr as $t_arrs)
				 {
				   $array[]="'".$t_arrs."'";
				 }
				$tagids=implode(",",$array);
				$query="SELECT  name,id FROM  #__calendar_tags where id in ($tagids)";	     
				$db->setQuery($query);
				$eventtags=$db->loadObjectList();
				return $eventtags;
			 
	  }

}

