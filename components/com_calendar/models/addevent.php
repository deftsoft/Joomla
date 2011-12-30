<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modelform');
/**
 * Event Model
 */
class CalendarModelAddEvent extends JModelForm

{
        /**
         * Returns a reference to the a Table object, always creating it.
         *
         * @param       type    The table type to instantiate
         * @param       string  A prefix for the table class name. Optional.
         * @param       array   Configuration array for model. Optional.
         * @return      JTable  A database object
         * @since       1.6
         */
        public function getTable($type = 'Addevent', $prefix = 'CalendarTable', $config = array()) 
        {
                return JTable::getInstance($type, $prefix, $config);
		  
         
		}
        /**
         * Method to get the record form.
         *
         * @param       array   $data           Data for the form.
         * @param       boolean $loadData       True if the form is to load its own data (default case), false if not.
         * @return      mixed   A JForm object on success, false on failure
         * @since       1.6
         */
        public function getForm($data = array(), $loadData = true) 
        {
                // Get the form.
                $form = $this->loadForm('com_calendar.addevent', 'addevent', array('control' => 'jform', 'load_data' => $loadData));
                if (empty($form)) 
                {
                        return false;
                }
                return $form;
        }
		
         /**
         * Method to get the data that should be injected in the form.
         *
         * @return      mixed   The data for the form.
         * @since       1.6
         */
        
           
    /*function to get the values of the tags for a user */
      public function getOptions()
	   {
		   // Initialize variables.
				$options = array();
			    $db		 = JFactory::getDbo();
				$query	 = $db->getQuery(true);
				$query->select('id AS value,name AS text');
				$query->from('#__calendar_tags');
				$query->order('name');
				// Get the options.
				$db->setQuery($query);
				$options = $db->loadObjectList();
	
				// Check for a database error.
				if ($db->getErrorNum()) {
					JError::raiseWarning(500, $db->getErrorMsg());
				}
		
				return $options;
	  }       	
  
    
	/*function to add the data*/
	
	 
 function store($data)  
  
   {  
	      
		JTable::addIncludePath('components'.DS.'com_calendar'.DS.'tables');
		$row =JTable::getInstance($type = 'Addevent', $prefix = 'CalendarTable', $config = array());
		//$data = JRequest::get( 'post' );  
		
		// Bind the form fields to the hello table  
		 if (!$row->bind($data)) {  
		 $this->setError($this->_db->getErrorMsg());  
		 return false;  
		 }  
		   
		 // Make sure the hello record is valid  
		 if (!$row->check()) {  
		 $this->setError($this->_db->getErrorMsg());  
		 return false;  
		 }  
		 // Store the web link table to the database  
		 if (!$row->store()) {  
		 $this->setError( $row->getErrorMsg() );  
		 return false;  
		 }  
		 return true;

 }

   /*function to get the values of the tags  */
      public function getTags()
	   {
		   // Initialize variables.
				$options = array();
			    $db		 = JFactory::getDbo();
				$query	 = $db->getQuery(true);
				$query->select('id AS value,name AS text');
				$query->from('#__calendar_tags order by name');
				// Get the options.
				$db->setQuery($query);
				$options = $db->loadObjectList();
	
				// Check for a database error.
				if ($db->getErrorNum()) {
					JError::raiseWarning(500, $db->getErrorMsg());
				}
		
				return $options;
	  }       	
  
	   /*function to get the tags of particular evens*/
		public function getEtags()
		 {
				   $db     = JFactory::getDbo();
				   $id = JRequest::getInt('id');
				   $query="SELECT tag_id FROM #__calendar_events WHERE id='".$id."'";
				   $db->setQuery($query);
				   $eventTags=$db->loadObjectList();
				   if(!empty($eventTags))
				   {
					 $eventTags=explode(",",$eventTags[0]->tag_id);
					 return $eventTags;
				   }
		  
		  }



}