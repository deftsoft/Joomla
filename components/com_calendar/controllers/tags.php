<?php
/**
 * @version		$Id: profile.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Profile controller class for Users.
 *
 * @package Joomla.Site
 * @subpackage	com_users
 * @since		1.6
 */
class  CalendarControllerTags extends CalendarController
{
	/**
	 * Method to save the tags to the users profile
	 *
	 * @since	1.6
	 */
	
			public function save()
	        {
			        $db = JFactory::getDBO();
			    	#get current user id 
					$user	= JFactory::getUser();
		            $userId	= (int) $user->get('id');
				    $data = JRequest::get('post');
	                if(!empty($data))
					 {
					   $query="DELETE FROM #__calendar_user_tags WHERE user_id='".$userId."'";
					   $db->setQuery($query);
					   $db->query();
					 
                       for($i=0;$i<count($data['jform']['tag_id']);$i++)
				        {
				          $tag_id=$data['jform']['tag_id'][$i];
				          $query="INSERT INTO #__calendar_user_tags(user_id,tag_id)VALUES('".$userId."','".$tag_id."')";
				 	      $db->setQuery($query);
		                  $db->query();
					    }
	                   
					 }
					 
					
						    $this->setRedirect(JRoute::_('index.php?option=com_calendar&view=personal', false));
					
          }	

}	
	
		