<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

JModel::addIncludePath(JPATH_SITE.'/components/com_calendar/models', 'CalendarModel');

  class modCalendardHelper
	{
	    /**
	     * Retrieves the hello message
	     *
	     * @param array $params An object containing the module parameters
	     * @access public
	     */    
	   public function getCalendar( $params )
	    {
	        // Get the dbo
				 $db = JFactory::getDbo();
		         $model = JModel::getInstance('Events', 'CalendarModel', array('ignore_request' => true));
			     
				 $model->setState('counts', $params->get('count'));
			    
				 $nameLimit=$params->get('name');
	             $detailsLimit=$params->get('details');
				
				 $FutureEvents = $model->getFutureEvents();
    			 			 
				 foreach($FutureEvents as $FutureEvent)
				  {
				      if($nameLimit!=0)
					  {
					     $FutureEvent->name=substr($FutureEvent->name,0,$nameLimit);
				         $FutureEvent->name=$FutureEvent->name."<b>.....</b>";
					  }
					
					  if($detailsLimit!=0)
					  {
					     $FutureEvent->details=substr($FutureEvent->details,0,$detailsLimit);
				         $FutureEvent->details=$FutureEvent->details."<b>.....</b>";
					  }
				  
				  } 
				 
				
			    	 return $FutureEvents;
				
	    }
	  
    }
?>