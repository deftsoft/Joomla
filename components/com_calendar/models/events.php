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
         * @return      array           An array of JHtml options.
         */
        
		 function getEvents()
        {
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('id,name,date,details');
                $query->from('#__calendar_events');
				$query->where('verified!=0' );
                $db->setQuery($query);
                $events = $db->loadObjectList();
                return $events;
        }
		
		
	 /*Function to get the list data with paging
	 *function getEventspagination 
	 *
	 */
		function getEventspagination()
        {
          
		         global $mainframe;
		         $limit =2;
			     $limitstart = JRequest::getVar('limitstart', 0);
			     $db = JFactory::getDBO();
     			 $query="select count(*) from #__calendar_events where verified!=0";
				 $db->setQuery( $query );
				 $total = $db->loadResult();
				 $query = $db->getQuery(true);
				
				 $query->select('id,name,date,details');
                 $query->from('#__calendar_events');
				 $query->where('verified!=0' );
				 $db->setQuery( $query, $limitstart, $limit );
				 $rows = $db->loadObjectList();
                
				 jimport('joomla.html.pagination');
			     $events = new JPagination($total, $limitstart, $limit);
                 $data[] = $rows;
			     $data[] = $events;
			     return $data;
       
	    }
     
	  /*
	  *function to get the close future events.
	  *
	  */
       public function getFutureEvents()
	    {
	      $count =  $this->setState('counts');
		  $db = JFactory::getDBO();
		  $query="SELECT id as id, name as name, alias as title, details as details, website as eventurl, date as date, location as location FROM  #__calendar_events WHERE (date >=date(now()) and verified!=0) order by date".' ';
		  #check 
		  if($count!=0)
		   {
		    $query.="LIMIT $count";
		   }
		  
		  $db->setQuery($query);
	      $futureEvents = $db->loadObjectList();
		  return $futureEvents;
     }
    

     /*
	 *
	 *
	 */
       function getPopulatestate()
	  {
		// Get the application object.
		$params	= JFactory::getApplication()->getParams('com_calendar');

		// Load the parameters.
		return $this->setState('params', $params);
	  }


}