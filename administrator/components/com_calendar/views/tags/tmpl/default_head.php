<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<tr class="row<?php echo $i % 2; ?>">
                <td width="1%">
                         <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->events); ?>);" />
                </td>
                <td>
                      <?php echo JText::_('COM_CALENDAR_TAGS_HEADING_NAME'); ?>
                        
                </td>
                <td width="1%">
                      <?php echo JText::_('COM_CALENDAR_HEADING_ID'); ?>
                </td>
        </tr>


