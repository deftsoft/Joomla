<?php
/**
 * @version     1.7.0
 * @package     com_videoimport
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * HTML View class for the Videoimport component
 */
class VideoimportViewVideoimport extends JView
{
	protected $state;
	protected $item;

	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$params		= $app->getParams();

		// Get some data from the models
		$state		= $this->get('State');
		$item		= $this->get('Item');

        parent::display($tpl);

	}
}