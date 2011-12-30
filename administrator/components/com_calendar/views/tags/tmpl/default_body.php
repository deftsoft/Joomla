<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->events as $i => $event): ?>
        <tr class="row<?php echo $i % 2; ?>">
                <td>
                        <?php echo JHtml::_('grid.id', $i, $event->id); ?>
                </td>
                <td>
                        <?php echo "<a href='" . JRoute::_('index.php?option=com_calendar&task=tag.edit&id=' . $event->id) . "'>" . $event->name . "</a>"; ?>
                        
                </td>
                <td>
                                <?php echo $event->id; ?>        
                </td>
        </tr>
<?php endforeach; ?>