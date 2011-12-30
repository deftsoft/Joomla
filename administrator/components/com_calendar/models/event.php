<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');
 
/**
 * Event Model
 */
class CalendarModelEvent extends JModelAdmin
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
        public function getTable($type = 'Event', $prefix = 'CalendarTable', $config = array()) 
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
                $form = $this->loadForm('com_calendar.event', 'event', array('control' => 'jform', 'load_data' => $loadData));
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
        protected function loadFormData() 
        {
                // Check the session for previously entered form data.
                $data = JFactory::getApplication()->getUserState('com_calendar.edit.event.data', array());
                if (empty($data)) 
                {
                        $data = $this->getItem();
                }
                return $data;
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
	 
        /*fucntion for alias and verified events from backend automatically*/
	
        public function save($data)
	       {
             
	   		    
				# code to save the events as verified from the backend
				    $post = JRequest::get( 'post' ); 
                    $post['jform']['verified'];
        		    $data['verified']= $post['jform']['verified'];
			 	


		        if($data['alias']=='')
						 {
				            $data['alias'] =$data['name'];          
				         
						 }
				
						#covertt the alias to name
						$str = str_replace('-', ' ',  $data['alias']);
				
						$lang = JFactory::getLanguage();
						$str = $lang->transliterate($str);
				
						// convert certain symbols to letter representation
						$str = str_replace(array('&', '"', '<', '>'), array('a', 'q', 'l', 'g'), $str);
				
						// lowercase and trim
						$str = trim(strtolower($str));
				
						// remove any duplicate whitespace, and ensure all characters are alphanumeric
						$str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $str);
						$data['alias']=$str;	
			  
				 
				 
			    if(parent::save($data)) {
						return true;
		        }
		
			     	return false;
	 }
  
   
}