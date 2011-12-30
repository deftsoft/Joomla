<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Event Table class
 */
class CalendarTableEvent extends JTable
{
        /**
         * Constructor
         *
         * @param object Database connector object
         */
        function __construct(&$db) 
        {
                parent::__construct('#__calendar_events', 'id', $db);
        }
        
        function bind( $array, $ignore = '' )
	    {
	        if (isset($array['tag_id']) && is_array( $array['tag_id'] )) {
	                $array['tag_id'] = implode( ',', $array['tag_id'] );
	        }
	 
	        return parent::bind( $array, $ignore );
	    }
        
}