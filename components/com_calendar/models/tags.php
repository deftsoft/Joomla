<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modelform');
 
/**
 * Event Model
 */
class CalendarModelTags extends JModelForm

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
        public function getTable($type = 'Tags', $prefix = 'CalendarTable', $config = array()) 
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
                $form = $this->loadForm('com_calendar.tags', 'tags', array('control' => 'jform', 'load_data' => $loadData));
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
	
	#function to get the users tags
	
    public function getUsertags()
	   {
		   // Initialize variables.
				$user	= JFactory::getUser();
		        $userId	= (int) $user->get('id');
				$options = array();
			    $db		 = JFactory::getDbo();
				$query	 = $db->getQuery(true);
				$query->select('tag_id');
				$query->from('#__calendar_user_tags');
				$query->where('user_id="'.$userId.'"');
				// Get the options.
				$db->setQuery($query);
				$usertags = $db->loadObjectList();
	
				// Check for a database error.
				if ($db->getErrorNum()) {
					JError::raiseWarning(500, $db->getErrorMsg());
				}
		
				return $usertags;
	  }       	
	



 }



    


