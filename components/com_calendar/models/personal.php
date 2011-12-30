<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modellist');
 
/**
 * Calendar Model
 */
class CalendarModelPersonal extends JModelList
{
		/**
         * function to get the users personal events according to the tags saved to their profile
         *
         * @return      array           An array of JHtml options.
         */
        function getEvents()
         {
		        $db = JFactory::getDBO();
			    #get current user id 
				$user	= JFactory::getUser();
		        $userId	= (int) $user->get('id');
    		    $query = $db->getQuery(true);
                 
				 
					$query->select('ct.id');
					$query->from('#__calendar_user_tags as cut');
					$query->join('LEFT', '#__calendar_tags AS ct ON cut.tag_id = ct.id');
					$query->where('cut.user_id ="'.$userId.'"');
					$db->setQuery($query);
					$events = $db->loadObjectList();
					$result=array();
					foreach($events as $eventss)
					{
						    $query="SELECT  ce.* FROM #__calendar_events as ce WHERE ce.tag_id LIKE '%".$eventss->id."%' and ce.verified!=0";
							$db->setQuery($query);
							$result = array_merge($result,$db->loadObjectList());
					}
					   return $result;
         	}

     
	   
	 /*Function to get the list data with paging
	  *function getEventspagination 
	 *
	 */
		
		
		
		  
		   function getEventspagination()
         {
		        $db = JFactory::getDBO();
			    #get current user id 
				$user	= JFactory::getUser();
		        $userId	= (int) $user->get('id');
    		    $query = $db->getQuery(true);
                 
				 
					$query->select('ct.id');
					$query->from('#__calendar_user_tags as cut');
					$query->join('LEFT', '#__calendar_tags AS ct ON cut.tag_id = ct.id');
					$query->where('cut.user_id ="'.$userId.'"');
					$db->setQuery($query);
					$events = $db->loadObjectList();
					$result=array();
					$limit =2;
			        $limitstart = JRequest::getVar('limitstart', 0);
					
					foreach($events as $eventss)
					{
											    								  
						    $query="SELECT  ce.* FROM #__calendar_events as ce WHERE ce.tag_id LIKE '%".$eventss->id."%' and ce.verified!=0";
							$db->setQuery($query);
					       #result qurey
						     $sql="SELECT  ce.* FROM #__calendar_events as ce WHERE ce.tag_id LIKE '%".$eventss->id."%' and ce.verified!=0";
					         $db->setQuery( $sql, $limitstart, $limit );
						     $result = array_merge($result,$db->loadObjectList());
					         $total=count($result);
					 }
					     jimport('joomla.html.pagination');
			             $events = new JPagination($total, $limitstart, $limit);
                         $data[]=$result;
						 $data[]=$events;
			       
				          return $data;
			}
		
		
		
		
		
		
		
		
		
		
		/*function getEventspagination()
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
				 
				 $rows = $db->loadObjectList();
                
				 jimport('joomla.html.pagination');
			     $events = new JPagination($total, $limitstart, $limit);
                 $data[] = $rows;
			     $data[] = $events;
			     return $data;
       
	    }*/

	   
	 
	 
	 
	 
	 #funtion to get all the tags 
	  
	  public function getOptions()
	  {
		// Initialize variables.
		$options = array();
			
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id AS value,name AS text');
		$query->from('#__calendar_tags');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();
		
		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		return $options;
	 }
	
    #function to get the user id
	
	 public function getUserid()
	  {
	           #get current user id 
				$user	= JFactory::getUser();
		        $userId	= (int) $user->get('id');
				return $userId;
	  }


}