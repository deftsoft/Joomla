<?php
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
/**
 * EventTag Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	com_calendar
 * @since		1.6
 */
class JFormFieldEventTags extends JFormFieldList
 {
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'EventTag';
	
	protected $multiple = true;

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
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
	
}