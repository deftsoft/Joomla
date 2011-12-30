<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
    <td width="1%">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->events); ?>);" /></td>
    <td>
        <b> <?php echo JText::_('COM_CALENDAR_EVENTS_HEADING_NAME'); ?></b></td>
    <td align="center" width="5%">
        <b><?php echo JText::_('COM_CALENDAR_HEADING_PUBLISHED'); ?></b></td>
    <td align="center" width="10%">
        <b><?php echo JText::_('COM_CALENDAR_HEADING_DATE'); ?></b></td>
    <td width="40%">
    	</td>
    <td width="1%">
        <b><?php echo JText::_('COM_CALENDAR_HEADING_ID'); ?></b></td>
</tr>