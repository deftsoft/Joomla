<?php
  defined('_JEXEC') or die; // no direct access allowed
  require_once dirname(__FILE__).DS.'helper.php'; // get helper files
  $items = modCalendardHelper::getCalendar($params);
  require JModuleHelper::getLayoutPath('mod_calendar');
?>